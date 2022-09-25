<?php
/**
 * @package		Auto Welcome
 * @author		<a href='https://www.devfuse.com'>DevFuse</a>
 * @copyright	(c) 2019 DevFuse
 */

namespace IPS\autowelcome\extensions\core\MemberSync;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Member Sync
 */
class _AutoWelcome
{
    /**
     * Member has validated
     *
     * @param	\IPS\Member	$member		Member validated
     * @return	void
     */
    public function onValidate( $member )
    {
        /* Using time delay or welcome straight away? */
        if( !\IPS\Settings::i()->aw_welcome_delay )
        {
            try
            {
                /* Flag member as welcomed */
                $member->member_welcome = 1;
                $member->save();

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
            catch ( \Exception $e ){}
        }
    }
}