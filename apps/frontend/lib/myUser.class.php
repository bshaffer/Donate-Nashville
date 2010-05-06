<?php

class myUser extends sfGuardSecurityUser
{
  protected $ownedIds = array();
  
  public function isOwner($object)
  {
    if ($this->isAuthenticated()) 
    {
      return $object['owner_id'] == $this->getUser()->getId();
    }
    
    return isset($this->ownedIds[get_class($object)]) 
            && in_array($object['id'], $this->ownedIds[get_class($object)]);
  }
  
  public function setOwner($object)
  {
    if (!isset($this->ownedIds[get_class($object)])) 
    {
      $this->ownedIds[get_class($object)] = array();
    }
    
    $this->ownedIds[get_class($object)][] = $object['id'];   
  }
}
