<?php

/**
 * bsdApiActions.
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
          $appClassTable = Doctrine::getTable($appClass);
          $query = sprintf("%s", $request->getParameter('query'));
	        $result = $appClassTable->createNamedQuery($query)->setHydrationMode(Doctrine::HYDRATE_ARRAY);
	        // $result = $appClassTable->createNamedQuery($query)->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
          // $this->apiResult = json_encode($result);

       }
       else
       {

           $result = Doctrine_Query::create()
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
           $result->setHydrationMode(Doctrine::HYDRATE_ARRAY);
       } // else
       $this->apiResult = json_encode($result->execute());
   } // get


   public function executeGive(sfWebRequest $request)
   {
       $requestParams2Ignore = array('module', "action", "token", "isNew", "appClass");
       $appClass = sprintf("%s", ucfirst($request->getParameter('appClass')));
       if($request->hasParameter('isNew') && $request->getParameter('isNew') == true)
       {
	       $it = new $appClass;
         $stuffFromRequest = $request->getParameterHolder()->getAll();
         
         /**
          * remove module action token isNew and appClass
          */
         foreach($requestParams2Ignore as $unNeeded)
         {
            unset($stuffFromRequest[$unNeeded]);
         }

	       foreach($stuffFromRequest as $attrb => $parm)
	       {
			     $it->set($attrb, $parm);
	       }
	       if($it->save())
          		$this->apiResult = json_encode(array("result" => "true"));
         else
              $this->apiResult = json_encode(array("result" => "false"));

       }

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
