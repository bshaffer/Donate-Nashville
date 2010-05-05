<?php

/**
* resource component
*/
class resourceComponents extends sfComponents
{
  function executeTime_filter_form(sfWebRequest $request)
  {
    $this->form = new TimeFilterForm();
  }
  
  function executeStuff_filter_form(sfWebRequest $request)
  {

  }
}
