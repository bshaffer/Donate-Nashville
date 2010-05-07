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
 
  static function truncate($text, $length = 30, $truncate_string = '...', $truncate_lastspace = false)
  {
    if ($text == '')
    {
      return '';
    }

    $mbstring = extension_loaded('mbstring');

    if ($mbstring)
    {
      @mb_internal_encoding(mb_detect_encoding($text));
    }

    $strlen = ($mbstring) ? 'mb_strlen' : 'strlen';
    $substr = ($mbstring) ? 'mb_substr' : 'substr';

    if ($strlen($text) > $length)
    {
      $truncate_text = $substr($text, 0, $length - $strlen($truncate_string));

      if ($truncate_lastspace)
      {
        $truncate_text = preg_replace('/\s+?(\S+)?$/', '', $truncate_text);
      }

      return $truncate_text.$truncate_string;
    }
    else
    {
      return $text;
    }
  }
  
  public static function debug($object, $level = 0, $prefix = '')
  {
    $prefix = $prefix === true ? "\ndebug:\t" : $prefix;
    
    if ($object instanceof Doctrine_Record) 
    {
      $array = $level === null ? $object->toArray() : self::arrayForLevel($object->toArray(), $level);

      return str_replace("\n", $prefix, print_r($array, true));
    }
    
    if ($object instanceof Doctrine_Collection) 
    {
      if ($level === 0) 
      {
        $level = 1; // default for this is 1.  Nothing is useful with a level of zero
      }
      $array = $level === null ? $object->toArray() : self::arrayForLevel($object->toArray(), $level);

      return str_replace("\n", $prefix, print_r($array, true));
    }
    
    if (is_array($object)) 
    {
      $array = $level === null ? $object : self::arrayForLevel($object, $level);
      
      return str_replace("\n", $prefix, print_r($array, true));
    }
    
    return $object;
  }
}

