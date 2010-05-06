<?php

class sfBreadcrumbItem
{
  protected $text;
  protected $uri;
    
  /**
   * Constructor
   *
   */    
  public function __construct($text, $uri = null)
  {
    $this->text = $text;
    $this->uri  = $uri;
  }
  
  /**
   * Retrieve the uri of the item
   *
   */  
  public function getUri()
  {
    return $this->uri;
  }
  
  /**
   * Retrieve the text of the item
   *
   */  
  public function getText()
  {
    return $this->text;
  }
}