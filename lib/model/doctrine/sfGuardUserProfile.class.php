<?php

/**
 * sfGuardUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    skeleton
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUserProfile extends BasesfGuardUserProfile
{
  public function getAddressArray()
  {
    $csz = array($this['city'], $this['state'], $this['zip']);
    $address = array($this['address_1'], $this['address_2'], implode(', ', array_filter($csz)));
    
    return array_filter($address);
  }
  
  public function getAddress($sep = '<br />')
  {
    return implode($sep, $this['address_array']);
  }
}
