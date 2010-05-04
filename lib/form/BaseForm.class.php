<?php

/**
 * Base project form.
 * 
 * @package    skeleton
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
  public function setOccursInRangeFilter($fields = null)
  {
    $fields = $fields ? $fields : array('start_date', 'end_date');
    
    $this->setOption('occurs_in_range.filter_fields', $fields);
    
    $this->widgetSchema['occurs_in_range'] = new sfWidgetFormFilterDate(
      array('from_date' => new sfWidgetFormDateJQueryUI(array('date_format' => 'm/d/Y')), 
            'to_date' => new sfWidgetFormDateJQueryUI(array('date_format' => 'm/d/Y')),
            'with_empty' => false,
            ));
    
    $this->validatorSchema['occurs_in_range'] = new sfValidatorDateRange(
      array('required' => false, 
            'from_date' => new sfValidatorDate(
              array('required' => false)),
            'to_date' => new sfValidatorDate(
              array('required' => false))));
  }
  

  
  public function addOccursInRangeColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $query->andClause();

    foreach ($this->getOption('occurs_in_range.filter_fields') as $i => $f) 
    {
      $this->addOrDateQuery($query, $f, $value);
    }
    
    $query->endClause();
    
    return $query;
  }
  
  protected function addOrDateQuery(Doctrine_Query $query, $field, $values)
  {
    $fieldName = $this->getFieldName($field);

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
