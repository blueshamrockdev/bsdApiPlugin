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
		if($this->authUser($request->getParameter($token)))
		{
			parent::execute($request);
		}else
		{
			throw new sfSecurityException(
				sprintf('bsdApiAction api token (%s) authorization epic failed!', $request->getParameter('token')));
		}
	}

}
