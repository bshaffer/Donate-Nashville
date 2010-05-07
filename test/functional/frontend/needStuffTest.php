<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new dnTestFunctional(new sfBrowser());

$availableStuff = csFactory::create('StuffResource', array('transaction_type' => 'have', 'title' => csFactory::generate('Stuff Resource '), 'owner_id' => csFactory::selectRandomId('sfGuardUser')));

$availableStuff->save();

// Delete all existing data
$browser
  ->get('/')
  
  ->click('I Need')
    ->isModuleAction('resource', 'need')
    
  ->click('Stuff')
    ->isModuleAction('stuff', 'need')
    
  ->info('first we will look for something that is a needed resource, a picnic table, and expect no results')
  ->call('/stuff/list', 'post', $parameters = array('q' => 'picnic', 'type' => 'have'))
    ->isModuleAction('resource', 'stuffList')
    
  ->info('you need a picnic table? yeah well so does everyone else')
  ->with('response')->begin()
    ->matches('!/picnic/i')
  ->end()
    
  ->call('/stuff/list', 'post', $parameters = array('q' => 'pump', 'type' => 'have'))
    ->isModuleAction('resource', 'stuffList')
    
  ->with('response')->begin()
    ->matches('/sump/i')
  ->end()
    
  ->call('/stuff/list', 'post', $parameters = array('q' => $availableStuff['title'], 'type' => 'have'))
    ->isModuleAction('resource', 'stuffList')
    
  ->with('response')->begin()
    ->matches(sprintf('/%s/i', $availableStuff['title']))
  ->end()
    
  ->get(sprintf('/need/stuff/%s', $availableStuff['id']))
    ->isModuleAction('stuff', 'show')
    
  ->with('response')->begin()
    ->matches(sprintf('/%s/', $availableStuff['title']))
  ->end()
;

$resource = Doctrine_Core::getTable('stuffResource')->findOneByTitle('Sump Pump');

$browser
  ->get(sprintf('/need/stuff/%s', $resource['id']))
    ->isModuleAction('stuff', 'show')

  ->with('response')->begin()
    ->matches(sprintf('/%s/', $resource['title']))
    ->checkForm('ContactResourceOwnerForm')
  ->end()

  ->call('/stuff/'.$resource->id.'/message', 'post', array('contact'=>array(
      'email'=>'lacyrhoades@gmail.com',
      'name'=>'Lacy',
      'phone'=>'12345',
      'notes'=>'Takin notes!'
    )))
  
  ->with('mailer')->begin()
    ->hasSent(true)
    ->withMessage($resource->User->username)
;