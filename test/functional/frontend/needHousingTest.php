<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Need...')
    ->isModuleAction('resource', 'need')
    
  ->click('A Place')
    ->isModuleAction('resource', 'place')
    
  ->with('response')->begin()
    ->matches('/Tennessean/')
    // ->checkForm('contactResrouceOwnerForm')
  ->end()
;