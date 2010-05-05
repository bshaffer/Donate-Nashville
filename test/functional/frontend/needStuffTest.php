<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Need...')
    ->isModuleAction('resource', 'need')
    
  ->click('Stuff')
    ->isModuleAction('stuff', 'need')
    
  ->call('/stuff/list', 'post', $parameters = array('q'=>'pump'))
    ->isModuleAction('resource', 'stuffList')
    
  ->with('response')->begin()
    ->matches('/sump/i')
  ->end()
    
  ->click('Sump Pump')
    ->isModuleAction('stuff', 'match')
    
  ->with('response')->begin()
    ->matches('/1313 N. 4th Ave/')
    ->matches('/Contact This User/')
  ->end()
  
;