<?php

/**
 * BaseHousingResource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * 
 * @package    skeleton
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHousingResource extends Resource
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('housing_resource');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}