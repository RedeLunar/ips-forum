<?php
/**
 * @package		Pre-defined topic fields
 * @author		<a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright	(c) 2015 Invisionizer
 */

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
    header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
    exit;
}

\IPS\Db::i()->dropColumn( 'forums_forums', 'pre_title' );
\IPS\Db::i()->dropColumn( 'forums_forums', 'pre_text' );