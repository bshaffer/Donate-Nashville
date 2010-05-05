<?php

class myUser extends sfGuardSecurityUser
{
  public function getGuardUserByEmail($email)
  {
    if(!$this->isAuthenticated())
    {
      $guard_user = Doctrine_Query::create()
        ->from('sfGuardUser')
        ->where('email_address = ?', $email)
        ->fetchOne();
      
      if(!$guard_user)
      {
        $guard_user = new sfGuardUser();
        $guard_user->username = $email;
        $guard_user->save();
      }
      
      $this->signIn($guard_user);
    }
    
    return $this->getGuardUser();
  }
}
