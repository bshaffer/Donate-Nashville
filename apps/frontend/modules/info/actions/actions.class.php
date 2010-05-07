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
  /**
   * Displays the actual resource
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();

    $this->type = $this->resource->getOppositeType();

    $this->breadcrumbs->add($this->resource['title']);
  }
  
}
