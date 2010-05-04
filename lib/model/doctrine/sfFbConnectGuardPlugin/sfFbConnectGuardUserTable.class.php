<?php


class sfFbConnectGuardUserTable extends PluginsfFbConnectGuardUserTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfFbConnectGuardUser');
    }
}