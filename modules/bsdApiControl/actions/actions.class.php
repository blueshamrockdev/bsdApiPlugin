<?php

/**
 * bsdApi actions.
 *
 * @package    bsdApiPlugin
 * @subpackage bsdApi
 * @author     druid628
 */
class bsdApiControlActions extends sfActions
{
   public function executeLearnMe(sfWebRequest $request)
   {
   }

   public function executeNew(sfWebRequest $request)
   {
	   $this->form = new bsdApiUserForm();
   }

}
