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
class csWidgetFormDateTime extends sfWidgetFormDateTime
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('date_widget');
    $this->addOption('time_widget');
    $this->addOption('separate_names');
    parent::configure($options, $attributes);
  }
  
  /**
   * Returns the date widget.
   *
   * @param  array $attributes  An array of attributes
   *
   * @return sfWidgetForm A Widget representing the date
   */
  protected function getDateWidget($attributes = array())
  {
    return $this->getOption('date_widget') ? $this->getOption('date_widget') : 
      new sfWidgetFormJQueryDate($this->getOptionsFor('date'), $this->getAttributesFor('date', $attributes));
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
    return $this->getOption('time_widget') ? $this->getOption('time_widget') : 
      new sfWidgetFormTime($this->getOptionsFor('time'), $this->getAttributesFor('time', $attributes));
  }
  
  function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $date = $this->getDateWidget($attributes)->render($this->getDateName($name), $value);

    if (!$this->getOption('with_time'))
    {
      return $date;
    }

    return strtr($this->getOption('format'), array(
      '%date%' => $date,
      '%time%' => $this->getTimeWidget($attributes)->render($this->getTimeName($name), $value),
    ));
  }
  
  public function getTimeName($name)
  {
    return $this->getOption('separate_names') ? $name.'[time]' : $name;
  }
  
  public function getDateName($name)
  {
    return $this->getOption('separate_names') ? $name.'[date]' : $name;
  }
}
