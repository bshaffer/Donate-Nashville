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
  
  public function executeExport($request)
  {
    if ($request->isMethod('POST')) 
    {
      $exportManager = sfExportManager::create('Resource');

      $sheets = array(
        'stuff' => array('have', 'need'), 
        'info' => array('have', 'need'),
        'time' => array('need'));
      
      foreach ($sheets as $prefix => $types) 
      {
        $class = sfInflector::camelize($prefix.'Resource');
        $fields = Doctrine::getTable($class)->getColumnNames();
        $fields = array_combine($fields, $fields);

        foreach ($fields as $key => $value) 
        {
          $fields[$key] = sfInflector::humanize($value);
        }
      
        foreach ($types as $type) 
        {
          $results = Doctrine::getTable($class)->createQuery()->where('transaction_type = ?', $type)->execute();
          $exportManager->exportCollectionSheet($results, $fields, sprintf('%s %s', $type, $prefix));
        }
      }
      $title = $request->getParameter('title', 'Donate_Nashville_Export');
      $title = $request->getParameter('include_timestamp') ? $title . '-' . date('Y-m-d H:i') : $title;
      $exportManager->output($title);

      return sfView::NONE;
    }

  }
}
