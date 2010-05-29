<?php

/**
* 
*/
class csBackupFileTask extends sfBaseTask
{
  /**
  * @see sfTask
  */
  protected function configure()
  {
    $this->addArguments(array(
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment to back up', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment to back up', 'prod'),
      new sfCommandOption('scp', null, sfCommandOption::PARAMETER_NONE, 'use scp for file backup'),
      new sfCommandOption('ftp', null, sfCommandOption::PARAMETER_NONE, 'use ftp for file backup'),
      new sfCommandOption('rsync', null, sfCommandOption::PARAMETER_NONE, 'use rsync for file backup'),
      new sfCommandOption('source', null, sfCommandOption::PARAMETER_REQUIRED | sfCommandOption::IS_ARRAY, 'directories to rsync'),
      new sfCommandOption('target', null, sfCommandOption::PARAMETER_REQUIRED, 'The destination for the backup'),
      new sfCommandOption('target_dir', null, sfCommandOption::PARAMETER_REQUIRED, 'The destination directory for the backup'),
      new sfCommandOption('port', null, sfCommandOption::PARAMETER_REQUIRED, 'The port used for the destination'),
    ));

    $this->namespace = 'backup';
    $this->name = 'file';
    $this->briefDescription = 'Backup directories in your project using Rsync';

    $this->detailedDescription = <<<EOF
The [backup:file|INFO] task backs up your project and stores it to a location according to your configuration

EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    if (!$options['rsync'] && !$options['scp'] && !$options['ftp']) 
    {
      throw new InvalidArgumentException("You must include at least one of the following options: --rsync, --scp, --ftp");
    }
    
    if ($options['rsync']) 
    {
      $this->doRsync($arguments, $options);
    }
    
    if($options['scp'])
    {
      $this->doScp($arguments, $options);
    }
    
    if($options['ftp'])
    {
      $this->doFtp($arguments, $options);
    }
  }
  
  protected function doScp($arguments = array(), $options = array())
  {
    $defaults = sfConfig::get('app_csBackup_scp', array());

    $source = $options['source'] ? (array) $options['source'] : $defaults['source'];
    
    $target = $options['target'] ? $options['target'] : $defaults['target'];

    if (!$source) 
    {
      throw new sfException("At least one SCP source must be set in app.yml or passed to the task as --source");
    }

    if (!$target) 
    {
      throw new sfException("the SCP target must be set in app.yml or passed to the task as --target");
    }

    foreach ($source as &$s) 
    {
      $s = csBackup::cleanSystemPath($s);
    }
    
    $cmd = csBackup::buildScpCommand($defaults['options'], $source, $target);
    
    $this->logSection('backup', $cmd);
    
    exec($cmd, $messages);
    
    foreach ($messages as $message) 
    {
      $this->logSection('backup', $message, null);
    }
  }
  
  protected function doFtp($arguments = array(), $options = array())
  {
    $defaults = sfConfig::get('app_csBackup_ftp', array());

    $source = $options['source'] ? (array) $options['source'] : $defaults['source'];
    
    $target = $options['target'] ? $options['target'] : $defaults['target'];

    if (!$source) 
    {
      throw new sfException("At least one SCP source must be set in app.yml or passed to the task as --source");
    }

    if (!$target) 
    {
      throw new sfException("the SCP target must be set in app.yml or passed to the task as --target");
    }

    foreach ($source as &$s) 
    {
      $s = csBackup::cleanSystemPath($s);
    }
    
    $cmd = csBackup::buildScpCommand($defaults['options'], $source, $target);
    
    $this->logSection('backup', $cmd);
    
    exec($cmd, $messages);
    
    foreach ($messages as $message) 
    {
      $this->logSection('backup', $message, null);
    }
  }

  protected function doRsync($arguments = array(), $options = array())
  {
    $defaults = sfConfig::get('app_csBackup_rsync', array());

    $source = $options['source'] ? (array) $options['source'] : $defaults['source'];
    
    $target = $options['target'] ? $options['target'] : $defaults['target'];

    if (!$source) 
    {
      throw new sfException("At least one RSYNC source must be set in app.yml or passed to the task as --source");
    }

    if (!$target) 
    {
      throw new sfException("the RSYNC target must be set in app.yml or passed to the task as --target");
    }

    foreach ($source as &$s) 
    {
      $s = csBackup::cleanSystemPath($s);
    }
    
    $cmd = csBackup::buildRsyncCommand($defaults['options'], $source, $target);
    
    $this->logSection('rsync', $cmd);
    
    exec($cmd, $messages);
    
    foreach ($messages as $message) 
    {
      $this->logSection('rsync', $message, null);
    }
  }
}
