<?php

/**
* 
*/
class csFactory
{
  const DEFAULT_PASSWORD = 'password';
  protected static $lastRandom = array();
  
  /**
   * generates a unique string and saves it in memory
   *
   * @param string $prefix - optional string to add to the beginning of the random string
   * @param string $length - length of appended random string
   * @return unique string
   * @author Brent Shaffer
   */
  public static function generate($prefix = '', $suffix = '', $length=6)
  {
    if ($prefix) 
    {
      self::$lastRandom[$prefix] = $prefix.self::random($length).$suffix;
      return self::$lastRandom[$prefix];
    }
    self::$lastRandom[] = $prefix.self::random($length).$suffix;
    return end(self::$lastRandom);
  }
    
  /**
   * returns the most recent unique string returned by generate() function
   *
   * @return unique string
   * @author Brent Shaffer
   */
  public static function last($prefix = null)
  {
    if ($prefix) 
    {
      if (!isset(self::$lastRandom[$prefix])) 
      {
        throw new sfException('No previously generated random available for "'.$prefix.'"');
      }
      return self::$lastRandom[$prefix];
    }
    
    if (!self::$lastRandom) 
    {
      throw new sfException('No previously generated random available');
    }
    return end(self::$lastRandom);
  }
    
  public static function create($model, $options = array())
  {
    $object = new $model;
    $object->fromArray($options);
    return $object;
  }

  /**
   * generate a random string of characters and numbers
   *
   * @param string $len 
   * @return void
   * @author Brent Shaffer
   */
  static public function random($len = 16)
  {
    $base = 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
    $max  = strlen($base) - 1;
    $rand = '';

    mt_srand((double) microtime() * 1000000);

    while (strlen($rand) < $len)
    {
      $rand .= $base{mt_rand(0, $max)};
    }

    return $rand;
  }

  /**
   * select a random value from an array
   *
   * @param string $array 
   * @return void
   * @author Brent Shaffer
   */
  public static function selectRandom($array)
  {
    $array = array_values($array);
    return $array[rand(0, count($array)-1)];
  }
  
  /**
   * filters an array at random, returns an array of filtered values
   *
   * @param string $possibleValues 
   * @return void
   * @author Brent Shaffer
   */
  public static function generateRandomArray($possibleValues)
  {
    $rand = array();
    foreach ($possibleValues as $key => $value) 
    {
      if(rand(0, 1)) {
        $rand[$key] = $value;
      }
    }
    return $rand;
  }
  
  /**
   * returns the random id for an object in table $table
   *
   * @param string $table 
   * @return void
   * @author Brent Shaffer
   */
  public static function selectRandomId($table, $where = array(), $notIn = array())
  {
    return self::selectRandomObject($table, $where, $notIn)->getId();
  }
  
  /**
   * returns a random object from table $table
   *
   * @param string $table 
   * @param string $where 
   * @param string $notIn 
   * @return void
   * @author Brent Shaffer
   */
  public static function selectRandomObject($table, $where = array(), $notIn = array())
  {
    $q = Doctrine::getTable($table)->createQuery()->orderBy('RAND()');

    if ($notIn)
    {
      $q->whereNotIn('id', (array) $notIn);
    }
    
    foreach ($where as $field => $value) 
    {
      $q->andWhere($q->getRootAlias().".$field = ?", $value);
    }

    return $q->fetchOne();
  }
}
