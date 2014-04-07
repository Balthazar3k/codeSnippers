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
 	
    public function getTemplate($tpl)
    {
      	$tpl = '\\Calendar\\Plugins\\Templates\\'.ucfirst($tpl);
      	$obj = new $tpl();
      	return $obj;
    }
    
 }
 
 class Eventplaner {
 	
 	protected $_key = 'Eventplaner';
 	
    public function __construct()
    {
    	
    }
 }
?>
