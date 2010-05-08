<?php

/**
 * statistics actions.
 *
 * @package    skeleton
 * @subpackage statistics
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statisticsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->active_have_time = Doctrine::getTable('TimeResource')->getList('have');
    $this->active_need_time = Doctrine::getTable('TimeResource')->getList('need');
    $this->fulfilled_have_time = Doctrine::getTable('TimeResource')->getList('have', 1);
    $this->fulfilled_need_time = Doctrine::getTable('TimeResource')->getList('need', 1);

    $this->active_have_stuff = Doctrine::getTable('StuffResource')->getList('have');
    $this->active_need_stuff = Doctrine::getTable('StuffResource')->getList('need');
    $this->fulfilled_have_stuff = Doctrine::getTable('StuffResource')->getList('have', 1);
    $this->fulfilled_need_stuff = Doctrine::getTable('StuffResource')->getList('need', 1);
  }
}
