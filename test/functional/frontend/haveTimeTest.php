<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Have...')
    ->isModuleAction('resource', 'have')
    
  ->click('Time')
    ->isModuleAction('time', 'have')
;