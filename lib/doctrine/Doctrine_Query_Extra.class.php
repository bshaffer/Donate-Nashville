<?php
/*
 * Extended Doctrine Query class providing a few additional functions
 * for wrapping your where clauses more efficiently
 */
class Doctrine_Query_Extra extends Doctrine_Query
{
  protected $_startClause = false;
  
  public function clause()
  {
    $this->_params['where'] = array();
    
    $this->_addDqlQueryPart('where', '(');

    $this->_startClause = true;
    
    return $this;
  }
  
  /**
   * This function begins an AND clause wrapped in parenthesis
   * Requires a call to endClause()
   *
   * @return $this
   */
  public function andClause()
  { 
    if ($this->_hasDqlQueryPart('where')) {
        $this->_addDqlQueryPart('where', 'AND', true);
    }

    $this->_addDqlQueryPart('where', '(', true);

    $this->_startClause = true;

    return $this;
  }

  /**
   * This function begins an OR clause wrapped in parenthesis.
   * Requires a call to endClause()
   *
   * @return $this
   */
  public function orClause()
  {
    if ($this->_hasDqlQueryPart('where')) {
        $this->_addDqlQueryPart('where', 'OR', true);
    }

    $this->_addDqlQueryPart('where', '(', true);

    $this->_startClause = true;

    return $this;
  }

  /**
   * This function ends a clause
   *
   * @return $this
   */
  public function endClause()
  {
    if ($this->_startClause) 
    {
      $this->_startClause = false;
      
      // Remove last two elements (open parenthesis and the "AND or OR" before it)
      array_pop($this->_dqlParts['where']);
      array_pop($this->_dqlParts['where']);
    }
    else
    {
      $this->_addDqlQueryPart('where', ')', true);
    }

    return $this;
  }
  
  public function end()
  {
    return $this->endClause();
  }
  
  protected function _addDqlQueryPart($queryPartName, $queryPart, $append = false)
  {
    if ($queryPartName == 'where' && $this->_startClause && ($queryPart == 'AND' || $queryPart == 'OR')) 
    {
      $this->_startClause = false;
      return $this;
    }
    
    return parent::_addDqlQueryPart($queryPartName, $queryPart, $append);
  }
  
  /**
   * This function will wrap the current dql where statement in a clause
   *
   * @return $this
   */
  public function whereWrap()
  {
    $where = $this->_dqlParts['where'];

    if (count($where) > 0)
    {
      array_unshift($where, '(');
      array_push($where, ')');

      $this->_dqlParts['where'] = $where;
    }

    return $this;
  }
  
  public function debug()
  {
    $sql = $this->getSqlQuery();
    
    $params = $this->getParams();
    
    foreach ($params as $key => $type) 
    {
      foreach ($type as $param) 
      {
        $sql = preg_replace('/\?/', is_int($param) ? $param : "'$param'", $sql, 1);
      }
    }

    return $sql;
  }
  
  public function setBaseTable($tableName)
  {
    if(count($this->_dqlParts['from']))
    {
      $this->_dqlParts['from'][0] = $tableName . ' ' . $this->getRootAlias();
    }
    else
    {
      $this->from($tableName. ' ' . $this->getRootAlias());
    }
    
    return $this;
  }
}
