//<?php
/**
 * @package		Pre-defined topic fields
 * @author		<a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright	(c) 2015 Invisionizer
 */

class hook82 extends _HOOK_CLASS_
{
	public function form( &$form )
	{
		try
		{
			$data = parent::form( $form );
	
			$form->addTab( 'pre_defined_tab' );
			$form->addHeader( 'pre_defined_tab' );
	
			$form->add( new \IPS\Helpers\Form\Text( 'pre_title', $this->pre_title ) );
			$form->add( new \IPS\Helpers\Form\Editor( 'pre_text', $this->id ? $this->pre_text : NULL, FALSE, array( 'app' => 'core', 'key' => 'Admin', 'attachIds' => ( $this->id ? array( $this->id, NULL, 'pre_text' ) : NULL ) ) ) );
		
			return $data;
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}

