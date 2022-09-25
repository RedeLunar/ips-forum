<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */

namespace IPS\autowelcome\extensions\core\Uninstall;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Uninstall callback
 */
class _Autowelcome
{
	/**
	 * Code to execute after the application has been uninstalled
	 *
	 * @param	string	$application	Application directory
	 * @return	array
	 */
	public function postUninstall( $application )
	{
        /* Remove table alters */
        if( \IPS\Db::i()->checkForColumn( 'core_members', 'member_welcome' ) )
        {
            \IPS\Db::i()->dropColumn( 'core_members', array( 'member_welcome' ) );
        }
    }
}