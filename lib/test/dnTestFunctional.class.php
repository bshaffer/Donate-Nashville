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
}
