<?php

/**
 * Testing class to help with testing
 * 
 * Always begin your functional tests with:
 * 
 * $browser = new dnTestFunctional(new sfBrowser());
 */
class dnTestFunctional extends sfTestFunctional
{
  /**
   * Override to always load in the doctrine tester
   */
  public function __construct($hostname = null, $remote = null, $options = array())
  {    
    parent::__construct($hostname, $remote, $options);
    
    $this->setTester('doctrine', 'sfTesterDoctrine');
  }

  /**
   * @return snTestFunctional
   */
  public function loadData()
  {
    Doctrine_Core::loadData(sfConfig::get('sf_data_dir').'/fixtures');
    
    return $this;
  }
  
  public function isModuleAction($module, $action, $statusCode = 200)
  {
    $this->with('request')->begin()->
  	  isParameter('module', $module)->
  	  isParameter('action', $action)->
  	end()->  

    with('response')->begin()->
    	isStatusCode($statusCode)->
    end();

    return $this;
  }

  public function login($username = 'admin', $password = csFactory::DEFAULT_PASSWORD, $debug = false)
  {
    $this
      ->info(sprintf('Logging in with %s/%s ', $username, $password))
      ->get('/login')
      ->setField('signin[username]', $username)
      ->setField('signin[password]', $password)
      ->click('sign in');
      
    if ($debug) 
    {
      $this->with('response')->begin()
        ->debug()
      ->end();
    }
    
    return $this->followRedirect();
  }
  
  public function logout()
  {
    return $this
      ->get('/logout')
      
      ->isModuleAction('sfGuardAuth', 'signout', 302)
      
      ->followRedirect()
      
      ->with('user')->begin()
        ->isAuthenticated(false)
      ->end()
    ;
  } 
}
