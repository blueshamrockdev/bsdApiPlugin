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
			// $this->form->bind($request);
			if($this->form->isValid())
			{
				$this->form->save();
				$this->forward('bsdApiControl', 'edit');
			}
		}
	}

	public function executeEdit(sfWebRequest $request)
	{
		if ($request->hasParameter('guard_id'))
			$guardId = $request->getParameter('guard_id');
		else
			$guardId = $this->getUser()->getGuardUser()->getId();

		$this->forward404Unless($user = Doctrine::getTable('bsdApiUser')->findOneByGuardId(array($guardId)), sprintf('Object Defendant (bsdApiUser) does not exist (%s).', $guardId));

		$this->form = new bsdApiUserForm($user);
		$this->setTemplate('new');
	}

}
