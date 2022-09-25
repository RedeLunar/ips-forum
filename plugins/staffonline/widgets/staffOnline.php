<?php
/**
 * @package		Staff Online
 * @author		<a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright	(c) 2015 Invisionizer
 */

namespace IPS\plugins\staffonline\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _staffOnline extends \IPS\Widget
{
	public $key = 'staffOnline';

	public $app = '';

	public $plugin = '2';

	public function init()
	{
		$this->template( array( \IPS\Theme::i()->getTemplate( 'plugins', 'core', 'global' ), $this->key ) );
		
		parent::init();
	}

	public function configuration( &$form=null )
	{
 		if ( $form === null )
		{
	 		$form = new \IPS\Helpers\Form;
 		}

        $form->add( new \IPS\Helpers\Form\Select( 'staffOnline_g', $this->configuration['staffOnline_g'] ? $this->configuration['staffOnline_g'] : array(), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => true ), NULL, NULL, NULL, 'staffOnline_g' ) );

        return $form;
 	} 

 	public function preConfig( $values )
 	{
 		return $values;
 	}

	public function render()
	{
        if ( \IPS\Member::loggedIn()->inGroup($this->configuration['staffOnline_g'] ) )
        {
            return '';
        }

        $groups = \IPS\core\StaffDirectory\Group::roots();

        try
        {
            \IPS\core\StaffDirectory\User::load( \IPS\Member::loggedIn()->member_id, 'leader_type_id', array( 'leader_type=?', 'm' ) );
            $userIsStaff	= TRUE;
        }
        catch( \OutOfRangeException $e )
        {
            $userIsStaff	= FALSE;
        }

        $where = array(
            array( 'login_type=' . \IPS\Session\Front::LOGIN_TYPE_MEMBER ),
            array( 'current_appcomponent=?', \IPS\Dispatcher::i()->application->directory ),
            array( 'current_module=?', \IPS\Dispatcher::i()->module->key ),
            array( 'current_controller=?', \IPS\Dispatcher::i()->controller ),
            array( 'running_time>' . \IPS\DateTime::create()->sub( new \DateInterval( 'PT30M' ) )->getTimeStamp() ),
            array( 'member_id IS NOT NULL' )
        );

        try
        {
            $online = \IPS\Db::i()->select( array( 'member_id', 'member_name', 'seo_name', 'member_group' ), 'core_sessions', $where, 'running_time DESC' )->setKeyField( 'member_id' );
            $onlineCount = count($online);
        }
        catch ( \UnderflowException $e )
        {
            $online	= FALSE;
        }

        return $this->output( $groups, $userIsStaff, $onlineCount );
	}
}