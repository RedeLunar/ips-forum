<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */

namespace IPS\autowelcome\tasks;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * welcomeAlerts Task
 */
class _welcomeAlerts extends \IPS\Task
{
	/**
	 * Execute
	 *
	 * If ran successfully, should return anything worth logging. Only log something
	 * worth mentioning (don't log "task ran successfully"). Return NULL (actual NULL, not '' or 0) to not log (which will be most cases).
	 * If an error occurs which means the task could not finish running, throw an \IPS\Task\Exception - do not log an error as a normal log.
	 * Tasks should execute within the time of a normal HTTP request.
	 *
	 * @return	mixed	Message to log or NULL
	 * @throws	\IPS\Task\Exception
	 */
	public function execute()
	{
	    /* Time delay disabled, so disable task */
        if ( !\IPS\Settings::i()->aw_welcome_delay )
        {
            \IPS\Db::i()->update( 'core_tasks', array( 'enabled' => 0 ), array( '`key`=?', 'welcomeAlerts' ) );
            return NULL;
        }

        $this->runUntilTimeout(function()
        {
            /* Only get members not yet welcomed. */
            $where = array( array( 'member_welcome=?', 0 ) );

            /* Only get members who joined after time delay */
            $where[] = array( 'joined < ?', \IPS\DateTime::create()->sub( new \DateInterval( 'PT'.\IPS\Settings::i()->aw_welcome_delay.'H' ) )->getTimestamp() );

            /* Look for matching members */
            $members = \IPS\DB::i()->select( '*', 'core_members', $where, 'joined ASC', 15 );

            if ( !$members->count() )
            {
                return FALSE;
            }

            foreach( $members as $row )
            {
                $member = \IPS\Member::constructFromData( $row );

                /* Flag member as welcomed so does not appear in task again. */
                $member->member_welcome = 1;
                $member->save();

                /* Skipping validating members? */
                if( \IPS\Settings::i()->aw_skip_validating AND $member->members_bitoptions['validating'] )
                {
                    continue;
                }

                /* Restricted member groups? */
                if( \IPS\Settings::i()->aw_welcome_groups != '*' AND !$member->inGroup( explode( ',', \IPS\Settings::i()->aw_welcome_groups ) ) )
                {
                    continue;
                }

                try
                {
                    /* Create welcome topic */
                    $topic = \IPS\autowelcome\Alerts\Alerts::_createTopic( $member );

                    /* Send welcome email */
                    \IPS\autowelcome\Alerts\Alerts::_sendEmail( $member, $topic );

                    /* Send welcome pm */
                    \IPS\autowelcome\Alerts\Alerts::_sendPM( $member, $topic );

                    /* Send welcome chat */
                    \IPS\autowelcome\Alerts\Alerts::_sendChat( $member, $topic );

                    /* Send welcome status */
                    \IPS\autowelcome\Alerts\Alerts::_sendStatus( $member, $topic );
                }
                catch( \Exception $e ){}
            }

            return TRUE;
        });
	}
	
	/**
	 * Cleanup
	 *
	 * If your task takes longer than 15 minutes to run, this method
	 * will be called before execute(). Use it to clean up anything which
	 * may not have been done
	 *
	 * @return	void
	 */
	public function cleanup()
	{
		
	}
}