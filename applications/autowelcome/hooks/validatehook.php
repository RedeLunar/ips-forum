//<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */
 
class autowelcome_hook_validatehook extends _HOOK_CLASS_
{
	/**
	 * [ActiveRecord] Save Changed Columns
	 *
	 * @return	void
	 * @note	We have to be careful when upgrading in case we are coming from an older version
	 */
	public function save()
	{
		try
		{
	        /* Make sure we only hook into admin area */
	        if( \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'admin' OR ( \IPS\Dispatcher::hasInstance() and \IPS\Dispatcher::i()->controllerLocation == 'front' and \IPS\Request::i()->do == 'complete' ) )
	        {
	            /* Flag as new account first thing */
	            $newMember = ( $this->_new ) ? TRUE : FALSE;
	
	            /* Save account so we get username */
	            $save = \call_user_func_array( 'parent::save', \func_get_args() );
	
	            /* Is new member? Send out alerts then */
	            if( !\IPS\Settings::i()->aw_welcome_delay AND $newMember )
	            {
	                try
	                {
	                    /* Flag member as welcomed */
	                    $this->member_welcome = 1;
	                    $this->save();
	
	                    /* Crate welcome topic */
	                    $topic = \IPS\autowelcome\Alerts\Alerts::_createTopic( $this );
	
	                    /* Send welcome email */
	                    \IPS\autowelcome\Alerts\Alerts::_sendEmail( $this, $topic );
	
	                    /* Send welcome pm */
	                    \IPS\autowelcome\Alerts\Alerts::_sendPM( $this, $topic );
	
	                    /* Send welcome chat */
	                    \IPS\autowelcome\Alerts\Alerts::_sendChat( $this, $topic );
	
	                    /* Send welcome status */
	                    \IPS\autowelcome\Alerts\Alerts::_sendStatus( $this, $topic );
	                }
	                catch ( \Exception $e ){}
	            }
	
	            /* Return like normal */
	            return $save;
	        }
	
	        /* Make sure front end returns like normal */
	        return \call_user_func_array( 'parent::save', \func_get_args() );
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

    /**
     * Call after completed registration to send email for validation if required or flag for admin validation
     *
     * @param	bool		$noEmailValidationRequired	If the user's email is implicitly trusted (for example, provided by a third party), set this to TRUE to bypass email validation
     * @param	bool		$doNotDelete				If TRUE, the account will not be deleted in the normal cleanup of unvalidated accounts. Used for accounts created in Commerce checkout.
     * @param	array|NULL	$postBeforeRegister			The row from core_post_before_registering if applicable
     * @return	void
     */
    public function postRegistration( $noEmailValidationRequired = FALSE, $doNotDelete = FALSE, $postBeforeRegister = NULL )
    {
	try
	{
	        /* Skip if no username present. Most likely SSO service */
	        if( !$this->real_name OR $this->name === $this->language()->get('guest') )
	        {
	            return \call_user_func_array( 'parent::postRegistration', \func_get_args() );
	        }
	
	        /* Welcome member straight away. The 'complete' check is for social media signups */
	        if( !\IPS\Settings::i()->aw_welcome_delay AND ( \IPS\Settings::i()->reg_auth_type == 'none' OR \IPS\Request::i()->do == 'complete' ) )
	        {
	            try
	            {
	                /* Flag member as welcomed */
	                $this->member_welcome = 1;
	                $this->save();
	
	                /* Create welcome topic */
	                $topic = \IPS\autowelcome\Alerts\Alerts::_createTopic( $this );
	
	                /* Send welcome email */
	                \IPS\autowelcome\Alerts\Alerts::_sendEmail( $this, $topic );
	
	                /* Send welcome pm */
	                \IPS\autowelcome\Alerts\Alerts::_sendPM( $this, $topic );
	
	                /* Send welcome chat */
	                \IPS\autowelcome\Alerts\Alerts::_sendChat( $this, $topic );
	
	                /* Send welcome status */
	                \IPS\autowelcome\Alerts\Alerts::_sendStatus( $this, $topic );
	            }
	            catch( \Exception $e ){}
	        }
	
	        /* Continue like normal */
	        return \call_user_func_array('parent::postRegistration', \func_get_args());
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