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
}
