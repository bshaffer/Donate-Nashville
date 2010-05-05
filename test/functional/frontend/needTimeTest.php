<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('Need')
    ->isModuleAction('resource', 'need')
    
  ->click('Help')
    ->isModuleAction('time', 'addNeed')
;