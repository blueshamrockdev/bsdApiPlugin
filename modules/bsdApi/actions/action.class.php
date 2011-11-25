<?php

/**
 * bsdApi actions.
 *
 * @package    bsdApiPlugin
 * @subpackage bsdApi
 * @author     druid628
 */
class bsdApiActions extends PluginBsdApiActions
{

   public function executeGet(sfWebRequest $request)
   {
   }

   public function executeGive(sfWebRequest $request)
   {
   }

   public function executeRevoke(sfWebRequest $request)
   {
      $this->apiUser()->setApiAccess(false);
      if($this->apiUser()->save())
          $this->apiResult = json_encode(array("result" => "true"));
      else
          $this->apiResult = json_encode(array("result" => "false"));
   }
}
