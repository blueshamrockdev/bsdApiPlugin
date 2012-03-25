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
	/*
	 * REFERENCE - because I can't ever keep this straight
	 *
	  Doctrine_Record::STATE_DIRTY  = 1
	  Doctrine_Record::STATE_TDIRTY = 2
	  Doctrine_Record::STATE_CLEAN  = 3
	  Doctrine_Record::STATE_TCLEAN = 5
	  --
	  Doctrine_Record::STATE_PROXY  = 4
	  Doctrine_Record::STATE_LOCKED = 6
	 *
	 */

	/**
	 * executeGet
	 *
	 * @param sfWebRequest $request
	 * @return json
	 */
	public function executeGet(sfWebRequest $request)
	{
		$appClass = sprintf("%s", ucfirst($request->getParameter('appClass')));
		if ($request->hasParameter('query'))
		{
   			 $appClassTable = Doctrine::getTable($appClass);
   			 $query = sprintf("%s", $request->getParameter('query'));
         if (method_exists($appClassTable, $request->getParameter('query')))
         {
              // Build $paramArray  by getting GET variables minus module, action, appClass, and query
              $paramArray = $request->getParameterHolder()->getAll();
              unset($paramArray['module'], $paramArray['action'], $paramArray['appClass'], $paramArray['query']);

              $result = call_user_func_array(array($request->getParameter("appClass"), $request->getParameter()), array_values($paramArray) );
         } else
         {
   			      $result = $appClassTable->createNamedQuery($query)->setHydrationMode(Doctrine::HYDRATE_ARRAY);
         }
		} else
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

		return $this->renderJSON($result->execute());
	} // get


	/**
	 * executeGive
	 *
	 * @param sfWebRequest $request
	 * @return json
	 */
	public function executeGive(sfWebRequest $request)
	{
		$requestParams2Ignore = array('module', "action", "token", "isNew", "appClass");
		$appClass = sprintf("%s", ucfirst($request->getParameter('appClass')));

		if ($request->hasParameter('isNew') && $request->getParameter('isNew') == true)
		{
			$it = new $appClass;
			$stuffFromRequest = $request->getParameterHolder()->getAll();

			/**
			 * remove module action token isNew and appClass
			 */
			foreach ($requestParams2Ignore as $unNeeded)
			{
				unset($stuffFromRequest[$unNeeded]);
			}

			foreach ($stuffFromRequest as $attrb => $parm)
			{
				$it->set($attrb, $parm);
			}

			$it->save();

			if ($it->state() == Doctrine_Record::STATE_CLEAN)
			{
				return $this->renderJSON(array("success" => true));
			} else
			{
				return $this->renderJSON(array("success" => false));
			}
		}
	} // give

	/**
	 * executeRevoke
	 *
	 * @param sfWebRequest $request
	 * @return json
	 */
	public function executeRevoke(sfWebRequest $request)
	{
		$this->apiUser()->setApiAccess(false);
		$this->apiUser()->save();
		if ($this->apiUser()->state() == Doctrine::STATE_CLEAN)
		{
			return $this->renderJSON(array("success" => true));
		} else
		{
			return $this->renderJSON(array("success" => false));
		}
	}

}
