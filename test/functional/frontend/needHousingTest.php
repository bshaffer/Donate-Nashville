<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Need...')
    ->isModuleAction('resource', 'need')
    
  ->click('Housing')
    ->isModuleAction('resource', 'housing')
    
  ->with('response')->begin()
    ->matches('/Tennessean/')
    // ->checkForm('contactResrouceOwnerForm')
  ->end()
;