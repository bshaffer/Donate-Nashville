<?php


/**
 * sfValidatorPhone validates a phone number. 
 *
 * @author     Brent Shaffer <bshafs@gmail.com>
 */
class sfValidatorPhone extends sfValidatorRegex
{
  protected $_options = array('pattern' => "/^(^(1\s*[-\/\.]?)?(\((\d{3})\)|(\d{3}))\s*[-\/\.]?\s*(\d{3})\s*[-\/\.]?\s*(\d{4})\s*(([xX]|[eE][xX][tT])\.?\s*(\d+))*$)*$/");
  protected $_messages = array('invalid' => 'Please Enter a Valid Phone Number (xxx-xxx-xxxx)');
  
  public function __construct($options = array(), $messages = array())
  {
    return parent::__construct(array_merge($this->_options, $options), array_merge($this->_messages, $messages));
  }
}
