<?php

/**
 * BasesfGuardUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone_1
 * @property string $phone_2
 * @property string $facebook_uid
 * @property enum $account_type
 * @property sfGuardUser $User
 * 
 * @method integer            getUserId()       Returns the current record's "user_id" value
 * @method string             getAddress1()     Returns the current record's "address_1" value
 * @method string             getAddress2()     Returns the current record's "address_2" value
 * @method string             getCity()         Returns the current record's "city" value
 * @method string             getState()        Returns the current record's "state" value
 * @method string             getZip()          Returns the current record's "zip" value
 * @method string             getPhone1()       Returns the current record's "phone_1" value
 * @method string             getPhone2()       Returns the current record's "phone_2" value
 * @method string             getFacebookUid()  Returns the current record's "facebook_uid" value
 * @method enum               getAccountType()  Returns the current record's "account_type" value
 * @method sfGuardUser        getUser()         Returns the current record's "User" value
 * @method sfGuardUserProfile setUserId()       Sets the current record's "user_id" value
 * @method sfGuardUserProfile setAddress1()     Sets the current record's "address_1" value
 * @method sfGuardUserProfile setAddress2()     Sets the current record's "address_2" value
 * @method sfGuardUserProfile setCity()         Sets the current record's "city" value
 * @method sfGuardUserProfile setState()        Sets the current record's "state" value
 * @method sfGuardUserProfile setZip()          Sets the current record's "zip" value
 * @method sfGuardUserProfile setPhone1()       Sets the current record's "phone_1" value
 * @method sfGuardUserProfile setPhone2()       Sets the current record's "phone_2" value
 * @method sfGuardUserProfile setFacebookUid()  Sets the current record's "facebook_uid" value
 * @method sfGuardUserProfile setAccountType()  Sets the current record's "account_type" value
 * @method sfGuardUserProfile setUser()         Sets the current record's "User" value
 * 
 * @package    skeleton
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardUserProfile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user_profile');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('address_1', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('address_2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('city', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('state', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('zip', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('phone_1', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('phone_2', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('facebook_uid', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('account_type', 'enum', null, array(
             'type' => 'enum',
             'default' => 'individual',
             'values' => 
             array(
              0 => 'individual',
              1 => 'shelter',
              2 => 'nonprofit',
             ),
             'notnull' => true,
             ));


        $this->index('facebook_uid_index', array(
             'fields' => 
             array(
              0 => 'facebook_uid',
             ),
             'unique' => true,
             ));
        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $locatable0 = new Doctrine_Template_Locatable(array(
             'fields' => 
             array(
              0 => 'address_1',
              1 => 'address_2',
              2 => 'city',
              3 => 'state',
              4 => 'zip',
             ),
             ));
        $this->actAs($locatable0);
    }
}