<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */
 
namespace IPS\autowelcome;

/**
 * Auto Welcome Application Class
 */
class _Application extends \IPS\Application
{
    /**
     * Install 'other' items.
     *
     * @return void
     */
    public function installOther()
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

        /* Insert custom lang fields */
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_pm_subject_value', "Welcome to %board_name%" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_pm_message_value', "<p>Hello %member_name%, </p><p>Welcome to %board_name%. Please feel free to browse around and get to know the others. If you have any questions please don't hesitate to ask.</p><p>%board_name%</p>" );
        \IPS\Lang::saveCustom( 'autowelcome', 'mailsub__autowelcome_welcomeEmail', "Welcome" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_email_message_value', "<p>Hello %member_name%, </p><p>Welcome to %board_name%. Please feel free to browse around and get to know the others. If you have any questions please don't hesitate to ask.</p><p>%board_name%</p>" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_topic_title_value', "Welcome %member_name%" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_topic_message_value', "<p>Hello %member_name%, </p><p>Welcome to %board_name%. Please feel free to browse around and get to know the others. If you have any questions please don't hesitate to ask.</p><p>%member_name% joined on the %joined_date%.</p><p>%profile_link%</p>" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_chat_message_value', "Welcome %member_name%!" );
        \IPS\Lang::saveCustom( 'autowelcome', 'aw_status_message_value', "<p>Welcome to %board_name%. Please feel free to browse around and get to know the others. If you have any questions please don't hesitate to ask.</p>" );

        /* Setup alert authors */
        \IPS\Settings::i()->changeValues( array( 'aw_pm_from' => \IPS\Member::loggedIn()->member_id, 'aw_email_from' => \IPS\Member::loggedIn()->member_id, 'aw_topic_author' => \IPS\Member::loggedIn()->member_id, 'aw_status_author' => \IPS\Member::loggedIn()->member_id, 'aw_chat_author' => \IPS\Member::loggedIn()->member_id ) );

        /* Update settings with first avaliable forum */
        try
        {
            $forumId = \IPS\Db::i()->select( 'id', 'forums_forums', array( 'sub_can_post=?', 1 ) )->first();
            \IPS\Settings::i()->changeValues( array( 'aw_topic_forum' => $forumId ) );
        }
        catch( \UnderflowException $e) {}
    }

    /**
     * [Node] Get Icon for tree
     *
     * @note	Return the class for the icon (e.g. 'globe')
     * @return	string|null
     */
    protected function get__icon()
    {
        return 'user';
    }
}