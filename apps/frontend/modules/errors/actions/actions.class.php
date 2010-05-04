<?php

/**
 * errors actions.
 *
 * @package    vaco
 * @subpackage errors
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class errorsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeError404(sfWebRequest $request)
  {
		// for pulling search keywords from URL
		// $this->search = implode(' ', preg_split ("/\/|-/", $request->getPathInfo())); //Splits on dashes and forward slashes
		// $query = Doctrine::getTable('Node')->getLuceneSearchQuery(array('keywords' => $this->search));
		
    $this->getResponse()->setStatusCode(404, 'This page does not exist');
  }
}
