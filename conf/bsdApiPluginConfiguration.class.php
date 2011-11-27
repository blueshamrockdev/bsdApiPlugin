<?php

/*
 * This file is part of the symfony package.
 * (c) Micah Breedlove <micah@blueshamrock.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * bsdApiIPlugin configuration.
 * 
 * @package    bsdApiPlugin
 * @subpackage config
 * @author     Micah Breedlove <micah@blueshamrock.com>
 *
 */
class bsdApiPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {

	$this->dispatcher->connect('routing.load_configuration', array('bsdApiRouting', 'listenToRoutingLoadConfigurationEvent'));
	#$this->dispatcher->connect('user.method_not_found', array('bsdApiUser', 'methodNotFound'));

  }
  public function listenToRoutingLoadConfiguration(sfEvent $event)
  {
      // $routing = $event->getSubject();
      // if($sfConfig::get())
  $r = sfRouting::getInstance();
  $routes = $r->getRoutes();
  $r->clearRoutes();

  // Plugin home
  $r->connect('plugin_home', '/my_super_plugin/homepage', array(
    'module' => 'my_plugin_module',
    'action' => 'my_plugin_action',
    'additional_parameter'   => 1
    ));

  // Another route
  $r->connect('plugin_home', '/my_super_plugin/section1', array(
    'module' => 'my_plugin_module',
    'action' => 'my_plugin_action_section1',
    'additional_parameter'   => 2
    ));

  // ... other routes

  // Then merge new routes with the saved one
  $r->setRoutes($r->getRoutes() + $routes);
  }
 /*   if (sfConfig::get('app_sf_guard_plugin_routes_register', true) && in_array('sfGuardAuth', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('sfGuardRouting', 'listenToRoutingLoadConfigurationEvent'));
    }

    foreach (array('sfGuardUser', 'sfGuardGroup', 'sfGuardPermission') as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfGuardRouting', 'addRouteForAdmin'.str_replace('sfGuard', '', $module)));
      }
    } */
  }
}
