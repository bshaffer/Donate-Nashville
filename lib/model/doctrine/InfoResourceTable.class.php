<?php


class InfoResourceTable extends ResourceTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('InfoResource');
    }
}