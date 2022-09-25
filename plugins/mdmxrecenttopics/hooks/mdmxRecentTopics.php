//<?php

class hook84 extends _HOOK_CLASS_
{
	public function mdmxRecentTopics( $configuration=array() )
	{
		try
		{
			try
			{
				try
				{
					$this->configuration = $configuration;
	
					if ( ! count( $this->configuration ) AND \IPS\Request::i()->uniqueId )
					{
						$uniqueId = \IPS\Request::i()->uniqueId;
	
						$this->configuration = \IPS\Widget::getConfiguration( $uniqueId );
					}
	
					if ( $this->configuration['recentTopics_visibleto'] != 'all' AND isset( $this->configuration['recentTopics_visibleto'] ) and is_array( $this->configuration['recentTopics_visibleto'] ) )
					{
						if( ! \IPS\Member::loggedIn()->inGroup( $this->configuration['recentTopics_visibleto'] ) )
						{
							if ( \IPS\Request::i()->isAjax() )
							{
								\IPS\Output::i()->json( array( 'error' => 'no_permission' ), 403 );
							}
	
							return '';
						}
					}
	
					if ( isset( $this->configuration['recentTopics_minposts'] ) AND $this->configuration['recentTopics_minposts'] > 0 AND \IPS\Member::loggedIn()->member_id )
					{
						if ( \IPS\Member::loggedIn()->member_posts < $this->configuration['recentTopics_minposts'] )
						{
							if ( \IPS\Request::i()->isAjax() )
							{
								\IPS\Output::i()->json( array( 'error' => 'no_permission' ), 403 );
							}
	
							return '';
						}
					}
	
					$where = array();
					$order = NULL;
					$limit = isset( $this->configuration['recentTopics_nr'] ) ? $this->configuration['recentTopics_nr'] : 5;
					$permissionKey = ( !isset( $this->configuration['recentTopics_useperms'] ) or $this->configuration['recentTopics_useperms'] ) ? 'read' : NULL;
					$includeHidden = \IPS\Content\Hideable::FILTER_OWN_HIDDEN;
	
					if ( is_array( $this->configuration['recentTopics_excludeforums'] ) and !empty( $this->configuration['recentTopics_excludeforums'] ) )
					{
						$where[] = array( 'forum_id NOT IN (' . implode( ",", $this->configuration['recentTopics_excludeforums'] ) . ')' );
					}
	
					if ( !empty( $this->configuration['recentTopics_topicstatus'] ) )
					{
						$status = $this->configuration['recentTopics_topicstatus'];
	
						if ( ! in_array( 'open', $status ) or ! in_array( 'closed', $status ) )
						{
							if ( ! in_array( 'open', $status ) )
							{
								$where[] = array( "state='closed'" );
							}
							else if ( ! in_array( 'closed', $status ) )
							{
								$where[] = array( "state='open'" );
							}
						}
	
						if ( in_array( 'hidden', $status ) )
						{
							$includeHidden = \IPS\Content\Hideable::FILTER_AUTOMATIC;
						}
	
	
						if ( ! in_array( 'featured', $status ) or ! in_array( 'notfeatured', $status ) )
						{
							if ( ! in_array( 'featured', $status ) )
							{
								$where[] = array( 'featured=0' );
							}
							else if ( ! in_array( 'notfeatured', $status ) )
							{
								$where[] = array( 'featured=1' );
							}
						}
	
						if ( ! in_array( 'pinned', $status ) or ! in_array( 'notpinned', $status ) )
						{
							if ( ! in_array( 'pinned', $status ) )
							{
								$where[] = array( 'pinned=0' );
							}
							else if ( ! in_array( 'notpinned', $status ) )
							{
								$where[] = array( 'pinned=1' );
							}
						}
					}
	
					if ( $permissionKey )
					{
						$where[] = array( 'forums_forums.password IS NULL AND forums_forums.can_view_others=1' );
					}
	
					$topics_array = \IPS\forums\Topic::getItemsWithPermission( $where, 'last_post DESC', $limit, $permissionKey, $includeHidden );
	
					if ( \IPS\Request::i()->isAjax() )
					{
						/* Ignore topics we already have in our list */
						$excludeTopics 	= "";
						$ourTids		= array();
						if ( \IPS\Request::i()->our_tids )
						{
							foreach( json_decode( \IPS\Request::i()->our_tids, true ) as $tid )
							{
								if ( intval( $tid ) > 0 )
								{
									$ourTids[ intval( $tid[0] ) ] = array( 'tid' => intval( $tid[0] ), 'timestamp' => intval( $tid[1] ) );
								}
							}
						}
	
						$updatedTopics = $updatedTopicsJson = $updateTime = $updatedTimeJson = $newTopics = $allTopics = array();
	
						foreach( $topics_array as $r )
						{
							if ( isset( $ourTids[ $r->tid ] ) )
							{
								/* Update entire row */
								if( $r->last_post > $ourTids[ $r->tid ]['timestamp'] )
								{
									$updatedTopics[ $r->tid ] = $r;
								}
								/* Just update the timestamp */
								else
								{
									$updateTime[ $r->tid ] = $r;
								}
							}
							else
							{
								$updatedTopics[ $r->tid ] = $r;
							}
	
							$allTopics[] = $r;
						}
	
						if ( is_array( $updatedTopics ) AND count( $updatedTopics ) )
						{
							foreach( $updatedTopics as $tid => $t )
							{
								$updatedTopicsJson[] = array(
									'tid' => $tid,
									'html' => \IPS\Theme::i()->getTemplate( 'plugins', 'core', 'global' )->mdmxRecentTopicsRow( NULL, NULL, $t, TRUE )
								);
							}
						}
	
						if ( is_array( $updateTime ) AND count( $updateTime ) )
						{
							foreach( $updateTime as $tid => $t )
							{
								$date = $t->mapped( 'last_comment' ) ? $t->mapped( 'last_comment' ) : $t->mapped( 'date' );
								$val = ( $date  instanceof \IPS\DateTime ) ? $date  : \IPS\DateTime::ts( $date );
	
								$updatedTimeJson[] = array(
									'tid'	=> $tid,
									'date'	=> $val->html(),
									'timestamp' => $date,
								);
							}
						}
	
	
						\IPS\Output::i()->json( array( 'updated' => $updatedTopicsJson, 'updatedTime' => $updatedTimeJson ) );
					}
	
					return $topics_array;
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