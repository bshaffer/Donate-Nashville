<?php

/**
 * Project filter form base class.
 *
 * @package    filters
 *
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup()
  {
    foreach ($this->getWidgetSchema()->getFields() as $key => $field) 
    {
      switch($key) 
      {
        case 'date':
        case 'created_at':
        case 'updated_at':
          $this->widgetSchema[$key] = new sfWidgetFormFilterDate(
            array('from_date' => new sfWidgetFormJQueryDate(), 
                  'to_date' => new sfWidgetFormJQueryDate(), 
                  'with_empty' => true,
                  'template' => '<div class="date-range">
                                  from <span class="date-from">%from_date%</span>
                                  to <span class="date-to">%to_date%</span>
                                 </div>'
                  ));
          break;
        case 'image':
        case 'photo':
        case 'slug':
          unset($this->widgetSchema[$key]);
          break;
      }
    }
  }
}