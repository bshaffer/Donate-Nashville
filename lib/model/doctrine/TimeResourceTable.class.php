<?php


class TimeResourceTable extends ResourceTable
{
  public function getListQuery($start_date, $end_date = null)
  {
    $query = $this->createQuery('p')
              ->select('p.title, LEFT(p.description, 200) as summary');
    
    $this->addDateCondition($query, array('from' => $start_date, 'to' => $end_date));
    
    return $query;
  }
  
  public function addDateCondition(Doctrine_Query $query, $value)
  {
    $query->andClause();

    $this->addOrDateQuery($query, 'start_date', $value);
    $this->addOrDateQuery($query, 'end_date', $value);

    $query->endClause();
    
    return $query;
  }
  
  protected function addOrDateQuery(Doctrine_Query $query, $fieldName, $values)
  {
    if (isset($values['is_empty']) && $values['is_empty'])
    {
      $query->orWhere(sprintf('%s.%s IS NULL', $query->getRootAlias(), $fieldName));
    }
    else
    {
      if (null !== $values['from'] && null !== $values['to'])
      {
        $query->orWhere(sprintf('%s.%s >= ? AND %s.%s <= ?', $query->getRootAlias(), $fieldName, $query->getRootAlias(), $fieldName), array($values['from'], $values['to']));
      }
      else if (null !== $values['from'])
      {
        $query->orWhere(sprintf('%s.%s >= ?', $query->getRootAlias(), $fieldName), $values['from']);
      }
      else if (null !== $values['to'])
      {
        $query->orWhere(sprintf('%s.%s <= ?', $query->getRootAlias(), $fieldName), $values['to']);
      }
    }
  }
}