<?php

/**
* Class for convenience methods
*/
class csToolkit
{
  /**
   * implode for an associative array
   * 
   *
   * @param string $array     - associative array to explode
   * @param string $template  - string template in which to implode the array.  use %key% and %value%
   * @param string $sep       - used to implode templates, empty by default
   * @return void
   * @author Brent Shaffer
   */
 static function assoc_implode($array, $template, $sep = '')
 {
   $ret = array();
   foreach ($array as $key => $value) 
   {
     $ret[] = strtr($template, array('%key%' => $key, '%value%' => $value));
   }
   return implode($sep, $ret);
 }
}

