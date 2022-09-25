<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */

namespace IPS\autowelcome\setup\upg_100104;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 2.5.4 Upgrade Code
 */
class _Upgrade
{
	/**
	 * Step 1
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
        /* Add member flag and then change default value */
        try
        {
            if( !\IPS\Db::i()->checkForColumn( 'core_members', 'member_welcome' ) )
            {
                \IPS\Db::i()->addColumn( 'core_members', array(
                    "name"		=> "member_welcome",
                    "type"		=> "TINYINT",
                    "length"	=> 1,
                    "default"	=> 1,
                )	);
            }

            if( \IPS\Db::i()->checkForColumn( 'core_members', 'member_welcome' ) )
            {
                \IPS\Db::i()->changeColumn( 'core_members', 'member_welcome', array(
                    'name'		=> 'member_welcome',
                    'type'		=> 'tinyint',
                    "length"	=> 1,
                    'default'	=> 0
                ) );
            }
        }
        catch( \IPS\Db\Exception $e ){}

        return TRUE;
	}
}