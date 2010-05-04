<?php
/**
 * sfWidgetFormJQueryDateTime class
 *
 * Combines jQueryDate widget with a regular time widget, for use of jQuery date 
 * when time is required.
 *
 * @package default
 * @author Brent Shaffer
 */
class sfWidgetFormJQueryDateTime extends sfWidgetFormDateTime
{
 
  /**
   * Returns the date widget.
   *
   * @param  array $attributes  An array of attributes
   *
   * @return sfWidgetForm A Widget representing the date
   */
  protected function getDateWidget($attributes = array())
  {
    return new sfWidgetFormJQueryDate($this->getOptionsFor('date'), $this->getAttributesFor('date', $attributes));
  }

  /**
   * Returns the time widget.
   *
   * @param  array $attributes  An array of attributes
   *
   * @return sfWidgetForm A Widget representing the time
   */
  protected function getTimeWidget($attributes = array())
  {
    return new sfWidgetFormTime($this->getOptionsFor('time'), $this->getAttributesFor('time', $attributes));
  }
}
