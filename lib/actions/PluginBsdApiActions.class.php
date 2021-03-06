<?PHP


/**
 * PluginBsdApiActions (base)
 * 
 * @uses sfActions
 * @package 
 * @version $id$
 * @copyright 2010-2012 Blue Shamrock Development
 * @author Micah Breedlove <micah@blueshamrock.com> 
 * @license BSD Version 3.0 {@link https://raw.github.com/blueshamrockdev/bsdApiPlugin/940ae1645ea362bada34a1025730d85853060f80/LICENSE}
 */
class PluginBsdApiActions extends sfActions
{

	protected $apiUser;
	protected $_token;

   /**
	* authUser
	*
    * @access public
	* @return boolean
	*/
	public function authUser()
	{
		if ($this->apiUser = Doctrine::getTable('bsdApiUser')->findOneByApiKey($this->_token))
		{
			if ($this->apiUser->getApiAccess() == true)
				return true;
		}
		return false;
	}

   /**
    * doAuth
    *
    * @param sfWebRequest $request
    * @access public
    * @return void
    */
  
  public function preExecute()
  {
    $request = $this->getRequest();
    $this->doAuth($request);
  }
	public function doAuth($request)
	{
    if(sfConfig::get('app_bsdapi_forceAjax') == true)
      $this->forward404Unless($request->isXmlHttpRequest(), "Requires AJAX Request");

		if (!$request->hasParameter('token'))
			throw new sfCommandArgumentsException(sprintf('bsdApiAction api token was not found. Authorization epic failed!'));

		$this->_token = $request->getParameter('token');

		if (!$this->authUser())
			throw new sfSecurityException(sprintf('bsdApiAction api token (%s) authorization epic failed!', $request->getParameter('token')));

		if (!class_exists(ucfirst($request->getParameter('appClass'))))
			throw new sfCommandArgumentsException(sprintf('bsdApiAction - Class not Found! (%s)', $request->getParameter('appClass')));

		$this->setLayout(false);
	}

	/**
	 * renderJSON
	 *
	 * @param array $array
	 * @access public
	 * @return json
	 */
	public function renderJSON(array $array)
	{

		$this->getResponse()->setHttpHeader('Content-Type', 'text/plain');
		return $this->renderText(json_encode($array));
	}

}
