<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new csTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('Need')
    ->isModuleAction('resource', 'need')
    
  ->click('Stuff')
    ->isModuleAction('stuff', 'need')
;