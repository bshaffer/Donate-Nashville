<?php

// 
//  Locatable.php
//  Locatable Extension
//  
//  Created by Brent Shaffer on 2008-12-22.
//  Copyright 2008 Centre{source}. All rights reserved.
// 

class Doctrine_Template_Listener_Locatable extends Doctrine_Record_Listener
{
  /**
   * Array of locatable options
   */  
  protected $_options = array();


  /**
   * Constructor for Locatable Template
   *
   * @param array $options 
   * @return void
   * @author Brent Shaffer
   */  
  public function __construct(array $options)
  {
    $this->_options = $options;
  }


  /**
   * Set the geocodes automatically when a new locatable object is created
   *
   * @param Doctrine_Event $event
   * @return void
   * @author Brent Shaffer
   */
  public function preInsert(Doctrine_Event $event)
  {
    $object = $event->getInvoker();
		$object->refreshGeocodes();
  }
  
  /**
   * Set the geocodes automatically when a locatable object's locatable fields are modified
   *
   * @param Doctrine_Event $event
   * @return void
   * @author Brent Shaffer
   */
  public function preSave(Doctrine_Event $event)
  {
    $object = $event->getInvoker();
    $modified = array_keys($object->getModified());
    if (array_intersect($this->_options['fields'], $modified)) $object->refreshGeocodes();
  }
}
