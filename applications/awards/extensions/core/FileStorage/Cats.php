<?php
/**
 * @package      iAwards
 * @author       <a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright    (c) 2016 Invisionizer
 */

namespace IPS\awards\extensions\core\FileStorage;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * File Storage Extension: Cats
 */
class _Cats
{
	/**
	 * @return mixed
	 */
	public function count()
	{
		return \IPS\Db::i()->select( 'COUNT(*)', 'awards_cats', 'cat_icon IS NOT NULL' )->first();
	}

	/**
	 * @param $offset
	 * @param $storageConfiguration
	 * @param null $oldConfiguration
	 */
	public function move( $offset, $storageConfiguration, $oldConfiguration=NULL )
	{
		$cat = \IPS\awards\Cats::constructFromData( \IPS\Db::i()->select( '*', 'awards_cats', 'cat_icon IS NOT NULL', 'cat_id', array( $offset, 1 ) )->first() );
		
		try
		{
			$cat->q_cicon = \IPS\File::get( $oldConfiguration ?: 'awards_Cats', $cat->q_cicon )->move( $storageConfiguration );
			$cat->save();
		}
		catch( \Exception $e )
		{
			/* Any issues are logged */
		}
	}

	/**
	 * Fix all URLs
	 *
	 * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
	 * @return void
	 */
	public function fixUrls( $offset )
	{
		$cat = \IPS\awards\Cats::constructFromData( \IPS\Db::i()->select( '*', 'awards_cats', 'cat_icon IS NOT NULL', 'cat_id', array( $offset, 1 ) )->first() );
		
		if ( $new = \IPS\File::repairUrl( $cat->cat_icon ) )
		{
			$cat->cat_icon = $new;
			$cat->save();
		}
	}

	/**
	 * Check if a file is valid
	 *
	 * @param	\IPS\Http\Url	$file		The file to check
	 * @return	bool
	 */
	public function isValidFile( $file )
	{
		try
		{
			\IPS\Db::i()->select( 'cat_id', 'awards_cats', array( 'cat_icon=?', $file ) )->first();
			return TRUE;
		}
		catch ( \UnderflowException $e )
		{
			return FALSE;
		}
	}

	/**
	 * Delete
	 */
	public function delete()
	{
		foreach( \IPS\Db::i()->select( '*', 'awards_cats', "cat_icon IS NOT NULL" ) as $cat )
		{
			try
			{
				\IPS\File::get( 'awards_Cats', $cat['cat_icon'] )->delete();
			}
			catch( \Exception $e ){}
		}
	}
}