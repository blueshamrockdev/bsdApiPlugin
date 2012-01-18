<?php

/**
 * PluginBsdApiUser filter form base class.
 *
 * @package    UncleJoey
 * @subpackage filter
 * @author     druid628
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class PluginBsdApiUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'guard_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'api_key'    => new sfWidgetFormFilterInput(),
      'api_access' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'guard_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'api_key'    => new sfValidatorPass(array('required' => false)),
      'api_access' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('plugin_bsd_api_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PluginBsdApiUser';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'guard_id'   => 'ForeignKey',
      'api_key'    => 'Text',
      'api_access' => 'Boolean',
    );
  }
}
