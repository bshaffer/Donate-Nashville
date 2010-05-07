<?php

function outputFormField(sfFormField $field, $subtext = null, $attrib = array()) {
  $errClass = array('class' => 'input-error');
  
  $curErr = $field->hasError() ? $errClass : array();
  
  $attributes = array_merge($attrib, $curErr);
  
  if ($field->getWidget() instanceof sfWidgetFormInputCheckbox) 
  {
    $attributes['class'] = isset($attributes['class']) ? $attributes['class'].' checkbox':'checkbox';
  }
  
  $output = $field->render($attributes);
  $output .= $field->hasError() ? '<span class="error-msg">'.$field->getError().'</span>' : '';  
  
  $help_text = $subtext ? $subtext : $field->renderHelp();
  $output .= $help_text ? '<span class="input_label">'.$help_text.'</span>' : '';
  
  return $output; 
}