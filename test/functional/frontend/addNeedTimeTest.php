<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());
$browser->loadData();

$submitValues = array(
  'resource_date' => date('Y-m-d', time() + 86400),
  'start_time'  => '17:30',
  'end_time'    => '19:30',
  'title'       => 'A test volunteer event',
  'email'       => 'ryan.weaver@iostudio.com',
  'privacy'     => 'web_form',
);
$dbValues = $submitValues;
$dbValues['transaction_type'] = 'need';


$browser->info('1 - You need time, fill out the form')
  ->get('/need/time/add')
  
  ->with('response')->begin()
    ->checkForm('NeedTimeResourceForm')
  ->end()
  
  ->info('  1.1 - Fill out a blank form, check for errors')
  ->click('form[name=time_resource] input[type=submit]')
  
  ->with('request')->begin()
    ->isParameter('module', 'time')
    ->isParameter('action', 'addNeedCreate')
  ->end()
  
  ->with('form')->begin()
    ->hasErrors(true)
  ->end()
  
  ->info('  1.2 - Fill out a real form')
  ->click('form[name=time_resource] input[type=submit]', array('time_resource' => $submitValues))

  ->with('form')->begin()
    ->hasErrors(false)
  ->end()

  ->info('  1.3 - See that we sent the person an email')
  ->with('mailer')->begin()
    ->withMessage('ryan.weaver@iostudio.com')
  ->end()
  
  ->with('doctrine')->begin()
    ->info('  1.4 - See that the user was created an account')
    ->check('sfGuardUser', array('username' => $submitValues['email'], 'email_address' => $submitValues['email']))
  ->end()
;
$user = Doctrine_Core::getTable('sfGuardUser')->findOneByUsername($submitValues['email']);
$dbValues['owner_id'] = $user->id;

$browser
  ->with('doctrine')->begin()
    ->info('  1.5 - Check that the TimeResource entry itself was saved correctly')
    ->check('TimeResource', $dbValues)
  ->end()
  
  ->with('response')->isRedirected()->followRedirect()
  
  ->with('request')->begin()
    ->isParameter('module', 'time')
    ->isParameter('action', 'show')
  ->end()
  
  ->with('response')->begin()
    ->isStatusCode(200)
    ->checkElement('h1', '/'.$submitValues['title'].'/')
  ->end()
;
