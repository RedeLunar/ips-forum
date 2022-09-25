<?php
/**
 * @package      iAwards
 * @author       <a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright    (c) 2016 Invisionizer
 */

namespace IPS\awards;

class _Cats extends \IPS\Node\Model implements \IPS\Node\Permissions
{
    /**
     * @var
     */
    protected static $multitons;

    /**
     * @var null
     */
    protected static $defaultValues = NULL;

	/**
	 * @brief	[Node] Title prefix.  If specified, will look for a language key with "{$key}_title" as the key
	 */
	public static $titleLangPrefix = 'awards_category_';
	
	/**
	 * @brief	[Node] Description suffix.  If specified, will look for a language key with "{$titleLangPrefix}_{$id}_{$descriptionLangSuffix}" as the key
	 */
	public static $descriptionLangSuffix = '_desc';

    /**
     * @var string
     */
    public static $databaseTable = 'awards_cats';

    /**
     * @var string
     */
    public static $databasePrefix = 'cat_';

    /**
     * @var string
     */
    public static $databaseColumnOrder = 'position';

    /**
     * @var string
     */
    public static $databaseColumnParent = 'parent';

    /**
     * @var string
     */
    public static $nodeTitle = 'menu__awards_awards_manage';

    /**
     * @var string
     */
    public static $subnodeClass = 'IPS\awards\Awards';

    /**
     * @var array
     */
    protected static $restrictions = array(
        'app'    => 'awards',
        'module' => 'awards',
        'prefix' => 'cats_',
    );


    /**
     * @return mixed
     */
    protected function get__title()
    {
        return \IPS\Member::loggedIn()->language()->addToStack( static::$titleLangPrefix . $this->_id );
    }

	/**
	 * Get SEO name
	 *
	 * @return	string
	 */
	public function get_name_seo()
	{
		if( !$this->_data['name_seo'] )
		{
			$this->name_seo	= \IPS\Http\Url::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( 'awards_category_' . $this->id ) );
			$this->save();
		}

		return $this->_data['name_seo'] ?: \IPS\Http\Url::seoTitle( \IPS\Lang::load( \IPS\Lang::defaultLanguage() )->get( 'awards_category_' . $this->id ) );
	}

    /**
     * @return mixed
     */
    protected function get__enabled()
    {
        return $this->enabled;
    }

    /**
     * @param $enabled
     */
    protected function set__enabled( $enabled )
    {
        $this->enabled = $enabled;
    }

    /**
     * @var string
     */
    public static $permApp = 'awards';

    /**
     * @var string
     */
    public static $permType = 'cats';

    /**
     * @var array
     */
    public static $permissionMap = array(
        'view' => 'view',
        'add'  => 2,
        'read' => 3
    );

    /**
     * @var string
     */
    public static $permissionLangPrefix = 'cat_perm_';


    /**
     * @param $form
     */
    public function form( &$form )
    {
        $form->addTab( 'cat_tab_main' );
        $form->addHeader( 'cat_header_main' );
        $form->add( new \IPS\Helpers\Form\Translatable( 'cat_title', NULL, TRUE, array( 'app' => 'awards', 'key' => ( $this->id ? "awards_category_{$this->id}" : NULL ) ) ) );
		$form->add( new \IPS\Helpers\Form\Translatable( 'cat_desc', NULL, FALSE, array(
			'app'		=> 'awards',
			'key'		=> ( $this->id ? "awards_category_{$this->id}_desc" : NULL ),
			'editor'	=> array(
				'app'			=> 'awards',
				'key'			=> 'Cats',
				'autoSaveKey'	=> ( $this->id ? "awards-cat-{$this->id}" : "awards-new-cat" ),
				'attachIds'		=> $this->id ? array( $this->id, NULL, 'description' ) : NULL, 'minimize' => 'cdesc_placeholder'
			)
		) ) );
        $form->add( new \IPS\Helpers\Form\Upload( 'cat_icon', $this->icon ? \IPS\File::get( 'awards_Cats', $this->icon ) : NULL, FALSE, array( 'storageContainer' => 'awards', 'image' => TRUE, 'allowedFileTypes' => array( 'png', 'jpg', 'gif', 'svg', 'ico' ), 'storageExtension' => 'awards_Cats' ), NULL, NULL, NULL, 'cat_icon' ) );
    }

    /**
     * @param $values
     */
    public function saveForm( $values )
    {
        if ( !$this->id )
        {
            $this->save();
        }

        /*foreach ( array() as $fieldKey => $langKey )
        {
            \IPS\Lang::saveCustom( 'cats', $langKey, $values[$fieldKey] );

            unset( $values[$fieldKey] );
        }*/

		foreach ( array( 'cat_title' => "awards_category_{$this->id}", 'cat_desc' => "awards_category_{$this->id}_desc" ) as $fieldKey => $langKey )
		{
			if ( array_key_exists( $fieldKey, $values ) )
			{
				\IPS\Lang::saveCustom( 'awards', $langKey, $values[ $fieldKey ] );
				
				if ( $fieldKey === 'cat_title' )
				{
					$this->name_seo = \IPS\Http\Url::seoTitle( $values[ $fieldKey ][ \IPS\Lang::defaultLanguage() ] );
				}
				
				unset( $values[ $fieldKey ] );
			}
		}

        foreach ( array() as $k )
        {
            $this->bitoptions[$k] = $values[$k];
            unset( $values[$k] );
        }

        /*if( isset( $values['cat_title'] ) )
        {
            $values['name_seo']	= \IPS\Http\Url\Friendly::seoTitle( $values['cat_title'] );

            unset( $values['cat_title'] );
        }*/

        parent::saveForm( $values );
    }

    /**
     * @return mixed
     */
    public function url()
    {
        return \IPS\Http\Url::internal( "app=awards&module=awards&controller=awards&id={$this->id}", 'front', 'awards_cat', $this->name_seo );
    }

    /**
     * Clone
     */
    public function __clone()
    {
        if ( $this->skipCloneDuplication === TRUE )
        {
            return;
        }

        $oldIcon = $this->icon;

        parent::__clone();

        if ( $oldIcon )
        {
            try
            {
                $icon = \IPS\File::get( 'awards_Cats', $oldIcon );
                $newIcon = \IPS\File::create( 'awards_Cats', $icon->originalFilename, $icon->contents() );
                $this->icon = (string) $newIcon;
            }
            catch ( \Exception $e )
            {
                $this->icon = NULL;
            }

            $this->save();
        }
    }

    /**
     * @param $column
     * @param $query
     * @param null $order
     * @param array $where
     * @return mixed
     */
    public static function search( $column, $query, $order = NULL, $where = array() )
    {
        if ( $column === '_title' )
        {
            $column = 'cat_title';
        }

        if ( $order == '_title' )
        {
            $order = 'cat_title';
        }

        return parent::search( $column, $query, $order, $where );
    }

    public function canAwarded( $member=NULL )
    {
        if( !$this->canAwarded )
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public function getAwardsCount(){
        return (int) \IPS\Db::i()->select( 'COUNT(*)', 'awards_awards', array('award_cat_id=? AND award_enabled=1', $this->id ) )->first();
    }
}
