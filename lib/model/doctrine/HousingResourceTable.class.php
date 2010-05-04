<?php


class HousingResourceTable extends ResourceTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('HousingResource');
    }
}