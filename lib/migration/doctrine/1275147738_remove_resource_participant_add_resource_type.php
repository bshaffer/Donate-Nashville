<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RemoveResourceParticipantAddResourceTypeMigration extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropTable('resource_participant');
        $this->addColumn('contact', 'resource_type', 'string', '255', array(
             ));
    }

    public function down()
    {
        $this->createTable('resource_participant', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'participant_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'resource_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             ), array(
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => '',
             'charset' => '',
             ));
        $this->removeColumn('contact', 'resource_type');
    }
}