<?php

/**
 * bsdApi actions.
 *
 * @package    bsdApiPlugin
 * @subpackage bsdApi
 * @author     druid628
 */
class bsdApiControlActions extends sfActions {

	public function executeLearnMe(sfWebRequest $request)
	{

	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new bsdApiUserForm();

		if($request->isMethod(sfRequest::POST))
		{
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
			if($this->form->isValid())
			{
				$this->form->save();
				$this->forward('bsdApiControl', 'edit');
			}
		}
	}

	public function executeEdit(sfWebRequest $request)
	{
    
		if ($request->hasParameter('id'))
    {
	 		$id = $request->getParameter('id');
		  $this->forward404Unless($user = Doctrine::getTable('bsdApiUser')->findOneById(array($id)), sprintf('Object bsdApiUser does not exist (%s).', $id));
    } elseif($request->hasParameter('guard_id'))
    { 
		  $this->forward404Unless($user = Doctrine::getTable('bsdApiUser')->findOneByGuardId(array($request->getParameter('guard_id'))), sprintf('Object bsdApiUser does not exist (%s).', $request->getParameter('guard_id')));
    } else
    {
			$guardId = $this->getUser()->getGuardUser()->getId();
		  $this->forward404Unless($user = Doctrine::getTable('bsdApiUser')->findOneByGuardId(array($guardId)), sprintf('Object bsdApiUser does not exist (%s).', $guardId));
    }

		$this->form = new bsdApiUserForm($user);
    $q = Doctrine_Query::create()
        ->from('sfGuardUser sgu')
        ->where('sgu.id = ? ', $user->getGuardId());
    $ws = $this->form->getWidgetSchema();
    $ws['guard_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'sfGuardUser',
            'label' => 'User',
            'query' => $q,
            'add_empty' => false));

		if($request->isMethod(sfRequest::POST))
		{
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
			if($this->form->isValid())
			{
				$this->form->save();
			}
    }
		$this->setTemplate('new');
	}

}
