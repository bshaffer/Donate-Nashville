<?php

/**
 * Static configuration class for common static function calls
 * 
 * @package     dn
 * @subpackage  config
 * @author      Ryan Weaver <ryan.weaver@iostudio.com>
 */

class dnConfig
{

  /**
   * Helper to retrieve email subjects from app.yml config
   * 
   * @param string $name The name/key of the email to retrieve
   */
  public static function getEmailSubject($name)
  {
    $subjects = sfConfig::get('app_email_subjects', array());
    
    if (!isset($subjects[$name]))
    {
      throw new sfException(sprintf('Cannot find subject for email "%s"', $name));
    }
    
    return $subjects[$name];
  }
}
