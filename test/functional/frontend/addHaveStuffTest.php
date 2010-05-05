<?php
/**
 * Test for creating "have stuff" resource entries
 */

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());
$browser->loadData();

$submitValues = array(
  'title'       => 'I have some stufffs',
  'email'       => 'ryan.weaver@iostudio.com',
  'privacy'     => 'web_form',
);
$dbValues = $submitValues;
$dbValues['transaction_type'] = 'have';


$browser->info('1 - You have stuff, fill out the form')
  ->get('/have/stuff/add')
  
  ->with('response')->begin()
    ->checkForm('HaveStuffResourceForm')
  ->end()
  
  ->info('  1.1 - Fill out a blank form, check for errors')
  ->click('form[name=stuff_resource] input[type=submit]')
  
  ->with('request')->begin()
    ->isParameter('module', 'stuff')
    ->isParameter('action', 'addHaveCreate')
  ->end()
  
  ->with('form')->begin()
    ->hasErrors(true)
  ->end()
  
  ->info('  1.2 - Fill out a real form')
  ->click('form[name=stuff_resource] input[type=submit]', array('stuff_resource' => $submitValues))

  ->with('form')->begin()
    ->hasErrors(false)
  ->end()

  ->info('  1.3 - See that we sent the person an email')
  ->with('mailer')->begin()
    ->withMessage($submitValues['email'])
    ->checkBody('/auth\//')
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
    ->info('  1.5 - Check that the StuffResource entry itself was saved correctly')
    ->check('StuffResource', $dbValues)
  ->end()
  
  ->with('response')->isRedirected()->followRedirect()
  
  ->with('request')->begin()
    ->isParameter('module', 'stuff')
    ->isParameter('action', 'match')
  ->end()
  
  ->with('response')->begin()
    ->isStatusCode(200)
    ->matches('/'.$submitValues['title'].'/')
  ->end()
;

$user = Doctrine_Core::getTable('sfGuardUser')->findOneByUsername($submitValues['email']);

$browser
  ->info('going to the link from the email and verify we have an account')
  
  ->get('/auth/foo-bar')
  
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'authenticate')
  ->end()
  
  ->with('user')
    ->isAuthenticated(false)
  
  ->get('/auth/'.$user->password)
  
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'authenticate')
  ->end()
  
  ->with('user')
    ->isAuthenticated(true)
  
  ->with('response')->begin()
    ->isRedirected()
    ->followRedirect()
  ->end()
  
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'resource')
  ->end()
;


