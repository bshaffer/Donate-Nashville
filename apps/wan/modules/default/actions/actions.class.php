<?php

/**
 * default actions.
 *
 * @package    skeleton
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }
  
  public function executeError404(sfWebRequest $request)
  {
    
  }
  
  public function executeSecure(sfWebRequest $request)
  {
    # code...
  }
  
  public function executeDownload(sfWebRequest $request)
  {
    # code...
  }
}
