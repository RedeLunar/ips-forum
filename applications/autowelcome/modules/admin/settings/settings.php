<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */

namespace IPS\autowelcome\modules\admin\settings;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'settings_manage' );
		parent::execute();
	}

	/**
	 * Manage Settings
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('settings');

		$form = new \IPS\Helpers\Form;
        
		/* Get tags */
		$tags = \IPS\autowelcome\Alerts\Alerts::getTags();

		/* Get group list */
        $groups = array();
        foreach ( \IPS\Member\Group::groups() as $group )
        {
            $groups[ $group->g_id ] = $group->name;
        }
        $groupsExcludingGuests = $groups;
        unset( $groupsExcludingGuests[ \IPS\Settings::i()->guest_group ] );

        /* General Settings */
        $form->addTab( 'aw_general_settings_tab' );
        $form->addHeader( 'aw_general_settings_header' );
        $form->add( new \IPS\Helpers\Form\Number( 'aw_welcome_delay', \IPS\Settings::i()->aw_welcome_delay, FALSE, array( 'unlimited' => 0, 'unlimitedLang' => 'aw_welcome_delay_unlimitedLang', 'unlimitedToggles' => array( 'aw_skip_validating', 'aw_welcome_groups' ), 'unlimitedToggleOn' => FALSE ), NULL, NULL, \IPS\Member::loggedIn()->language()->addToStack('aw_welcome_delay_hours'), 'aw_welcome_delay' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_skip_validating', \IPS\Settings::i()->aw_skip_validating, FALSE, array(), NULL, NULL, NULL, 'aw_skip_validating' ) );
        $form->add( new \IPS\Helpers\Form\Select( 'aw_welcome_groups', ( \IPS\Settings::i()->aw_welcome_groups AND \IPS\Settings::i()->aw_welcome_groups != '*' ) ? explode( ',', \IPS\Settings::i()->aw_welcome_groups ) : '*', TRUE, array( 'options' => $groupsExcludingGuests, 'multiple' => TRUE, 'unlimited' => '*', 'unlimitedLang' => 'aw_welcome_groups_unlimitedLang' ), NULL, NULL, NULL, 'aw_welcome_groups' ) );

        /* PM Settings */
        $form->addTab( 'aw_pm_settings' );
        $form->addHeader( 'aw_pm_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_enable_pm', \IPS\Settings::i()->aw_enable_pm, FALSE, array(), NULL, NULL, NULL, 'aw_enable_pm' ) );
        /* Disable as PM system doesn't seem to like no sender - $form->add( new \IPS\Helpers\Form\YesNo( 'aw_pm_system', \IPS\Settings::i()->aw_pm_system, FALSE, array(), NULL, NULL, NULL, 'aw_pm_system' ) ); */
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_pm_subject', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_pm_subject_value' ), NULL, NULL, NULL, 'aw_pm_subject' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'aw_pm_from', ( \IPS\Settings::i()->aw_pm_from ) ? \IPS\Member::load( \IPS\Settings::i()->aw_pm_from ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'aw_pm_from' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_pm_message', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_pm_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'aw_pm_message', 'attachIds' => array( NULL, NULL, 'aw_pm_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'aw_pm_message' ) );

        /* Email Settings */
        $form->addTab( 'aw_email_settings' );
        $form->addHeader( 'aw_email_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_enable_email', \IPS\Settings::i()->aw_enable_email, FALSE, array(), NULL, NULL, NULL, 'aw_enable_email' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_email_subject', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'mailsub__autowelcome_welcomeEmail' ), NULL, NULL, NULL, 'aw_email_subject' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'aw_email_from', ( \IPS\Settings::i()->aw_email_from ) ? \IPS\Member::load( \IPS\Settings::i()->aw_email_from ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'aw_email_from' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_email_message', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_email_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'aw_email_message', 'attachIds' => array( NULL, NULL, 'aw_email_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'aw_email_message' ) );

        /* Topic Settings */
        $form->addTab( 'aw_topic_settings_header' );
        $form->addHeader( 'aw_topic_settings_header' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_enable_topic', \IPS\Settings::i()->aw_enable_topic, FALSE, array(), NULL, NULL, NULL, 'aw_enable_topic' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_topic_own', \IPS\Settings::i()->aw_topic_own, FALSE, array( 'togglesOff' => array( 'aw_topic_author' ) ), NULL, NULL, NULL, 'aw_topic_own' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_post_reply', \IPS\Settings::i()->aw_post_reply, FALSE, array( 'togglesOn' => array( 'aw_welcome_topic' ), 'togglesOff' => array( 'aw_topic_settings', 'aw_topic_title', 'aw_topic_forum' ) ), NULL, NULL, NULL, 'aw_post_reply' ) );
        $form->add( new \IPS\Helpers\Form\Item( 'aw_welcome_topic', \IPS\Settings::i()->aw_welcome_topic, FALSE, array(
            'class'     => '\IPS\forums\Topic',
            'maxItems'  => 1
        ), NULL, NULL, NULL, 'aw_welcome_topic' ) );

        $form->add( new \IPS\Helpers\Form\CheckboxSet( 'aw_topic_settings', \IPS\Settings::i()->aw_topic_settings, FALSE, array(
			'options' 	=> array( 'pin' => 'aw_pin_topic', 'close' => 'aw_close_topic' ),
		), NULL, NULL, NULL, 'aw_topic_settings' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'aw_topic_author', ( \IPS\Settings::i()->aw_topic_author ) ? \IPS\Member::load( \IPS\Settings::i()->aw_topic_author ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'aw_topic_author' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_topic_title', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_topic_title_value' ), NULL, NULL, NULL, 'aw_topic_title' ) );
        $form->add( new \IPS\Helpers\Form\Node( 'aw_topic_forum', \IPS\Settings::i()->aw_topic_forum ?: NULL, FALSE, array( 'class' => 'IPS\forums\Forum', 'multiple' => FALSE, 'permissionCheck' => function ( $forum ) { return $forum->sub_can_post and !$forum->redirect_url; } ), NULL, NULL, NULL, 'aw_topic_forum' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_topic_message', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_topic_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'aw_topic_message', 'attachIds' => array( NULL, NULL, 'aw_topic_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'aw_topic_message' ) );

        /* Status Settings */
        $form->addTab( 'autowelcome_status_settings' );
        $form->addHeader( 'autowelcome_status_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_status_enable', \IPS\Settings::i()->aw_status_enable, FALSE, array( 'disabled' => ( \IPS\Settings::i()->profile_comments ) ? FALSE : TRUE ), NULL, NULL, NULL, 'aw_status_enable' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'aw_status_author', ( \IPS\Settings::i()->aw_status_author ) ? \IPS\Member::load( \IPS\Settings::i()->aw_status_author ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'aw_status_author' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_status_message', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_status_message_value', 'editor' => array( 'app' => 'core', 'key' => 'Admin', 'autoSaveKey' => 'aw_status_message', 'attachIds' => array( NULL, NULL, 'aw_status_message' ), 'tags' => $tags ) ), NULL, NULL, NULL, 'aw_status_message' ) );

        /* Chat Settings */
        $form->addTab( 'autowelcome_chat_settings' );
        $form->addHeader( 'autowelcome_chat_settings' );
        $form->add( new \IPS\Helpers\Form\YesNo( 'aw_chat_enable', \IPS\Settings::i()->aw_chat_enable, FALSE, array( 'disabled' => ( \IPS\Application::appIsEnabled('bimchatbox') ) ? FALSE : TRUE ), NULL, NULL, NULL, 'aw_chat_enable' ) );
        $form->add( new \IPS\Helpers\Form\Member( 'aw_chat_author', ( \IPS\Settings::i()->aw_chat_author ) ? \IPS\Member::load( \IPS\Settings::i()->aw_chat_author ) : \IPS\Member::loggedIn(), FALSE, array(), NULL, NULL, NULL, 'aw_chat_author' ) );
        $form->add( new \IPS\Helpers\Form\Translatable( 'aw_chat_message', NULL, FALSE, array( 'app' => 'autowelcome', 'key' => 'aw_chat_message_value', 'textArea' => TRUE ), NULL, NULL, NULL, 'aw_chat_message' ) );

		if ( $values = $form->values() )
		{
		    /* Save translatable fields */
			foreach ( array( 'aw_pm_subject' => 'aw_pm_subject_value', 'aw_pm_message' => 'aw_pm_message_value', 'aw_email_subject' => 'mailsub__autowelcome_welcomeEmail', 'aw_email_message' => 'aw_email_message_value', 'aw_topic_title' => 'aw_topic_title_value', 'aw_topic_message' => 'aw_topic_message_value', 'aw_status_message' => 'aw_status_message_value', 'aw_chat_message' => 'aw_chat_message_value' ) as $k => $v )
			{
				\IPS\Lang::saveCustom( 'autowelcome', $v, $values[ $k ] );
				unset( $values[ $k ] );
			}	

			/* Process various settings */
			if ( !empty( $values[ 'aw_pm_from' ] ) and $values[ 'aw_pm_from' ]->member_id )
			{
				$values[ 'aw_pm_from' ] = $values[ 'aw_pm_from' ]->member_id;
			}

			if ( !empty( $values[ 'aw_email_from' ] ) and $values[ 'aw_email_from' ]->member_id )
			{
				$values[ 'aw_email_from' ] = $values[ 'aw_email_from' ]->member_id;
			}

			if ( !empty( $values[ 'aw_topic_author' ] ) and $values[ 'aw_topic_author' ]->member_id )
			{
				$values[ 'aw_topic_author' ] = $values[ 'aw_topic_author' ]->member_id;
			}   
            
			if ( !empty( $values[ 'aw_status_author' ] ) and $values[ 'aw_status_author' ]->member_id )
			{
				$values[ 'aw_status_author' ] = $values[ 'aw_status_author' ]->member_id;
			}

            if ( !empty( $values[ 'aw_chat_author' ] ) and $values[ 'aw_chat_author' ]->member_id )
            {
                $values[ 'aw_chat_author' ] = $values[ 'aw_chat_author' ]->member_id;
            }

			if ( isset( $values[ 'aw_topic_forum' ] ) and $values[ 'aw_topic_forum' ] instanceof \IPS\forums\Forum )
			{
				$values[ 'aw_topic_forum' ] = $values[ 'aw_topic_forum' ]->_id;
			}

            $values['aw_welcome_groups'] = ( $values['aw_welcome_groups'] == '*' ) ? '*' : implode( ',', $values['aw_welcome_groups'] );

            /* Save welcome topic */
            if( isset( $values['aw_welcome_topic'] ) AND $values['aw_welcome_topic'] )
            {
                $item = array_pop( $values['aw_welcome_topic'] );
                $values['aw_welcome_topic'] = $item->tid;
            }
            else
            {
                $values['aw_welcome_topic'] = NULL;
            }

            /* Enable/disable delay task */
            \IPS\Db::i()->update( 'core_tasks', array( 'enabled' => (bool) $values['aw_welcome_delay'] ), array( '`key`=?', 'welcomeAlerts' ) );

             $form->saveAsSettings( $values );
		}

		\IPS\Output::i()->output = $form;
	}
}