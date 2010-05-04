<?php

class Doctrine_Template_Locatable extends Doctrine_Template
{    
  /**
   * Array of locatable options
   */  
  protected $_url = 'http://maps.google.com/maps/geo',
            $_options = array('columns'     => array(
                                'latitude'    =>  array(
                                    'name'    => 'latitude',
                                    'type'    => 'double',
                                    'length'  =>  16,
                                    'alias'   =>  null,
                                    'options' =>  array('length' => 16, 'scale' => 10)),
                                'longitude'   =>  array(
                                    'name'    => 'longitude',
                                    'type'    => 'double',
                                    'length'  =>  16,
                                    'alias'   =>  null,
                                    'options' =>  array('length' => 16, 'scale' => 10)),
                            ), 'fields'       => array(),
                               'distance_unit' => 'miles',
   );

  
  /**
   * Constructor for Locatable Template
   *
   * @param array $options 
   * @return void
   * @author Brent Shaffer
   */
  public function __construct(array $options = array())
  {
    $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
  }


  public function setup()
  {

  }


  /**
   * Set table definition for locatable behavior
   *
   * @return void
   * @author Brent Shaffer
   */
  public function setTableDefinition()
  {
    foreach ($this->_options['columns'] as $key => $options) {
      $name = $options['name'];

      if ($options['alias'])
      {
        $name .= ' as ' . $options['alias'];
      }
      
      $this->hasColumn($name, $options['type'], $options['length'], $options['options']);
    }
    
    $this->addListener(new Doctrine_Template_Listener_Locatable($this->_options));
  }

  // =======================
  // = Geocoding Functions =
  // =======================
  public function buildGeoQuery()
  {
    $obj = $this->getInvoker();
    $query = array();
    foreach ($this->_options['fields'] as $field) 
    {
      $query[] = $obj->$field;
    }
   return implode(', ', array_filter($query));
  }

  public function buildUrlFromQuery($query)
  {
   return $this->_url.'?q='.urlencode($query).'&output=csv';
  }
  
  public function retrieveGeocodesFromUrl($url)
  {
    $codes = explode(',', file_get_contents($url));
    $geocodes = array('latitude' => null, 'longitude' => null);

    if (count($codes) >= 4) 
    {
      $geocodes['latitude'] = $codes[2];
      $geocodes['longitude'] = $codes[3];
    }
    
    return $geocodes;
  }
  
  public function refreshGeocodes($url = null)
  {
    $obj = $this->getInvoker();
    if (!$url) 
    {
      $url = $this->buildUrlFromQuery($this->buildGeoQuery());
    }
    
    $geocodes = $this->retrieveGeocodesFromUrl($url);
    $obj[$this->_options['columns']['latitude']['name']] = $geocodes['latitude'];
    $obj[$this->_options['columns']['longitude']['name']] = $geocodes['longitude'];
  }
}
