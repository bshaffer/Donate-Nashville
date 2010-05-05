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
}
