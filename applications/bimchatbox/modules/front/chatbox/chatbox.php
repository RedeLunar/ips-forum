<?php


namespace IPS\bimchatbox\modules\front\chatbox;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * chatbox
 */
class _chatbox extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		if ( \IPS\Settings::i()->chatbox_conf_on != 1 )
		{
			if ( \IPS\Request::i()->isAjax() )
			{
				\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_off' ) ) );
				exit;
			}
			else
			{
				\IPS\Output::i()->error( 'chatbox_error_off', '2BIMCB101/1', 403, '' );
			}				
		}
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		if ( ! \IPS\Application::load('bimchatbox')->can_View() )
		{
			\IPS\Output::i()->error( 'chatbox_error_noper', '2BIMCB101/2', 403, '' );
		}
		
		$chats = array(); 
		$chats = \IPS\Application::load('bimchatbox')->loadChatBox();
		
		// Output		
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('chatbox_title');
		\IPS\Output::i()->output	= "<div class='ipsWidget ipsBox'>" . \IPS\Theme::i()->getTemplate( 'chat' )->main($chats, $orientation) . "</div>";
	}
		
	/*-------------------------------------------------------------------------*/
	// Chatbox management
	/*-------------------------------------------------------------------------*/		
	protected function config()
	{
		# Can manage?
		if ( ! \IPS\Application::load('bimchatbox')->can_Manage() )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_notmoderator' ) ) );
			exit;			
		}
		
		# Block list
		$form = new \IPS\Helpers\Form;

		$blockID = \IPS\Settings::i()->chatbox_conf_blocklist ? explode( ",", \IPS\Settings::i()->chatbox_conf_blocklist ) : array();
		$blockName = array();
		foreach( (array) $blockID as $mid )
		{
			$blockName[] = \IPS\Member::load( $mid )->name;
		}

		$form->add( new \IPS\Helpers\Form\Member( 'chatbox_conf_blocklist', $blockName, FALSE, array('multiple'	=> null) ) );
		
		$form->add( new \IPS\Helpers\Form\TextArea( 'chatbox_conf_announcements', \IPS\Settings::i()->chatbox_conf_announcements, FALSE, array('rows' => 5) ) );
		
		$form->add( new \IPS\Helpers\Form\YesNo( 'chatbox_clearchat', 0, FALSE, array() ) );
		
		$form->class = 'ipsForm_vertical chatboxConfig';		
		
		if ( $values = $form->values( TRUE ) )
		{
			if( !empty( $values['chatbox_conf_blocklist'] ) )
			{
				if ( mb_stripos( $values['chatbox_conf_blocklist'], "," ) === false )
				{
					$values['chatbox_conf_blocklist'] = str_replace( "\n", ",", $values['chatbox_conf_blocklist'] );
				}
			}
			else
			{
				$values['chatbox_conf_blocklist'] = NULL;
			}

			if ( $values['chatbox_conf_blocklist'] != \IPS\Settings::i()->chatbox_conf_blocklist )
			{
				foreach( explode(",", $values['chatbox_conf_blocklist']) as $b )
				{
					try
					{						
						$bdata[] = \IPS\Member::load( $b )->name;
					}
					catch ( \OutOfRangeException $e ) {}						
				}
			}
			
			if ( $values['chatbox_clearchat'] == 1 )
			{
				\IPS\Db::i()->delete( 'bimchatbox_chat', null );			
			}			
			unset( $values['chatbox_clearchat'] );

			$form->saveAsSettings( $values );
			
			\IPS\Output::i()->redirect( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : \IPS\Http\Url::internal( '' ) );
		}
		
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack('chatbox_manage') );
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('chatbox_manage');		
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'chat' )->manage($form);
	}
		
	/*-------------------------------------------------------------------------*/
	// Chatbox management
	/*-------------------------------------------------------------------------*/		
	protected function chatrules()
	{
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack('chatbox_rules_title') );
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('chatbox_rules_title');		
		\IPS\Output::i()->output	= \IPS\Text\Parser::parseStatic( \IPS\Settings::i()->chatbox_conf_announcements );
	}
	
	/*-------------------------------------------------------------------------*/
	// Chat
	/*-------------------------------------------------------------------------*/		
	protected function chat()
	{
		\IPS\Session::i()->csrfCheck();
		
		# Force using ajax
		if ( ! \IPS\Request::i()->isAjax() )
		{
			\IPS\Output::i()->error( 'chatbox_error_noajax', '2BIMCB101/3', 403, '' );
		}
		
		# Can chat or not?
		if ( ! \IPS\Application::load('bimchatbox')->can_Chat() || \in_array(\IPS\Member::loggedIn()->member_id, explode(",", \IPS\Settings::i()->chatbox_conf_blocklist)) )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_cannotchat' ) ) );
			exit;			
		}	
		
		# Check flood limit
		if ( \IPS\Settings::i()->chatbox_conf_floodlimit > 0 && ! \IPS\Application::load('bimchatbox')->can_Manage() )
		{
			try
			{
				$lastChat = \IPS\Db::i()->select( '*', 'bimchatbox_chat', 'user=' . \IPS\Member::loggedIn()->member_id, 'time DESC', 1 )->first();
			}
			catch ( \UnderflowException $e ) {}
			
			if ( time() - $lastChat['time'] < \IPS\Settings::i()->chatbox_conf_floodlimit )
			{
				$wait = \IPS\Settings::i()->chatbox_conf_floodlimit - ( time() - $lastChat['time'] );
				\IPS\Output::i()->json( array( 'type' => 'error', 'message' => sprintf( \IPS\Member::loggedIn()->language()->get( 'chatbox_error_flood' ), $wait ) ) );
				exit;
			}
		}
		
		# Check msg
		if ( ! \IPS\Request::i()->txt  )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_nomsg' ) ) );
			exit;
		}	

		$txt = $this->chatboxText( \IPS\Request::i()->txt );

		# Update database
		$id = \IPS\Db::i()->insert( 'bimchatbox_chat', array(
				'user'		=> \IPS\Member::loggedIn()->member_id,
				'chat'		=> $txt,
				'time'		=> time(),
		) );		
		
		# Ouput		
		\IPS\Output::i()->json( 'OK' );	
	}
	
	/*-------------------------------------------------------------------------*/
	// getMessages
	/*-------------------------------------------------------------------------*/		
	protected function getmsg()
	{		
		\IPS\Session::i()->csrfCheck();
		
		# Force using ajax
		if ( ! \IPS\Request::i()->isAjax() )
		{
			\IPS\Output::i()->error( 'chatbox_error_noajax', '2BIMCB101/4', 403, '' );
		}

		# Value
		$lastID = \IPS\Request::i()->lastID ? \intval( \IPS\Request::i()->lastID ) : 0;
		$user = \IPS\Member::loggedIn()->member_id ? \IPS\Member::loggedIn()->member_id : 0;
		$maxRow = \IPS\Request::i()->loadMoreMode == 1 ? 10 : \IPS\Settings::i()->chatbox_conf_chatlimit;
		$where = array(); 
		
		# Ignore users
		if( \IPS\Member::loggedIn()->member_id )
		{
			$ignored = iterator_to_array( \IPS\Db::i()->select( 'ignore_ignore_id, ignore_id', 'core_ignored_users', array( 'ignore_owner_id=? and ignore_chatbox=1', \IPS\Member::loggedIn()->member_id ) )->setValueField( 'ignore_ignore_id' ) );
		}

		if ( \count($ignored) > 0 )
		{
			$where[] = array( 'user NOT IN(' . implode(",",$ignored) . ')' );
		}
		
		# Select newer ID
		if ( \IPS\Request::i()->loadMoreMode == 1 )
		{
			$where[] = array( 'id<?', $lastID );
		}
		else
		{
			$where[] = array( 'id>?', $lastID );
		}
		
		foreach ( \IPS\Db::i()->select( '*', 'bimchatbox_chat', $where, 'id DESC', array( 0, $maxRow ) ) as $k => $row )
		{
			$cnt++;
			if ( $cnt == 1 )
			{				
				$newLastID = $row['id'];
			}
			$chats[] = $row;
		}	
		
		# Ouput	
		$data = null;
		if ( \count( $chats ) > 0 )
		{
			$chats = \IPS\Settings::i()->chatbox_conf_ordertop != 1 ? array_reverse($chats) : $chats;
			
			foreach( $chats as $chat )
			{
				try
				{					
					$member = \IPS\Member::load( $chat['user'] );
					$nameFormat = $member->member_group_id ? \IPS\Member\Group::load( $member->member_group_id )->formatName( $member->name ) : $member->name;
				}
				catch( \OutOfRangeException $e ){}					
				
				$photo = \IPS\Settings::i()->chatbox_conf_hidePhoto != 1 ? $member->photo : false;
				$canEdit = ( \IPS\Application::load('bimchatbox')->can_Edit($chat['user']) || \IPS\Application::load('bimchatbox')->can_Manage() ) ? 1 : false;
				$canDelete = ( \IPS\Application::load('bimchatbox')->can_Delete() || \IPS\Application::load('bimchatbox')->can_Manage() ) ? 1 : false;
				
				$new[] = 	$chat['id'] . "~~#~~" .
							$chat['user']. "~~#~~" .		
							$member->name . "~~#~~" .
							$nameFormat . "~~#~~" . 							
							$photo . "~~#~~" .		
							$member->url(). "~~#~~" .
							$chat['chat'] . "~~#~~" . 
							$chat['time'] . "~~#~~" . 
							$canEdit . "~~#~~" . 
							$canDelete;
			}
			
			$data = implode( "~~||~~", $new );
		}
		
		\IPS\Output::i()->json( array( 'content' => $data, 'lastID' => $newLastID, 'total' => $cnt ) );	
	}
	
	/*-------------------------------------------------------------------------*/
	// Msg ID
	/*-------------------------------------------------------------------------*/	
	protected function msgID( $id )
	{
		try
		{
			$chat = \IPS\Db::i()->select( '*', 'bimchatbox_chat', 'id=' . (int) $id, 'id DESC', 1 )->first();
		}
		catch ( \UnderflowException $e ) {}		
		
		if ( !$chat['id']  )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_nodata' ) ) );
			exit;			
		}	

		return $chat;
	}
	
	/*-------------------------------------------------------------------------*/
	// Delete
	/*-------------------------------------------------------------------------*/		
	protected function delete()
	{
		\IPS\Session::i()->csrfCheck();
		
		# Can manage?
		if ( ! \IPS\Application::load('bimchatbox')->can_Delete() && ! \IPS\Application::load('bimchatbox')->can_Manage() )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_notmoderator' ) ) );
			exit;			
		}
		
		# msg
		$chat = $this->msgID( \IPS\Request::i()->id );
		
		# Delete
		\IPS\Db::i()->delete( 'bimchatbox_chat', array( 'id=?', $chat['id'] ) );

		# Done
		\IPS\Output::i()->json( array( 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_deleted' ) ) );	
	}
	
	/*-------------------------------------------------------------------------*/
	// Edit
	/*-------------------------------------------------------------------------*/		
	protected function edit()
	{	
		\IPS\Session::i()->csrfCheck();	
		
		# msg
		$chat = $this->msgID( \IPS\Request::i()->id );			
		
		# Can manage?
		if ( ! \IPS\Application::load('bimchatbox')->can_Edit( $chat['user'] ) && ! \IPS\Application::load('bimchatbox')->can_Manage() )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_notmoderator' ) ) );
			exit;			
		}
		
		# Done
		\IPS\Output::i()->json( array( 'content' => trim( strip_tags( $chat['chat'] ) ) ) );	
	}

	protected function saveMSG()
	{		
		\IPS\Session::i()->csrfCheck();	
		
		# msg
		$chat = $this->msgID( \IPS\Request::i()->id );	
		
		# Can manage?
		if ( ! \IPS\Application::load('bimchatbox')->can_Edit($chat['user']) && ! \IPS\Application::load('bimchatbox')->can_Manage() )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_notmoderator' ) ) );
			exit;			
		}
		
		# Before saving 
		if ( ! \IPS\Request::i()->txt  )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_error_nomsg' ) ) );
			exit;			
		}	

		$txt = $this->chatboxText( \IPS\Request::i()->txt );
		
		\IPS\Db::i()->update( 'bimchatbox_chat', array( 'chat' => $txt ), array( 'id=?', $chat['id'] ) );
		
		# Done
		\IPS\Output::i()->json( array( 'message' => \IPS\Member::loggedIn()->language()->get( 'chatbox_saved' ), 'txt' => $txt ) );	
	}	
	
	/*-------------------------------------------------------------------------*/
	// What what what is the text @_@
	/*-------------------------------------------------------------------------*/
	public static $plugins = NULL;
	
	public function chatboxText($txt)
	{	
		# Remove tags
		$txt = urldecode($txt);
		$txt = htmlspecialchars( $txt, ENT_DISALLOWED, 'UTF-8', FALSE );		
		$txt = str_replace( "~~||~~", "", $txt );
		$txt = str_replace( "~~#~~", "", $txt );
		if ( mb_strpos( $txt, "~~||~~" ) !== false || mb_strpos( $txt, "~~#~~" ) !== false )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => sprintf( \IPS\Member::loggedIn()->language()->get( 'chatbox_error_nomsg' ) ) ) );
			exit;			
		}
		
		# Check length
		if ( \IPS\Settings::i()->chatbox_conf_maxlength && mb_strlen($txt) > \IPS\Settings::i()->chatbox_conf_maxlength )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => sprintf( \IPS\Member::loggedIn()->language()->get( 'chatbox_error_maxlength' ) ) ) );
			exit;				
		}
		
		# Img proxy
		if ( \IPS\Settings::i()->remote_image_proxy )
		{	
			preg_match("~https?://\S+\.(?:jpe?g|gif|png|webp)(?:\?\S*)?(?=\s|$|\pP)~i", $txt, $img);
			$imageSrc = new \IPS\Http\Url( $img[0] );
			
			if ( !$imageSrc->isInternal and !$imageSrc->isLocalhost() && $imageSrc->data[ \IPS\Http\Url::COMPONENT_SCHEME ] != 'https' ) 
			{
				$newUrl = \IPS\Http\Url::createFromString( \IPS\Settings::i()->base_url . "applications/core/interface/imageproxy/imageproxy.php" );
				$newUrl = $newUrl->setQueryString( array(
					'key'	=> hash_hmac( "sha256", (string) $imageSrc, \IPS\Settings::i()->site_secret_key ),
					'img' 	=> str_replace( ',', '%2C', (string) $imageSrc ) /* srcset URLs can have a param like resize=150,150 and the comma breaks the URLs */
				) );				
				$newIMG = (string) $newUrl;
				$txt = str_replace($img[0], $newIMG, $txt);
			}
		}
		
		return $txt;
	}
	
	/*-------------------------------------------------------------------------*/
	// Play video
	/*-------------------------------------------------------------------------*/		
	protected function playvideo()
	{
		$source = \IPS\Request::i()->source;
		$id = \IPS\Request::i()->id;
		
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack('chatbox_playvideo') );
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('chatbox_playvideo');		
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'chat' )->video($source, $id);
	}	
}