<?php

class sfWidgetFormSchemaFormatterRequired extends sfWidgetFormSchemaFormatterTable  
{  
 	protected  
 		$requiredTemplate= '<span class="requiredFormItem">*</span>',  
 		$validatorSchema = null;  
  
 /** 
  * Generates the label name for the given field name. 
  * 
  * @param  string $name  The field name 
  * @return string The label name 
  */  
 public function generateLabelName($name)  
 {  
  $label = parent::generateLabelName($name);  
  
  $fields = $this->validatorSchema->getFields();  
  if($fields[$name] != null) 
  {  
   $field = $fields[$name];  
   if($label && $field->hasOption('required') && $field->getOption('required')) {  
    $label .= $this->requiredTemplate;  
   }  
  }  
  return $label;  
 }  
  
 public function setValidatorSchema(sfValidatorSchema $validatorSchema)  
 {  
  $this->validatorSchema = $validatorSchema;  
 }
}  