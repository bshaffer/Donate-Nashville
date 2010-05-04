<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
$local = in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);

//Check that the user is authenticated (or that the project is local)
// before allowing access to the dev environment
sfContext::createInstance($configuration);
if($local || sfContext::getInstance()->getUser()->isSuperAdmin())
{
	sfContext::getInstance()->dispatch();
}
else
{
	die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}