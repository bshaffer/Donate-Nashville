<?php


class MaterialResourceTable extends ResourceTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MaterialResource');
    }
}