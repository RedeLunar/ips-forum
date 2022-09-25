<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */
 
namespace IPS\autowelcome\Alerts;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _Alerts
{
    public function no()
    {

    }

	/**
	 * Create topic
	 */      
	public static function _createTopic( $member )
	{
	    /* Exclude IPS account */
	    if( $member->email == 'nobody@invisionpower.com' )
        {
            return NULL;
        }

        /* Forums enabled? */
		if ( ! \IPS\Application::appIsEnabled( 'forums' ) )
		{
            return NULL;
		} 
        
        /* Topic alert enabled */
        if( !\IPS\Settings::i()->aw_enable_topic )
        {
            return NULL;
        }               
        
        /* By default member is the topic/post author */
        $author = $member;
        
        /* Override topic author with set address */
        if( !\IPS\Settings::i()->aw_topic_own )
        {
            $author = \IPS\Member::load( \IPS\Settings::i()->aw_topic_author );    
        }

		/* Fetch the forum if new topic */
		if( !\IPS\Settings::i()->aw_post_reply )
        {
            try
            {
                $forum = \IPS\forums\Forum::load( \intval( \IPS\Settings::i()->aw_topic_forum ) );
            }
            catch( \OutOfRangeException $ex )
            {
                return NULL;
            }
        }

		/* Get tag values */
		$tags = self::returnTagValues( $member );
        
		/* Format post content */
        $topicTitle  = \IPS\Member::loggedIn()->language()->addToStack( 'aw_topic_title_value' );
        $postContent = \IPS\Theme::i()->getTemplate( 'global', 'autowelcome', 'global' )->topic( $member );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $topicTitle );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $postContent );
        
        /* Swap out our tags */
		foreach( $tags as $key => $value )
		{
			$postContent = str_replace( $key, $value, $postContent );
            $topicTitle  = str_replace( $key, $value, $topicTitle );
		}
        
        /* Create a topic? */
        if( \IPS\Settings::i()->aw_post_reply )
        {
			/* Get */
			try
			{
				$topic = \IPS\forums\Topic::load( \IPS\Settings::i()->aw_welcome_topic );
				if ( !$topic )
				{
					return NULL;
				}

        		/* Create post */
        		$post = \IPS\forums\Topic\Post::create( $topic, $postContent, TRUE, NULL, NULL, $author );
			}
			catch ( \OutOfRangeException $e )
			{
                return NULL;
			}
        }
        else
        {
    		/* Create topic */
    		$topic = \IPS\forums\Topic::createItem( $author, $author->ip_address, \IPS\DateTime::ts( time() ), $forum, FALSE );
    		$topic->title = $topicTitle;
    		$topic->topic_archive_status = \IPS\forums\Topic::ARCHIVE_EXCLUDE;
            $topic->pinned = ( \IPS\Settings::i()->aw_topic_settings && mb_strpos( \IPS\Settings::i()->aw_topic_settings, 'pin' ) !== false ) ? TRUE : FALSE;
            $topic->state  = ( \IPS\Settings::i()->aw_topic_settings && mb_strpos( \IPS\Settings::i()->aw_topic_settings, 'close' ) !== false ) ? 'closed' : 'open';                
    		$topic->save();
    		
    		/* Create post */
    		$post = \IPS\forums\Topic\Post::create( $topic, $postContent, TRUE, NULL, NULL, $author );
    		$topic->topic_firstpost = $post->pid;
    		$topic->save();            
        }

        return $topic;
	}
    
	/**
	 * Send email
	 */   
	public static function _sendEmail( $member, $topic=NULL )
	{
        /* Email alert enabled */
        if( !\IPS\Settings::i()->aw_enable_email )
        {
            return;   
        }

        /* Admin emails allowed? */
        if( !$member->allow_admin_mails )
        {
            return;
        }
        
		/* Get tag values */
		$tags = self::returnTagValues( $member, $topic );
        
        /* Setup email body */
        $emailContent = \IPS\Member::loggedIn()->language()->addToStack( 'aw_email_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $emailContent );
                
        /* Swap out our tags */
		foreach( $tags as $key => $value )
		{
            $emailContent = str_replace( $key, $value, $emailContent );
		}      
                 
        /* Setup email send */ 
		$email = \IPS\Email::buildFromTemplate( 'autowelcome', 'welcomeEmail', array( \IPS\Member::loggedIn(), $emailContent ) );

        /* Send from specific member? */
        if( \IPS\Settings::i()->aw_email_from )
        {
            $sender = \IPS\Member::load( \intval( \IPS\Settings::i()->aw_email_from ) );
    		$email->from = $sender->email;
        }

        /* Now send */
		$email->send( $member );        
	}  

	/**
	 * Send pm
	 */      
	public static function _sendPM( $member, $topic=NULL )
	{
        /* Exclude IPS account */
        if( $member->email == 'nobody@invisionpower.com' )
        {
            return;
        }

        /* PM alert enabled */
        if( !\IPS\Settings::i()->aw_enable_pm )
        {
            return;   
        }   
        
		/* Get tag values */
		$tags = self::returnTagValues( $member, $topic );
        
        /* Setup pm title and msg */
        $msgTitle = \IPS\Member::loggedIn()->language()->addToStack( 'aw_pm_subject_value' );
        $msgPost  = \IPS\Member::loggedIn()->language()->addToStack( 'aw_pm_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgTitle );        
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $msgPost );  
        
        /* Swap out our tags */
		foreach( $tags as $key => $value )
		{
            $msgTitle = str_replace( $key, $value, $msgTitle );
            $msgPost  = str_replace( $key, $value, $msgPost );            
		}       
        
        /* Set pm sender */
		try
		{
			$pmSender = \IPS\Member::load( \IPS\Settings::i()->aw_pm_from );
		}
		catch( \OutOfRangeException $ex )
		{
            return; 
		} 
        
        /* What do you think your doing? */
        if( !$pmSender->member_id )
        {
            return;
        }            

        /* Create conversation */        
   		$conversation = \IPS\core\Messenger\Conversation::createItem( $pmSender, $pmSender->ip_address, \IPS\DateTime::ts( time() ) );
        $conversation->title = $msgTitle;
        $conversation->to_member_id = $member->member_id;
        $conversation->save();

        /* Add message */
        $message = \IPS\core\Messenger\Message::create( $conversation, $msgPost, TRUE, NULL, NULL, $pmSender );
        $conversation->first_msg_id = $message->id;
        $conversation->save();

 		/* Authorize everyone */
        $conversation->authorize( $member );
        $conversation->authorize( $pmSender );

        /* Send notification */
		$notification = new \IPS\Notification( \IPS\Application::load('core'), 'private_message_added', $conversation, array( $conversation, $pmSender ) );
		$notification->send();

        /* Little work around to set new PM flag */
        $member->msg_count_reset = time() - 1;
        \IPS\core\Messenger\Conversation::rebuildMessageCounts( $member );
	} 
    
	/**
	 * Send status update
	 */      
	public static function _sendStatus( $member, $topic=NULL )
	{
        /* Exclude IPS account */
        if( $member->email == 'nobody@invisionpower.com' )
        {
            return;
        }

        /* Status alert enabled */
        if( !\IPS\Settings::i()->aw_status_enable )
        {
            return;   
        }

        /* Status updates enabled? */
        if ( !\IPS\Settings::i()->profile_comments )
        {
            return;
        }

        /* Can member view status updates? */
        if( $member->members_bitoptions['bw_no_status_update'] OR $member->group['gbw_no_status_update'] )
        {
            return;
        }

		/* Get tag values */
		$tags = self::returnTagValues( $member, $topic );
        
        /* Setup status message */
        $statusMessage  = \IPS\Member::loggedIn()->language()->addToStack( 'aw_status_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $statusMessage );  

        /* Swap out our tags */
		foreach( $tags as $key => $value )
		{
            $statusMessage = str_replace( $key, $value, $statusMessage );           
		}       
        
        /* Set status sender */
		try
		{
			$statusSender = \IPS\Member::load( \IPS\Settings::i()->aw_status_author );
		}
		catch( \OutOfRangeException $ex )
		{
            return; 
		} 
        
        /* What do you think your doing? */
        if( !$statusSender->member_id )
        {
            return;
        }

        /* This ensures member receives status update */
        \IPS\Request::i()->id = $member->member_id;

        /* Create status and make sure author and member ids are set */
        $values['status_content'] = $statusMessage;
        $status = \IPS\core\Statuses\Status::createFromForm( $values, NULL, FALSE );
        $status->author_id = $statusSender->member_id;
        $status->member_id = $member->member_id;
        $status->save();

        /* Send notifications */
        if ( !$status->isFutureDate() )
        {
            if ( !$status->hidden() )
            {
                $status->sendNotifications();
            }
            else if( $status instanceof \IPS\Content\Hideable and $status->hidden() !== -1 )
            {
                $status->sendUnapprovedNotification();
            }
        }

        /* Reindex so the author values are set properly */
        \IPS\Content\Search\Index::i()->index( $status );
	}

    /**
     * Send welcome chat
     */
    public static function _sendChat( $member, $topic=NULL )
    {
        /* Exclude IPS account */
        if( $member->email == 'nobody@invisionpower.com' )
        {
            return;
        }

        /* Chatbox enabled? */
        if ( ! \IPS\Application::appIsEnabled( 'bimchatbox' ) )
        {
            return;
        }

        /* Chat alert enabled */
        if( !\IPS\Settings::i()->aw_chat_enable )
        {
            return;
        }

        /* Get tag values */
        $tags = self::returnTagValues( $member, $topic );

        /* Setup status message */
        $chatMessage  = \IPS\Member::loggedIn()->language()->addToStack( 'aw_chat_message_value' );
        \IPS\Member::loggedIn()->language()->parseOutputForDisplay( $chatMessage );

        /* Swap out our tags */
        foreach( $tags as $key => $value )
        {
            $chatMessage = str_replace( $key, $value, $chatMessage );
        }

        /* Set chat sender */
        try
        {
            $chatSender = \IPS\Member::load( \IPS\Settings::i()->aw_chat_author );
        }
        catch( \OutOfRangeException $ex )
        {
            return;
        }

        /* What do you think your doing? */
        if( !$chatSender->member_id )
        {
            return;
        }

        /* Insert chat to database */
        \IPS\Db::i()->insert( 'bimchatbox_chat', array(
            'user'		=> $chatSender->member_id,
            'chat'		=> $chatMessage,
            'time'		=> time(),
        ) );
    }
    
	/**
	 * Retrieve the tags that are used in alerts
	 *
	 * @return	array 	An array of tags in foramt of 'tag' => 'explanation text'
	 */
	public static function getTags()
	{
		/* Setup tags */
		$tags = array(
			'%member_name%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_member_name'),
			'%member_id%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_member_id'),
            '%member_link%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_member_link'),
			'%board_name%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_board_name'),
			'%joined_date%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_joined_date'),
			'%profile_link%' => \IPS\Member::loggedIn()->language()->addToStack('awtag_profile_link'),
			'%topic_link%'	 => \IPS\Member::loggedIn()->language()->addToStack('awtag_topic_link'),
		);

		return $tags;
	} 
    
	/**
	 * Return tag values
	 *
	 * @param	NULL|\IPS\Member	$member	Member object
     * @param	NULL|\IPS\Topic	$topic	Topic object
	 * @return	array
	 */
	protected static function returnTagValues( $member=NULL, $topic=NULL )
	{
	    /* Default tags */
		$tags['%member_name%']	= $member->name;
		$tags['%member_id%']	= $member->member_id;
        $tags['%member_link%']	= "<a class='ipsCursor_pointer' data-ipshover=\"\" data-ipshover-target='{$member->url()->setQueryString('do', 'hovercard')}' data-mentionid=\"{$member->member_id}\" href=\"{$member->url()}\" contenteditable=\"false\">{$member->name}</a>";
		$tags['%board_name%']	= \IPS\Settings::i()->board_name;
		$tags['%joined_date%']	= $member->joined->localeDate();
		$tags['%profile_link%']	= "<a href=".$member->url().">".\IPS\Member::loggedIn()->language()->get('view_member')."</a>";
		
        /* Topic tag */
        if( isset( $topic ) AND $topic->tid )
        {
            $tags['%topic_link%'] = "<a href='".\IPS\Http\Url::internal( 'app=forums&module=forums&controller=topic&id=' . $topic->tid, 'front', 'forums_topic', $topic->title_seo )."'>{$topic->title}</a>";
        }
        else
        {
            $tags['%topic_link%'] = '';    
        }

		return $tags;
	}             
}
