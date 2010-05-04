<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormTextarea represents a textarea HTML tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormTextarea.class.php 9046 2008-05-19 08:13:51Z FabianLange $
 */
class sfWidgetFormTextareaJQuery extends sfWidgetFormTextarea
{
  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->setAttribute('rows', 4);
    $this->setAttribute('cols', 60);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $id = $this->generateId($name);
    return parent::render($name, $value, array_merge($attributes, array('id' => $id)), $errors).$this->getInlineJavascript($id);
  }
  
  public function getInlineJavascript($id)
  {
    $javascript = <<<EOF
      <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
          $('#%s').wysiwyg();
        });
    </script>
EOF;
  
    return sprintf($javascript, $id);
  }
  
  public function getJavascripts()
  {
    return array('jquery/jquery.wysiwyg.js');
  }
  
  public function getStylesheets()
  {
    return array('jquery.wysiwyg.css' => 'all');
  }
}
