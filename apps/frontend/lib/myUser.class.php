<?php

/**
 * User class for frontend
 * 
 * @package     dn
 * @subpackage  user
 * @author      Brent Shaffer <bshafs@gmail.com>
 * @author      Ryan Weaver <ryan@thatsquality.com>
 */
class myUser extends sfGuardSecurityUser
{
  /**
   * Returns boolean of whether or not the current user owns the given resource
   * 
   * @param Resource $resource
   * @return boolean
   */
  public function isOwner($resource)
  {
    if ($this->isAuthenticated()) 
    {
      return $resource['owner_id'] == $this->getGuardUser()->getId();
    }
    
    $ownedIds = $this->getAttribute('ownedIds', array());
    return isset($ownedIds[get_class($resource)]) 
            && in_array($resource['id'], $ownedIds[get_class($resource)]);
  }

  /**
   * Sets the current user object as an owner of the current resource
   * 
   * @param Resource $resource
   */
  public function setOwner(Resource $resource)
  {
    $ownedIds = $this->getAttribute('ownedIds', array());

    if (!isset($ownedIds[get_class($resource)])) 
    {
      $ownedIds[get_class($resource)] = array();
    }
    
    $ownedIds[get_class($resource)][] = $resource['id'];   
    
    $this->setAttribute('ownedIds', $ownedIds);
  }
}
