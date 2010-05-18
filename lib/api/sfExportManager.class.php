<?php

/**
* 
*/
class sfExportManager
{
  protected $_xls,
            $_sheets = 0;
  
  public function __construct($class = null, $title = null, $multisheet = false)
  {
    if ($class && !class_exists($class)) 
    {
      throw new sfException("Invalid class: $class.  Class does not exist");
    }
    
    if (is_null($title))
    {
      $title = $this->getExportTitle();
    }
    
    $this->_xls = new sfPhpExcel();
    $this->_xls->getProperties()->setTitle($title);
    $this->_xls->getProperties()->setSubject($title);
    $this->_xls->getProperties()->setDescription($title);
  }
  
  public static function create($class, $title = null, $multisheet = false)
  {
    $managerClass = sprintf('sfExportManager%s', sfInflector::camelize($class));
    if (class_exists($managerClass)) 
    {
      return new $managerClass($class, $title, $multisheet);
    }
    
    return new self($class, $title, $multisheet);
  }

  public function initialize($params = array())
  {
  }

  public function getExportTitle()
  {
    return 'Data Export';
  }
   
  public function filterColumns($fields, $ids = array())
  {
    return $fields;
  }
  
  public function exportField($object, $field)
  {
    return $this->exportObjectRowFieldDefault($object, $field);
  }
  
  public function exportObjectRowFieldDefault($object, $field)
  {
    return $object[$field];
  }

  /**
   * exportCollectionSheet
   *
   * default sheet export for collection
   *
   * @param string $object 
   * @param string $fields 
   * @return void
   * @author Brent Shaffer
   */
  public function exportCollectionSheet($collection, $fields, $title = null)
  {
    if($this->_sheets > 0)
    {
      $workSheet = $this->_xls->createSheet();
    }
    else
    {
      $workSheet = $this->_xls->getActiveSheet();
    }

    $this->_sheets++;

    $workSheet->setTitle($title ? $title : $this->getExportTitle());

    // Initialize coordinate counters
    $row = 1;
    $col = 0;

    foreach ($fields as $field => $label)
    {
      $workSheet->setCellValueByColumnAndRow($col, $row, $label);
      $workSheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($col))->setAutoSize(true);
      $col++;
    }
    $row++;

    foreach ($collection as $record) 
    {
      $col = 0;
      foreach ($fields as $field => $label)
      {
        $workSheet->setCellValueByColumnAndRow($col, $row, $this->exportField($record, $field));
        $col++;
      }
      $row++;
    }
  }
  
  public function output($filename = 'export', $format = null)
  {
    if(is_null($format)) sfConfig::get('sf_environment') == 'test' ? $format = 'HTML' : $format = 'Excel5';

    switch(strtolower($format))
    {
      case 'excel2007':
        $content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $ext = 'xlsx';
        break;
      case 'csv':
        $content_type = 'application/vnd.ms-excel';
        $ext = 'csv';
        break;
      case 'html':
        $content_type = 'text/html';
        $ext = 'html';
        break;
      case 'pdf':
        $content_type = 'application/pdf';
        $ext = 'pdf';
        break;
      default:
        $content_type = 'application/vnd.ms-excel';
        $ext = 'xls';
    }

    // redirect output to client browser
    if($format != 'HTML')
    {
      header('Content-Type: ' . $content_type);
      header('Content-Disposition: attachment;filename="' . $filename . "." . $ext . '"');
      header('Cache-Control: max-age=0');
    }
    
    $xlsWriter = PHPExcel_IOFactory::createWriter($this->_xls, $format);
    $xlsWriter->save('php://output'); 
  }
}
