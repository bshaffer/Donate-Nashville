<?php
/*
 * This file is part of the isicsBreadcrumbsPlugin package.
 * Copyright (c) 2008 ISICS.fr <contact@isics.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class defaultComponents extends sfComponents
{  
  public function executeBreadcrumbs()
  {
    $breadcrumb = sfBreadcrumbs::getInstance();
    
    if (isset($this->root))
    {
      $breadcrumb->setRoot($this->root['text'], $this->root['uri']);
    }
    
    if (!isset($this->offset))
    {
      $this->offset = 0;
    }
    
    $this->items = $breadcrumb->getItems($this->offset);
  }  
  
  public function executeNavigation()
  {
    $this->section = $this->getRequest()->getParameter('section');
  }
  
  public function executeTwitter()
  {
    $json = json_decode(file_get_contents('http://twitter.com/statuses/user_timeline/140289211.json'), true);
    $this->tweet = csToolkit::parse_tweet($json[0]['text']);
    $this->time =  $json[0]['created_at'];
  }
}
