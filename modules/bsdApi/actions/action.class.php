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
       $appClass = sprintf("%s", ucfirst($request->getParameter('appClass')));
       if($request->hasParameter('query'))
       {
          $appClassTable == Doctrine::getTable($appClass);
          $query = sprintf("%s", $request->getParameter('query'));
          $result = $appClassTable->$query();
          return json_encode($result);
       }

       $query = Doctrine_Query::create()
                ->from($appClass . " ac");
                /**
                 * need to think of the best
                 * way to approach this
                 * because i can think of a few
                 * but i'm in favor of doing 
                 * some sort of array loop
                 * or a ->select(join("," $array);
                 * think about it and we'll 
                 * come back to it
                 */
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
