<?php


class StuffResourceTable extends ResourceTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('StuffResource');
    }
}