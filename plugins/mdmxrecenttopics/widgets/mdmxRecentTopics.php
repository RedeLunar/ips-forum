<?php
/**
 * @brief		mdmxRecentTopics Widget
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	mdmxRecentTopics
 * @since		14 May 2016
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\plugins\mdmxrecenttopics\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * mdmxRecentTopics Widget
 */
class _mdmxRecentTopics extends \IPS\Widget
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'mdmxRecentTopics';
	
	/**
	 * @brief	App
	 */
	public $app = '';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '6';

	/**
	 * Initialise this widget
	 *
	 * @return void
	 */
	public function init()
	{
		$this->template( array( \IPS\Theme::i()->getTemplate( 'plugins', 'core', 'global' ), $this->key ) );

		if( !is_array( $this->configuration ) || empty( $this->configuration ) )
		{
			$this->configuration = array(
				'recentTopics_useperms' => 1,
				'recentTopics_nr' => 5,
				'recentTopics_minposts' => 0,
				'recentTopics_interval' => 1,
				'recentTopics_topicstatus' => [ 'open', 'pinned', 'notpinned', 'visible', 'featured', 'notfeatured' ],
				'recentTopics_excludeforums' => [],
				'recentTopics_visibleto' => "all",
				'recentTopics_showLoading' => 0
			);
		}
	}

	/**
	 * Specify widget configuration
	 *
	 * @param	null|\IPS\Helpers\Form	$form	Form object
	 * @return	null|\IPS\Helpers\Form
	 */
	public function configuration( &$form=null )
	{
		if ( $form === null )
		{
			$form = new \IPS\Helpers\Form;
		}

		$form->add( new \IPS\Helpers\Form\YesNo( 'recentTopics_useperms', $this->configuration['recentTopics_useperms'], FALSE ) );
		$form->add( new \IPS\Helpers\Form\Number( 'recentTopics_nr', $this->configuration['recentTopics_nr'], TRUE ) );
		$form->add( new \IPS\Helpers\Form\Number( 'recentTopics_minposts', $this->configuration['recentTopics_minposts'], FALSE, array( 'min' => 0, 'unlimited' => "0", 'unlimitedLang' => "recentTopics_minposts_all" ) ) );
		$form->add( new \IPS\Helpers\Form\Number( 'recentTopics_interval', $this->configuration['recentTopics_interval'], FALSE, array( 'min' => 15 ) ) );
		$form->add( new \IPS\Helpers\Form\CheckboxSet( 'recentTopics_topicstatus', $this->configuration['recentTopics_topicstatus'], FALSE, array(
			'options' => array(
				'open'        => 'recentTopics_open',
				'closed'      => 'recentTopics_locked',
				'pinned'      => 'recentTopics_pinned',
				'notpinned'   => 'recentTopics_notpinned',
				'visible'     => 'recentTopics_visible',
				'hidden'      => 'recentTopics_hidden',
				'featured'    => 'recentTopics_featured',
				'notfeatured' => 'recentTopics_notfeatured'
			)
		) ) );

		$form->add( new \IPS\Helpers\Form\Node( 'recentTopics_excludeforums', $this->configuration['recentTopics_excludeforums'], FALSE, array(
			'class'           => '\IPS\forums\Forum',
			'permissionCheck' => 'view',
			'multiple'        => true
		) ) );

		$form->add( new \IPS\Helpers\Form\Select( 'recentTopics_visibleto', $this->configuration['recentTopics_visibleto'], FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => true, 'unlimited' => 'all', 'unlimitedLang' => 'all_groups' ), NULL, NULL, NULL, 'recentTopics_visibleto' ) );

		$form->add( new \IPS\Helpers\Form\YesNo( 'recentTopics_showLoading', $this->configuration['recentTopics_showLoading'], FALSE ) );

		return $form;
	}

	/**
	 * Ran before saving widget configuration
	 *
	 * @param	array	$values	Values from form
	 * @return	array
	 */
	public function preConfig( $values )
	{
		if( is_array( $values['recentTopics_excludeforums'] ) )
		{
			$values['recentTopics_excludeforums'] = array_keys( $values['recentTopics_excludeforums'] );
		}

		$values['recentTopics_showLoading'] = intval($values['recentTopics_showLoading']);

		return $values;
	}

	/**
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
		if ( $this->orientation === 'vertical' )
		{
			return '';
		}

		$plugins = new \IPS\core\modules\front\system\plugins;
		$topics = $plugins->mdmxRecentTopics( $this->configuration );

		if ( count( $topics ) )
		{
			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'recentTopics.css' ) );
			return $this->output( $topics, $this->configuration );
		}
		else
		{
			return '';
		}
	}
}