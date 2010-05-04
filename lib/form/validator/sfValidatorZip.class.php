<?php


/**
 * sfValidatorZip validates a zip code.
 *
 * @author     Brent Shaffer <bshafs@gmail.com>
 */
class sfValidatorZip extends sfValidatorRegex
{
  protected $_options = array('pattern' => "/^(^\d{5}([\-]\d{4})?$)*$/");
  protected $_messages = array('invalid' => 'Please Enter a Valid Zip Code');

  public function __construct($options = array(), $messages = array())
  {
    return parent::__construct(array_merge($this->_options, $options), array_merge($this->_messages, $messages));
  }
}
  