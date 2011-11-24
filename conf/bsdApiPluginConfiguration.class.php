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
