<?php


namespace IPS\awards\setup\upg_10023;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 1.0.8.5 Upgrade Code
 */
class _Upgrade
{
	/**
	 * ...
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		foreach( \IPS\Db::i()->select( '*', 'awards_cats' ) as $cat )
		{
			if( $cat['cat_title'] )
			{
				$cid	= $cat['cat_id'];
				$title	= $cat['cat_title'];
				$desc	= $cat['cat_desc'];

				$category	= \IPS\awards\Cats::constructFromData( $cat );

				\IPS\Lang::saveCustom( 'awards', "awards_category_{$cid}", trim( $title ) );
				\IPS\Lang::saveCustom( 'awards', "awards_category_{$cid}_desc", \IPS\Text\Parser::parseStatic( $desc, TRUE, NULL, NULL, TRUE, TRUE, TRUE ) );

				$category->save();
			}
			else
			{
				$cid	= $cat['cat_id'];
				$title	= ucwords( str_replace( '-', ' ', $cat['cat_name_seo'] ) );
				$desc	= $cat['cat_desc'];

				$category	= \IPS\awards\Cats::constructFromData( $cat );

				\IPS\Lang::saveCustom( 'awards', "awards_category_{$cid}", trim( $title ) );
				\IPS\Lang::saveCustom( 'awards', "awards_category_{$cid}_desc", \IPS\Text\Parser::parseStatic( $desc, TRUE, NULL, NULL, TRUE, TRUE, TRUE ) );

				$category->save();
			}
		}

		return TRUE;
	}

	// You can create as many additional methods (step2, step3, etc.) as is necessary.
	// Each step will be executed in a new HTTP request
}