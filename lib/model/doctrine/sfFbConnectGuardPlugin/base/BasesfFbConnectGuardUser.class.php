<?php

/**
 * BasesfFbConnectGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $facebook_id
 * @property sfGuardUser $User
 * 
 * @method integer              getUserId()      Returns the current record's "user_id" value
 * @method integer              getFacebookId()  Returns the current record's "facebook_id" value
 * @method sfGuardUser          getUser()        Returns the current record's "User" value
 * @method sfFbConnectGuardUser setUserId()      Sets the current record's "user_id" value
 * @method sfFbConnectGuardUser setFacebookId()  Sets the current record's "facebook_id" value
 * @method sfFbConnectGuardUser setUser()        Sets the current record's "User" value
 * 
 * @package    skeleton
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfFbConnectGuardUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_fb_connect_guard_user');
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('facebook_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}