//<?php

class bimchatbox_hook_Ignore extends _HOOK_CLASS_
{
	public static function types()
	{
		try
		{
			return array_merge(parent::types(),array('chatbox'));
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}

}