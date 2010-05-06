<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());
$browser->loadData();

$user = Doctrine_Query::create()->from('sfGuardUser')->fetchOne();

$browser->info('1 - Test the user authentication hash system')
  ->info('  1.1 - Try an invalid authentication')

  ->get('/auth/fake')
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'authenticate')
  ->end()
  
  ->with('response')->begin()
    ->isStatusCode(401)
    ->matches('/Invalid Token/')
  ->end()
  
  ->info('  1.2 - Use the auth with a real key')
  ->get('/auth/'.$user->password)
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'authenticate')
  ->end()
  
  ->with('response')->begin()
    ->isRedirected()->followRedirect()
  ->end()
  
  ->info('  1.3 - The user is now authenticated')
  ->with('user')->begin()
    ->isAuthenticated(true)
  ->end()
  
  ->info('  1.4 - Page is redirected to user resource')
  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'resource')
  ->end()
;

$browser->info('2 - Request my login token')
  ->get('/user/send-token')
  
  ->with('response')->begin()
    ->isStatusCode(200)
    ->checkForm('sendLoginTokenForm')
  ->end()
  
  ->info('  2.1 - Submit an invalid form')
  ->click('form[id=send-token-form] input[type=submit]', array('send_login' => array(
    'email' => 'fake@fake.com'
  )))

  ->with('request')->begin()
    ->isParameter('module', 'user')
    ->isParameter('action', 'sendLoginTokenProcess')
  ->end()

  ->with('form')->begin()
    ->hasErrors(true)
  ->end()
  
  ->info('  2.2 - Submit a valid form')
  ->click('form[id=send-token-form] input[type=submit]', array('send_login' => array(
    'email' => 'bshafs@gmail.com'
  )))
  
  ->with('mailer')->begin()
    ->hasSent(1)
    ->withMessage('bshafs@gmail.com')
  ->end()
  
  ->with('response')->begin()
    ->matches('/Please check your email/')
  ->end()
;








