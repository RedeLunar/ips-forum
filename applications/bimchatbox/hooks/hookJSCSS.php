//<?php

abstract class bimchatbox_hook_hookJSCSS extends _HOOK_CLASS_
{

	protected static function baseJs()
	{
		try
		{
			parent::baseJS();
			if ( ! \IPS\Request::i()->isAjax() && \IPS\Settings::i()->chatbox_conf_on == 1 )
			{
				if( \IPS\Member::loggedIn()->members_bitoptions['disable_notification_sounds'] )
				{
					\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'howler/howler.core.min.js', 'core', 'interface' ) );
				}		
				
				\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'front_chatbox.js', 'bimchatbox', 'front' ) );
			}
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

	public static function baseCss()
	{
		try
		{
			parent::baseCss();
			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'chatbox.css', 'bimchatbox', 'front' ) );
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