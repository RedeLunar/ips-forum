<?php
/**
 * @package      iAwards
 * @author       <a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright    (c) 2015 Invisionizer
 */

namespace IPS\awards\modules\front\awards;

/* To prevent PHP errors (extending class does not exist) revealing path */
if (!defined('\IPS\SUITE_UNIQUE_KEY')) {
    header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 403 Forbidden');
    exit;
}


class _ajaxcreate extends \IPS\Dispatcher\Controller
{
    public function execute()
    {
        parent::execute();
    }

    protected function manage()
    {
        $form = new \IPS\Helpers\Form;
        $form->add(new \IPS\Helpers\Form\Member('awarded_member', NULL, TRUE, array()));
        $form->add(new \IPS\Helpers\Form\Node('award_id', null, TRUE, array(
            'class' => 'IPS\awards\Cats',
            'subnodes' => TRUE,
        ), NULL, NULL, NULL, NULL));

        $form->add(new \IPS\Helpers\Form\Editor('awarded_reason', null, FALSE, array('app' => 'awards', 'key' => 'Awards', 'autoSaveKey' => 'awards-new-reason', 'attachIds' => array()), NULL, NULL, NULL, 'reason_show'));

        if( $values = $form->values() )
		{
            $member = \IPS\Member::load($values['awarded_member']->member_id);
            $giver = \IPS\Member::load(\IPS\Member::loggedIn()->member_id);
            $reason = $values['awarded_reason'];

            try
			{
                $award = \IPS\awards\Awards::load( $values['award_id']->id );
            }
			catch ( \OutOfRangeException $e ){}

            if( !$award->can('add', $giver ) )
			{
				\IPS\Output::i()->error( 'awards_others_err', '1A23/1', 403, '' );
            }

            if( $award->can('add', $member) AND !$award->can('self', $member) AND $giver->member_id == $member->member_id )
			{
				\IPS\Output::i()->error( 'awards_self_err', '1A24/1', 403, '' );
            }

            if( $award->obtainable_enabled AND $award->obtainable )
			{
				\IPS\Output::i()->error( 'awards_obtainable_err', '1A25/1', 403, '' );
            }

            try
			{
                $award->awardTo( $member, $award, $giver, $reason );
            }
			catch (\Exception $e)
			{
				\IPS\Output::i()->error($e->getMessage(), '1A19/1', 403, '');
			}
        }
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate('forms', 'awards')->addAward( $form );
    }

    protected function newAward()
    {
        $form = new \IPS\Helpers\Form;
        $form->class = "ipsPad ipsForm_vertical";
        $form->hiddenValues['award_id'] = \IPS\Request::i()->awid;
        $form->hiddenValues['cat_id'] 	= \IPS\Request::i()->catid;
        $form->add(new \IPS\Helpers\Form\Member('awarded_member', NULL, TRUE, array()));
        $form->add(new \IPS\Helpers\Form\Editor('awarded_reason', null, FALSE, array('app' => 'awards', 'key' => 'Awards', 'autoSaveKey' => 'awards-new-reason', 'attachIds' => array()), NULL, NULL, NULL, 'reason_show'));

        if ( $values = $form->values() )
		{
            $member = \IPS\Member::load($values['awarded_member']->member_id);
            $giver = \IPS\Member::load(\IPS\Member::loggedIn()->member_id);
            $reason = $values['awarded_reason'];

			try
			{
				$award = \IPS\awards\Awards::load( \IPS\Request::i()->award_id );
			}
			catch (\UnderflowException $e){}


			if( !$award->can( 'add', $giver ) )
			{
				\IPS\Output::i()->error( 'awards_others_err', '1A20/1', 403, '' );				
            }

			if( $award->can('add', $member) AND !$award->can( 'self', $member ) AND $giver->member_id == $member->member_id )
			{
				\IPS\Output::i()->error( 'awards_self_err', '1A21/1', 403, '' );
			}

            if( $award->obtainable_enabled AND $award->obtainable )
			{
				\IPS\Output::i()->error( 'awards_obtainable_err', '1A22/1', 403, '' );
            }

            try
			{
                $award->awardTo( $member, $award, $giver, $reason );
			}
			catch (\Exception $e)
			{
				\IPS\Output::i()->error( $e->getMessage(), '1A19/2', 403, '' );
            }

			$cat = \IPS\awards\Cats::load( \IPS\Request::i()->cat_id );
            \IPS\Output::i()->redirect( $cat->url(), 'completed' );
        }

		\IPS\Output::i()->output = $form;
	}
}
