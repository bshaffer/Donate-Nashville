<?php

/**
 * stuff actions.
 *
 * @package    skeleton
 * @subpackage stuff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class frontendActions extends sfActions
{
  public function preExecute()
  {
    $this->breadcrumbs = sfBreadcrumbs::getInstance();
  }
}