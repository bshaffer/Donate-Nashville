<?php

/**
 * info actions.
 *
 * @package    skeleton
 * @subpackage info
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class infoActions extends frontendActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->info_resources = Doctrine::getTable('InfoResource')
      ->createQuery('a')
      ->orderBy('a.title ASC')
      ->execute();
  }
  
  /**
   * Displays the actual resource
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();

    $this->type = $this->resource->getOppositeType();

    $this->breadcrumbs->add($this->resource['title']);
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new InfoResourceForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InfoResourceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($info_resource = Doctrine::getTable('InfoResource')->find(array($request->getParameter('id'))), sprintf('Object info_resource does not exist (%s).', $request->getParameter('id')));
    $this->form = new InfoResourceForm($info_resource);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($info_resource = Doctrine::getTable('InfoResource')->find(array($request->getParameter('id'))), sprintf('Object info_resource does not exist (%s).', $request->getParameter('id')));
    $this->form = new InfoResourceForm($info_resource);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($info_resource = Doctrine::getTable('InfoResource')->find(array($request->getParameter('id'))), sprintf('Object info_resource does not exist (%s).', $request->getParameter('id')));
    $info_resource->delete();

    $this->redirect('info/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $info_resource = $form->save();

      $this->redirect('info/edit?id='.$info_resource->getId());
    }
  }
}
