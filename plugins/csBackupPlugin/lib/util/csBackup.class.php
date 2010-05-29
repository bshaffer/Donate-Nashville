<?php

/**
* 
*/
class csBackup
{
  function __construct($params = array())
  {
    $required = array('username', 'password', 'database');
    foreach ($required as $param) 
    {
      if (!isset($params[$param])) 
      {
        throw new sfException(sprintf("Missing required parameter '%s'", $param));
      }
      $this->connection = $params;
    }
  }
  
  public static function buildFtpCommand($params)
  {
    $command = 'ftp ';
    
    if (isset($params['port'])) 
    {
      $command .= sprintf(' -P%s', $params['port']);
    }
    
    if (is_array($params['source'])) 
    {
      $params['source'] = implode(' ', $params['source']);
    }
    
    return sprintf('%s %s %s:%s', $command, $params['source'], $params['target'], $params['target_dir']);
  }
  
  public static function buildScpCommand($params)
  {
    $command = 'scp ';
    
    if (isset($params['port'])) 
    {
      $command .= sprintf(' -P%s', $params['port']);
    }
    
    if (is_array($params['source'])) 
    {
      $params['source'] = implode(' ', $params['source']);
    }
    
    return sprintf('%s %s %s:%s', $command, $params['source'], $params['target'], $params['target_dir']);
  }
  
  public static function buildMysqlBackupCommand($params)
  {
    $command = dirname(__FILE__).'/../../data/script/automysqlbackup.sh';
    
    $validParams = array(
        'username'           => 'u',
        'password'           => 'p',
        'host'               => 'h',
        'dbname'             => 'n',
        'backup_dir'         => 'd',
        'email'              => 'm',
        'command'            => 'c',
      );
    
    foreach ($params as $param => $val) 
    {
      if (isset($validParams[$param])) 
      {      
        if (is_array($val)) 
        {
          $val = sprintf('\'%s\'', implode(' ', $val));  // spaces in argument require surrounding quotes
        }
        
        if (!$val) 
        {
          $val = "''";  // empty strings require surrounding quotes
        }
        
        if ($param == 'backup_dir') 
        {
          $val = self::cleanSystemPath($val);
        }
      
        $command .= sprintf(' -%s %s', $validParams[$param], $val);
      }
    }
    
    return $command;
  }
  
  public static function buildRsyncCommand($params, $source, $path)
  {
    $command = 'rsync';
    
    foreach ($params as $param => $val) 
    {
      if (true === $val) 
      {
        $command .= sprintf(' --%s', $param);
      }
      elseif(is_array($val))
      {
        foreach ($val as $arrVal) 
        {
          $command .= sprintf(' --%s %s', $param, $arrVal);
        }
      }
      elseif(false != $val)
      {
        $command .= sprintf(' --%s %s', $param, $val);
      }
    }
    
    $command .= ' ' . implode(' ', (array) $source);

    $command .= sprintf(' %s', $path);
    
    return $command;
  }
  
  public function cleanSystemPath($path)
  {
    if (strpos($path, '/') !== 0) 
    {
      $path = sfConfig::get('sf_root_dir').'/'.$path;
    }
    
    return $path;
  }
}