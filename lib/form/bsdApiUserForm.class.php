<?php

/**
 * bsdApiUser form.
 *
 * @package    bsdApiPlugin
 * @subpackage form
 * @author     druid628
 */
class bsdApiUserForm extends PluginBsdApiUserForm
{
  public function configure()
  {
    $ws = $this->getWidgetSchema();
    if(sfContext::hasInstance() && sfContext::getInstance()->getUser()->isAuthenticated())
    {
        $q = Doctrine_Query::create()
          ->from('sfGuardUser sfg')
          ->where('id = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId());
    
        $ws['guard_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'sfGuardUser',
            'query' => $q,
            'add_empty' => false));
    }

    if($this->getObject()->isNew())
    {
      $ws['api_key'] = new sfWidgetFormInputHidden();
    }
    parent::configure();
  }

}
