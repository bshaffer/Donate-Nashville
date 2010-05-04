<?php

/**
 * main actions.
 *
 * @package    sfGoogleAnalyticsProject
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 11927 2008-10-03 16:51:27Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
}
