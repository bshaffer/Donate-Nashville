<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Have')
    ->isModuleAction('resource', 'have')
    
  ->click('Stuff')
    ->isModuleAction('stuff', 'have')
  
  ->info('first we will look for something that is a have-resource, a pump, and expect no results')
  
  ->call('/stuff/list', 'post', $parameters = array('q' => 'pump', 'type' => 'need'))
    ->isModuleAction('resource', 'stuffList')
    
  ->info('you have a pump? yeah so do we.')
  ->with('response')->begin()
    ->matches('!/pump/i')
  ->end()
    
  ->call('/stuff/list', 'post', $parameters = array('q' => 'picnic', 'type' => 'need'))
    ->isModuleAction('resource', 'stuffList')
    
  ->with('response')->begin()
    ->matches('/picnic table/i')
  ->end()
    
  ->click('Picnic Table')
    ->isModuleAction('stuff', 'show')
    
  ->with('response')->begin()
    ->matches(sprintf('/%s/', 'Picnic Table'))
    // ->checkForm('contactResrouceOwnerForm')
  ->end()
;