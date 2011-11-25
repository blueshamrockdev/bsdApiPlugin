<?PHP


class PluginBsdApiActions extends sfActions
{
	protected $apiUser;

	public function authUser($token)
	{
		if($this->apiUser = Doctrine::getTable('bsdApiUser')->findOneByApiKey($token))
		{
			if($this->apiUser->getApiAcces() == true)
				return true;
		}
		return false;
	}

	public function execute($request)
	{
    if(!$request->hasParameter('token'))
    {
			throw new sfCommandArgumentsException(
				sprintf('bsdApiAction api token was not found. Authorization epic failed!'));
    }
		if(!$this->authUser($request->getParameter($token)))
		{
			throw new sfSecurityException(
				sprintf('bsdApiAction api token (%s) authorization epic failed!', $request->getParameter('token')));
		}

    if(!class_exists(ucfirst($request->getParameter('appClass'))))
    {
			throw new sfCommandArgumentsException(
				sprintf('bsdApiAction - Class not Found! (%s)', $request->getParameter('appClass')));
    }

			parent::execute($request);
	}

}
