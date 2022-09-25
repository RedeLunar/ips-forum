<?php


namespace IPS\bimchatbox\setup\upg_120001;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 1.2.1 Upgrade Code
 */
class _Upgrade
{
	/**
	 * ...
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		if( !\IPS\Db::i()->checkForColumn( 'core_ignored_users', 'ignore_chatbox' ) )
		{
			\IPS\Db::i()->addColumn( 'core_ignored_users', array(
				'name'			=> 'ignore_chatbox',
				'type'			=> 'INT',
				'length'		=> 1,
				'allow_null'	=> true,
				'default'		=> 0,
				'comment'		=> ''			
			) );
		}		
		@unlink( \IPS\ROOT_PATH . "/applications/bimchatbox/interface/chat/chatbox120.js" );
		return TRUE;
	}
	
	// You can create as many additional methods (step2, step3, etc.) as is necessary.
	// Each step will be executed in a new HTTP request
}