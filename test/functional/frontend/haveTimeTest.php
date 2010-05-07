<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$neededTime = csFactory::create('TimeResource', array('transaction_type' => 'need', 'title' => csFactory::generate('Time Resource '), 'owner_id' => csFactory::selectRandomId('sfGuardUser')));

$neededTime['resource_date'] = date('Y-m-d');

$neededTime->save();

$browser
  ->get('/')
  
  ->click('I Have')
    ->isModuleAction('resource', 'have')
    
  ->click('Time')
    ->isModuleAction('time', 'have')
    
  ->call('/time/list', 'post', $parameters = array('start' => date('Y-m-d')))
    ->isModuleAction('resource', 'timeList')

  ->with('response')->begin()
    ->matches(sprintf('/%s/i', $neededTime['title']))
  ->end()
    
  ->get(sprintf('/have/time/%s', $neededTime['id']))
    ->isModuleAction('time', 'show')
    
  ->with('response')->begin()
    ->matches(sprintf('/%s/', $neededTime['title']))
  ->end()
;