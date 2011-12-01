<?PHP

/**
 * PluginBsdApi (base) actions
 *
 * @package    bsdApiPlugin
 * @author     druid628
 */
class PluginBsdApiActions extends sfActions
{
	protected $apiUser;
	protected $_token;

	public function authUser()
	{
		if ($this->apiUser = Doctrine::getTable('bsdApiUser')->findOneByApiKey($this->_token))
		{
			if ($this->apiUser->getApiAccess() == true)
				return true;
		}
		return false;
	}

	public function execute($request)
	{
		if (!$request->hasParameter('token'))
			throw new sfCommandArgumentsException(sprintf('bsdApiAction api token was not found. Authorization epic failed!'));

		$this->_token = $request->getParameter('token');

		if (!$this->authUser())
			throw new sfSecurityException(sprintf('bsdApiAction api token (%s) authorization epic failed!', $request->getParameter('token')));

		if (!class_exists(ucfirst($request->getParameter('appClass'))))
			throw new sfCommandArgumentsException(sprintf('bsdApiAction - Class not Found! (%s)', $request->getParameter('appClass')));

		$this->setLayout(false);
		parent::execute($request);
	}

}
