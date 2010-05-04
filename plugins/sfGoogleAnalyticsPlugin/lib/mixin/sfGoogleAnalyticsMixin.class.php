<?php

/**
 * Mixins for sfGoogleAnalyticsPlugin.
 * 
 * @package     sfGoogleAnalyticsPlugin
 * @subpackage  listener
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfGoogleAnalyticsMixin.class.php 11928 2008-10-03 16:59:33Z Kris.Wallsmith $
 */
class sfGoogleAnalyticsMixin
{
  /**
   * Get the current request's tracker object.
   * 
   * @param   mixed $mixable
   * 
   * @return  sfGoogleAnalyticsTracker
   */
  public static function getTracker($mixable)
  {
    return sfContext::getInstance()->getRequest()->getAttribute('tracker', null, 'sf_google_analytics_plugin');
  }
  
  /**
   * Set the current request's tracker object.
   * 
   * @param   mixed $mixable
   * @param   sfGoogleAnalyticsTracker $tracker
   */
  public static function setTracker($mixable, sfGoogleAnalyticsTracker $tracker)
  {
    sfContext::getInstance()->getRequest()->setAttribute('tracker', $tracker, 'sf_google_analytics_plugin');
  }
  
}
