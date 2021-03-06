<?php

/**
 * BasebsdApiUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $guard_id
 * @property string $api_key
 * @property boolean $api_access
 * @property sfGuardUser $sfGuardUser
 * 
 * @method integer     getId()          Returns the current record's "id" value
 * @method integer     getGuardId()     Returns the current record's "guard_id" value
 * @method string      getApiKey()      Returns the current record's "api_key" value
 * @method boolean     getApiAccess()   Returns the current record's "api_access" value
 * @method sfGuardUser getSfGuardUser() Returns the current record's "sfGuardUser" value
 *
 * @method bsdApiUser  setId()          Sets the current record's "id" value
 * @method bsdApiUser  setGuardId()     Sets the current record's "guard_id" value
 * @method bsdApiUser  setApiKey()      Sets the current record's "api_key" value
 * @method bsdApiUser  setApiAccess()   Sets the current record's "api_access" value
 * @method bsdApiUser  setSfGuardUser() Sets the current record's "sfGuardUser" value
 * 
 * @package    bsdApiPlugin
 * @subpackage model
 * @author     druid628
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginBaseBsdApiUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bsd_api_user');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('guard_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('api_key', 'string', 35, array(
             'type' => 'string',
             'length' => 35,
             ));
        $this->hasColumn('api_access', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'guard_id',
             'foreign' => 'id'));
    }
}
