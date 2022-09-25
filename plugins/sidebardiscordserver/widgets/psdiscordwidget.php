<?php
/**
 * @brief		psdiscordwidget Widget
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	sidebardiscordserver
 * @since		23 Dec 2018
 */

namespace IPS\plugins\sidebardiscordserver\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * psdiscordwidget Widget
 */
class _psdiscordwidget extends \IPS\Widget
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'psdiscordwidget';
	
	/**
	 * @brief	App
	 */
	
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '1';
	
	/**
	 * Initialise this widget
	 *
	 * @return void
	 */ 
	public function init() {
		$this->template([ \IPS\Theme::i()->getTemplate('plugins', 'core', 'global'), $this->key ]);
		parent::init();
	}
	
	/**
	 * Specify widget configuration
	 *
	 * @param	null|\IPS\Helpers\Form	$form	Form object
	 * @return	null|\IPS\Helpers\Form
	 */
	public function configuration( &$form=null ) {
 		if ( $form === null )
		{
	 		$form = new \IPS\Helpers\Form;
 		}
		$form->add( new \IPS\Helpers\Form\Text('pssds_serverId', isset( $this->configuration['pssds_serverId'] ) ? $this->configuration['pssds_serverId'] : NULL, TRUE) );
 		$form->add( new \IPS\Helpers\Form\Text('pssds_avatar', isset( $this->configuration['pssds_avatar'] ) ? $this->configuration['pssds_avatar'] : NULL ) );
 		$form->add( new \IPS\Helpers\Form\Text('pssds_customInvite', isset( $this->configuration['pssds_customInvite'] ) ? $this->configuration['pssds_customInvite'] : NULL ) );
 		$form->add( new \IPS\Helpers\Form\Color('pssds_color', isset( $this->configuration['pssds_color'] ) ? $this->configuration['pssds_color'] : '#6A59FF' ) );
 		$form->add( new \IPS\Helpers\Form\YesNo('pssds_showChannels', isset( $this->configuration['pssds_showChannels'] ) ? $this->configuration['pssds_showChannels'] : NULL ) );
 		$form->add( new \IPS\Helpers\Form\YesNo('pssds_compactView', isset( $this->configuration['pssds_compactView'] ) ? $this->configuration['pssds_compactView'] : NULL ) );
 		$form->add( new \IPS\Helpers\Form\YesNo('pssds_light', isset( $this->configuration['pssds_light'] ) ? $this->configuration['pssds_light'] : NULL ) );
 		$form->add( new \IPS\Helpers\Form\YesNo('pssds_allowBots', isset( $this->configuration['pssds_allowBots'] ) ? $this->configuration['pssds_allowBots'] : NULL ) );
		$form->add( new \IPS\Helpers\Form\YesNo('pssds_detailsCard', isset( $this->configuration['pssds_detailsCard'] ) ? $this->configuration['pssds_detailsCard'] : NULL ) );
		$form->add( new \IPS\Helpers\Form\Select('pssds_groups', isset( $this->configuration['pssds_groups'] ) ? $this->configuration['pssds_groups'] : NULL, TRUE, [ 'options' => \IPS\Member\Group::groups(), 'multiple' => TRUE, 'parse' => 'normal', 'noDefault' => TRUE]));
 		return $form;
 	} 
 	
 	 /**
 	 * Ran before saving widget configuration
 	 *
 	 * @param	array	$values	Values from form
 	 * @return	array
 	 */
	  public function sortArray( $array, $on, $order=SORT_ASC ) {
	    $new_array = array();
	    $sortable_array = array();
	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }
	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	                break;
	            case SORT_DESC:
	                arsort($sortable_array);
	                break;
	        }
	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }
	    return $new_array;
	}

	public function assocToChannel( $channels, $members ) {
		foreach( $channels as &$channel ) {
			$id = $channel['id'];
			$channel['users'] = array();
			foreach( $members as $member ) {
				if( !empty( $member['channel_id'] ) && $member['channel_id'] == $id ) {
					array_push( $channel['users'], $member );
				}
			}
		}
		return $channels;
	}

	public function initials( $name ) {
		$array = explode( ' ', $name );
		$initials = '';
		foreach( $array as $word ) {
			$initials .= substr( $word, 0, 1 );
		}
		return $initials;
	}

	public function render() {		
		if( empty( $this->configuration['pssds_serverId'] ) || !\IPS\Member::loggedIn()->InGroup( $this->configuration['pssds_groups'] ) ) {
			return "";
		}
		$data = [];
		$url = 'https://discordapp.com/api/guilds/'.$this->configuration['pssds_serverId'].'/widget.json';
		$request = \IPS\Http\Url::external( $url )->request()->get();
		if( $request->httpResponseCode == 200 ) {
			$server = json_decode( $request, true );
			$data['name'] = $server['name'];
			$data['joinurl'] = $server['instant_invite'] ?: null;
			$data['channels'] = $this->assocToChannel( $this->sortArray( $server['channels'], 'position' ), $server['members'] );
			$data['channelsno'] = count( $server['channels'] );
			$data['online'] = count( $server['members'] );
			$data['members'] = $server['members'];
			$data['initials'] = $this->initials( $server['name'] );
			$data['color'] = $this->configuration['pssds_color'] ?: '#6A59FF';
			$data['avatar'] = $this->configuration['pssds_avatar'] ?: null;
			$data['light'] = $this->configuration['pssds_light'] ?: null;
			$data['compactView'] = $this->configuration['pssds_compactView'] ?: null;
			$data['showChannels'] = $this->configuration['pssds_showChannels'] ?: null;
			$data['allowBots'] = $this->configuration['pssds_allowBots'] ?: null;
			$data['detailsCard'] = $this->configuration['pssds_detailsCard'] ?: null;
			$data['customInvite'] = $this->configuration['pssds_customInvite'] ?: null;
			if(!$data['allowBots']){
				for($i = sizeof($data['members']) - 1; $i >= 0; --$i){
					if( isset( $data['members'][$i]['bot'] ) && $data['members'][$i]['bot'] == true ){
						array_splice($data['members'], $i, 1);
					}
				}
			}
			if( count( $data['members'] ) > 5 ) {
				$data['members'] = array_slice( $data['members'], 0, 5 );
			}
		} else {
			$response = json_decode( $request, true ); 
			if( $response['code'] === 50004 ) {
				$data = [
					'error' => '50004',
					'error_title' => 'error_504',
					'error_message' => 'error_504_desc'
				];
			} else if( $response['code'] === 10004 ) {
				$data = [
					'error' => '10004',
					'error_title' => 'error_104',
					'error_message' => 'error_104_desc'
				];
			} else {
				$data = [
					'error' => $request->httpResponseCode,
					'error_title' => $request->httpResponseCode,
					'error_message' => $request->httpResponseText . '. Please contact puffysticks!'
				];
			}
		} 
		return $this->output( $data );
	}
}