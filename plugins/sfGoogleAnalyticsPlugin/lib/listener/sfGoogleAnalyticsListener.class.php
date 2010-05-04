<?php

/**
 * Event listener for sfGoogleAnalyticsPlugin.
 * 
 * @package     sfGoogleAnalyticsPlugin
 * @subpackage  listener
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfGoogleAnalyticsListener.class.php 11928 2008-10-03 16:59:33Z Kris.Wallsmith $
 */
class sfGoogleAnalyticsListener
{
  /**
   * Get the current tracker object.
   * 
   * @param   sfEvent $event
   * 
   * @return  bool
   */
  public static function observe(sfEvent $event)
  {
    $subject = $event->getSubject();
    
    switch ($event['method'])
    {
      case 'getTracker':
      $event->setReturnValue(sfGoogleAnalyticsMixin::getTracker($subject));
      return true;
      
      case 'setTracker':
      sfGoogleAnalyticsMixin::setTracker($subject, $event['arguments'][0]);
      return true;
    }
  }
  
}
