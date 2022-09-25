//<?php
/**
 * @package		Pre-defined topic fields
 * @author		<a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright	(c) 2015 Invisionizer
 */

abstract class hook83 extends _HOOK_CLASS_
{
	public static function formElements( $item = NULL, \IPS\Node\Model $container = NULL )
	{
		try
		{
			$return = parent::formElements( $item, $container );
	
			if ( \IPS\Request::i()->controller == 'forums' AND !isset( $return['content']->value ) )
			{
				if ( $container->pre_title )
				{
					$return['title']->value = $container->pre_title;
				}
	
				if( $container->pre_text )
				{
					$return['content']->value = $container->pre_text;
				}
			}
	
			return $return;
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