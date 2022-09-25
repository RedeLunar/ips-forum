<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */
 
namespace IPS\autowelcome\setup\upg_100001;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _Upgrade
{
	public function step1()
	{
	    /* Delete old IPB 3.4.x settings. */
        \IPS\Db::i()->delete( 'core_sys_conf_settings', "conf_key IN( 'aw_shoutbox_message', 'aw_shoutbox_author', 'aw_shoutbox', 'aw_profile_comments', 'aw_points_field', 'aw_points_factor', 'aw_points_database', 'aw_pm_system_pm', 'aw_pin_topics', 'aw_enable_points', 'aw_debug_mode', 'aw_comment_message', 'aw_comment_author', 'aw_close_topics' )" );    

        /* Force new setting changes */
        \IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => \IPS\Member::loggedIn()->member_id ), array( 'conf_key=?', 'aw_email_from' ) );
        \IPS\Db::i()->update( 'core_sys_conf_settings', array( 'conf_value' => \IPS\Member::loggedIn()->member_id ), array( 'conf_key=?', 'aw_topic_author' ) );

        /* Re-enable app again */
        \IPS\Db::i()->update( 'core_applications', array( 'app_enabled' => 1 ), array( 'app_directory=?', 'autowelcome' ) );    
        
        /* Let's name this differently */
        \IPS\Lang::saveCustom( 'autowelcome', '__app_autowelcome', 'Auto Welcome' ); 
        
         /* Convert translatable settings */
    	foreach ( array( 'aw_pm_subject' => 'aw_pm_subject_value', 'aw_pm_message' => 'aw_pm_message_value', 'aw_email_subject' => 'mailsub__autowelcome_welcomeEmail', 'aw_email_message' => 'aw_email_message_value', 'aw_topic_title' => 'aw_topic_title_value', 'aw_topic_message' => 'aw_topic_message_value' ) as $k => $v )
    	{
    		\IPS\Lang::saveCustom( 'autowelcome', $v, \IPS\Settings::i()->$k );
    	}           
                
		return true;
	}
}