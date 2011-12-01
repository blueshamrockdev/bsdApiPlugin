<?php

/**
 * PluginBsdApiUser form.
 *
 * @package    bsdApiPlugin
 * @subpackage form
 * @author     druid628
 */
class PluginBsdApiUserForm extends BaseFormDoctrine
{
  public function setup()
  {
  $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'guard_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'api_key'    => new sfWidgetFormInputText(),
      'api_access' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'guard_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'api_key'    => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'api_access' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bsdApiUser[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'bsdApiUser';
  }
}
