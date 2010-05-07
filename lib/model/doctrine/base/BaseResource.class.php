<?php

/**
 * BaseResource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $owner_id
 * @property enum $transaction_type
 * @property string $title
 * @property clob $description
 * @property enum $privacy
 * @property boolean $is_fulfilled
 * @property string $neighborhood
 * @property string $contact_name
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $county
 * @property string $phone_1
 * @property string $phone_2
 * @property string $email
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Contacts
 * 
 * @method integer             getOwnerId()          Returns the current record's "owner_id" value
 * @method enum                getTransactionType()  Returns the current record's "transaction_type" value
 * @method string              getTitle()            Returns the current record's "title" value
 * @method clob                getDescription()      Returns the current record's "description" value
 * @method enum                getPrivacy()          Returns the current record's "privacy" value
 * @method boolean             getIsFulfilled()      Returns the current record's "is_fulfilled" value
 * @method string              getNeighborhood()     Returns the current record's "neighborhood" value
 * @method string              getContactName()      Returns the current record's "contact_name" value
 * @method string              getAddress1()         Returns the current record's "address_1" value
 * @method string              getAddress2()         Returns the current record's "address_2" value
 * @method string              getCity()             Returns the current record's "city" value
 * @method string              getState()            Returns the current record's "state" value
 * @method string              getZip()              Returns the current record's "zip" value
 * @method string              getCounty()           Returns the current record's "county" value
 * @method string              getPhone1()           Returns the current record's "phone_1" value
 * @method string              getPhone2()           Returns the current record's "phone_2" value
 * @method string              getEmail()            Returns the current record's "email" value
 * @method sfGuardUser         getUser()             Returns the current record's "User" value
 * @method Doctrine_Collection getContacts()         Returns the current record's "Contacts" collection
 * @method Resource            setOwnerId()          Sets the current record's "owner_id" value
 * @method Resource            setTransactionType()  Sets the current record's "transaction_type" value
 * @method Resource            setTitle()            Sets the current record's "title" value
 * @method Resource            setDescription()      Sets the current record's "description" value
 * @method Resource            setPrivacy()          Sets the current record's "privacy" value
 * @method Resource            setIsFulfilled()      Sets the current record's "is_fulfilled" value
 * @method Resource            setNeighborhood()     Sets the current record's "neighborhood" value
 * @method Resource            setContactName()      Sets the current record's "contact_name" value
 * @method Resource            setAddress1()         Sets the current record's "address_1" value
 * @method Resource            setAddress2()         Sets the current record's "address_2" value
 * @method Resource            setCity()             Sets the current record's "city" value
 * @method Resource            setState()            Sets the current record's "state" value
 * @method Resource            setZip()              Sets the current record's "zip" value
 * @method Resource            setCounty()           Sets the current record's "county" value
 * @method Resource            setPhone1()           Sets the current record's "phone_1" value
 * @method Resource            setPhone2()           Sets the current record's "phone_2" value
 * @method Resource            setEmail()            Sets the current record's "email" value
 * @method Resource            setUser()             Sets the current record's "User" value
 * @method Resource            setContacts()         Sets the current record's "Contacts" collection
 * 
 * @package    skeleton
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseResource extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('resource');
        $this->hasColumn('owner_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('transaction_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'need',
              1 => 'have',
             ),
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('privacy', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'show_info',
              1 => 'web_form',
             ),
             'default' => true,
             ));
        $this->hasColumn('is_fulfilled', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('neighborhood', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('contact_name', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
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
        $this->hasColumn('county', 'string', 100, array(
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
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'owner_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Contact as Contacts', array(
             'local' => 'id',
             'foreign' => 'resource_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
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
        $this->actAs($timestampable0);
        $this->actAs($locatable0);
    }
}