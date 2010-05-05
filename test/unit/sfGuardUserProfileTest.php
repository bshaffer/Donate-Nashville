<?php

include(dirname(__FILE__) . '/../bootstrap/Doctrine.php');

// $app = 'frontend';
// include(dirname(__FILE__) . '/../bootstrap/functional.php');

$t = new lime_test(6, new lime_output_color());

$user = csFactory::create('sfGuardUser', array('username' => csFactory::generate()));
$user['Profile'] = csFactory::create('sfGuardUserProfile');
$user->save();

$t->is($user['Profile']->getAddressArray(), array(), 'No Address Info');
$t->is($user['Profile']->getAddress(), '', 'No Address Info');

$user['Profile']['city'] = 'Nashville';
$t->is($user['Profile']->getAddress(), 'Nashville', 'Correct Address Info');

$user['Profile']['state'] = 'TN';
$t->is($user['Profile']->getAddress(), 'Nashville, TN', 'Correct Address Info');

$user['Profile']['zip'] = '37211';
$t->is($user['Profile']->getAddress(), 'Nashville, TN, 37211', 'Correct Address Info');

$user['Profile']['address_1'] = '5157 Whitaker Dr.';
$t->is($user['Profile']->getAddress("\n"), "5157 Whitaker Dr.\nNashville, TN, 37211", 'Correct Address Info');