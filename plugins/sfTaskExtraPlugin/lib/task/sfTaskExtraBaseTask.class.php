<?php

/**
 * Plugin base task.
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfTaskExtraBaseTask.class.php 17285 2009-04-14 04:41:44Z Jonathan.Wage $
 */
abstract class sfTaskExtraBaseTask extends sfBaseTask
{
  /**
   * Checks if a plugin exists.
   * 
   * The plugin directory must exist and have at least one file or folder
   * inside for that plugin to exist.
   * 
   * @param   string  $plugin
   * @param   boolean $boolean Whether to throw exception if plugin exists (false) or doesn't (true)
   * 
   * @throws  sfException If the plugin does not exist
   */
  static public function checkPluginExists($plugin, $boolean = true)
  {
    try {
      sfApplicationConfiguration::getActive()->getPluginConfiguration($plugin);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Asks for a value and validates the response.
   * 
   * Available options:
   * 
   *  * value:      A value to try against the validator before asking the user
   *  * attempts:   Max number of times to ask before giving up (3 by default)
   *  * style:      Style for question output (QUESTION by default)
   * 
   * @param   string|array    $question
   * @param   sfValidatorBase $validator
   * @param   array           $options
   * 
   * @return  mixed
   */
  public function askAndValidate($question, sfValidatorBase $validator, array $options = array())
  {
    return self::doAskAndValidate($this, $question, $validator, $options);
  }

  /**
   * @see askAndValidate()
   */
  static public function doAskAndValidate(sfTask $task, $question, sfValidatorBase $validator, array $options = array())
  {
    if (!is_array($question))
    {
      $question = array($question);
    }

    $options = array_merge(array(
      'value'    => null,
      'attempts' => 3,
      'style'    => 'QUESTION',
    ), $options);

    while ($options['attempts']--)
    {
      $value = is_null($options['value']) ? $task->ask(isset($error) && 'required' != $error->getCode() ? array_merge(array($error->getMessage(), ''), $question) : $question, isset($error) ? 'ERROR' : $options['style']) : $options['value'];

      try
      {
        $value = $validator->clean($value);

        return $value;
      }
      catch (sfValidatorError $error)
      {
        $value = null;
      }
    }

    throw $error;
  }
}
