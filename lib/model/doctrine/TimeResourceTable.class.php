<?php


class TimeResourceTable extends ResourceTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('TimeResource');
    }
}