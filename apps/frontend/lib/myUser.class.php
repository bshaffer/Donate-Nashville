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
  protected $ownedIds = array();

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
    
    return isset($this->ownedIds[get_class($resource)]) 
            && in_array($resource['id'], $this->ownedIds[get_class($resource)]);
  }

  /**
   * Sets the current user object as an owner of the current resource
   * 
   * @param Resource $resource
   */
  public function setOwner(Resource $resource)
  {
    if (!isset($this->ownedIds[get_class($resource)])) 
    {
      $this->ownedIds[get_class($resource)] = array();
    }
    
    $this->ownedIds[get_class($resource)][] = $resource['id'];   
  }
}
