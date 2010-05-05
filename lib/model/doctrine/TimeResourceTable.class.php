<?php


class TimeResourceTable extends ResourceTable
{
  public function getListQuery($start_date, $end_date = null)
  {
    $query = $this->createQuery('p')
              ->select('p.title, LEFT(p.description, 200) as summary');
    
    $start_time = date('H:i:s', strtotime($start_date));
    $start_date = date('Y-m-d', strtotime($start_date));

    if ($end_date) 
    {
      $end_time = date('H:i:s', strtotime($end_date));
      $end_date = date('Y-m-d', strtotime($end_date));
    }
    else
    {
      $end_time = null;
    }
    
    $this->addDateQuery($query, 'resource_date', array('from' => $start_date, 'to' => $end_date));
    
    $query->andClause();
    
      $this->addOrDateQuery($query, 'start_time', array('from' => $start_time, 'to' => $end_time));

      $this->addDateQuery($query, 'end_time', array('from' => $start_time, 'to' => $end_time));

      $this->addOrDateQuery($query, 'end_time', array('is_empty' => true)); // When end time isn't set
    
    $query->endClause();
    
    return $query;
  }
  
  protected function addDateQuery(Doctrine_Query $query, $fieldName, $values)
  {
    if (isset($values['is_empty']) && $values['is_empty'])
    {
      $query->andWhere(sprintf('%s.%s IS NULL', $query->getRootAlias(), $fieldName));
    }
    else
    {
      if (null !== $values['from'] && null !== $values['to'])
      {
        $query->andWhere(sprintf('%s.%s >= ? AND %s.%s <= ?', $query->getRootAlias(), $fieldName, $query->getRootAlias(), $fieldName), array($values['from'], $values['to']));
      }
      else if (null !== $values['from'])
      {
        $query->andWhere(sprintf('%s.%s >= ?', $query->getRootAlias(), $fieldName), $values['from']);
      }
      else if (null !== $values['to'])
      {
        $query->andWhere(sprintf('%s.%s <= ?', $query->getRootAlias(), $fieldName), $values['to']);
      }
    }
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