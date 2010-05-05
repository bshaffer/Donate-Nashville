<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('Have')
    ->isModuleAction('resource', 'have')
    
  ->click('Time')
    ->isModuleAction('time', 'have')
;