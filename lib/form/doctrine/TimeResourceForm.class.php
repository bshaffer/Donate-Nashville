<?php

/**
 * TimeResource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TimeResourceForm extends BaseTimeResourceForm
{
  /**
   * @see ResourceForm
   */
  public function configure()
  {
    parent::configure();
    
    // unset state, people will only need help in TN
    unset(
      $this['state']
    );
  }

  /**
   * Set TN as the state, just so things are kosher
   */
  public function doUpdateObject($values)
  {
    $values['state'] = 'TN';
    
    parent::doUpdateObject($values);
  }
}
