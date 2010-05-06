<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$browser
  ->get('/')
  
  ->click('I Have...')
    ->isModuleAction('resource', 'have')
    
  ->click('Time')
    ->isModuleAction('time', 'have')
    
  ->call('/time/list', 'post', $parameters = array('start'=>'2010-05-04 00:00:00'))
    ->isModuleAction('resource', 'timeList')
    
  ->with('response')->begin()
    ->matches('/<li><a href/')
  ->end()
    
  ->click('5/5 from 6:00 to 8:00')
    ->isModuleAction('time', 'show')
    
  ->with('response')->begin()
    ->matches('/5157 Whitaker Dr/')
    // ->checkForm('contactResrouceOwnerForm')
  ->end()
;