<?PHP

class bsdApiRouting {

	public static function listenToRoutingLoadConfiguration(sfEvent $event) {
		$routing = $event->getSubject();


		if (in_array('bsdApi', sfConfig::get('sf_enabled_modules')) )
		{
		    $this->dispatcher->notify(new sfEvent($this, 'application.log', array('register bsdApi routes', 'priority' => sfLogger::INFO)));
		    $routing->prependRoute('api_deauth', new sfRoute(
        		'/api/revoke/:token',
        		array('module' => 'bsdApi', 'action' => 'revoke') ));
		    $routing->prependRoute('api_get', new sfRoute(
        		'/api/get/:token/:appClass',
        		array('module' => 'bsdApi', 'action' => 'get') ));
		    $routing->prependRoute('api_give', new sfRoute(
        		'/api/give/:token/:isNew/:appClass',
        		array('module' => 'bsdApi', 'action' => 'give') ));

		}
		if(in_array('bsdApiControl', sfConfig::get('sf_enabled_modules')))
		{
		    $this->dispatcher->notify(new sfEvent($this, 'application.log', array('register bsdApiControl route', 'priority' => sfLogger::INFO)));
		    $routing->prependRoute('api_learn', new sfRoute(
        		'/api/learn_me',
        		array('module' => 'bsdApiControl', 'action' => 'learnMe') ));

		}
	}

}