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
  const VERSION = '1.0.0-STABLE';
  /**
   * @see sfPluginConfiguration
   */
  public function getDependencies() 
  {
       return array('sfDoctrineGuardPlugin');
  }
  public function initialize()
  {
     	$this->dispatcher->connect('routing.load_configuration', array('bsdApiRouting', 'listenToRoutingLoadConfigurationEvent'));
      $this->dispatcher->connect('context.load_factories', array($this, 'checkDependencies'));

  }

  public function checkDependencies() 
  {
      $plugins = $this->configuration->getPlugins();
      foreach ($this->getDependencies() as $dependency) 
      {
          if (!in_array($dependency, $plugins)) 
          {
               throw new sfException(sprintf('The plugin "bsdApiPlugin" requires "%s" to be enabled.', $dependency));
          }
      }
  }
}
