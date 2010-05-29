<?php

/**
* 
*/
class csBackupDbTask extends sfBaseTask
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
      new sfCommandOption('username', null, sfCommandOption::PARAMETER_REQUIRED, 'Username to access the MySQL server e.g. password'),
      new sfCommandOption('password', null, sfCommandOption::PARAMETER_REQUIRED, 'Password to access the MySQL server e.g. password'),
      new sfCommandOption('host', null, sfCommandOption::PARAMETER_REQUIRED, 'Host name (or IP address) of MySQL server e.g localhost'),
      new sfCommandOption('dbname', null, sfCommandOption::PARAMETER_REQUIRED | sfCommandOption::IS_ARRAY, 'List of database names for Daily/Weekly Backup'),
      new sfCommandOption('backup_dir', null, sfCommandOption::PARAMETER_REQUIRED, 'Backup directory location e.g /backups'),
      new sfCommandOption('email', null, sfCommandOption::PARAMETER_REQUIRED, 'Email Address to send mail to (user@domain.com)'),
      new sfCommandOption('command', null, sfCommandOption::PARAMETER_REQUIRED, 'System command to dump mysql data.'),
    ));

    $this->namespace = 'backup';
    $this->name = 'db';
    $this->briefDescription = 'Create a daily/weekly backup of your mysql database or databases';

    $this->detailedDescription = <<<EOF
The [backup:mysql|INFO] task backs up your project and stores it to a location according to your configuration

EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $emailValidator = new sfValidatorEmail(array('required' => false), array('invalid' => 'Email must be valid'));
    $options['email'] = $emailValidator->clean($options['email']);

    $databaseManager  = new sfDatabaseManager($this->configuration);
    $conn             = $databaseManager->getDatabase('doctrine')->getDoctrineConnection();
    $manager          = Doctrine_Manager::getInstance();

    // Properties in databases.yml
    $this->connectionProperties = array_merge($conn->getOptions(), $manager->parsePdoDsn($conn->getOption('dsn')));
    
    switch ($this->connectionProperties['scheme']) 
    {
      case 'mysql':
        $this->doMysql($arguments, $options);
        break;

      default:
        throw new sfException(sprintf("Connection scheme '%s' not supported", $this->connectionProperties['scheme']));
    }
  }
  
  protected function doMysql($arguments = array(), $options = array())
  {
    $defaults = sfConfig::get('app_csBackup_mysql', array());

    // Override properties in databases.yml with app.yml (for configuration)
    $defaults = array_merge($this->connectionProperties, array_filter($defaults));
    
    // Override properties in app.yml with directly passed parameters
    $options = array_merge($defaults, array_filter($options));
    
    // Build mysql backup command
    $cmd = csBackup::buildMysqlBackupCommand($options, $source, $target);
    
    $this->logSection('backup', 'Backing up files to '.$target);
    
    $this->logSection('mysql', $cmd);
    
    exec($cmd, $messages);
    
    foreach ($messages as $message) 
    {
      $this->logSection('mysql', $message, null);
    }
  }
}
