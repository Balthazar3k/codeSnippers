<?php
/**
 * Copyright: Angelo B3k 2014
 * Experiment
 */
 
 class Calendar {
 
    protected $html;
 	
    protected $calendarArray = array();
    
    protected $_date;
    protected $_timestamp;
    protected $_day;
    protected $_month;
    protected $_year;
	  
    protected $_start;
    protected $_ends;
 
    private function getHtml($engine)
    {
      $engine = '\\Calendar\\Plugins\\Engines\\'.ucfirst($engine);
      $this = new $engine();
    }
 }
 
 class Eventplaner {
    public function getEventplaner()
    {
    }
 }
?>
