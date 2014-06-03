<?php
class test 
{
	protected $_array;

	public function getArray()
    {
        return $this;
    }
    
    public function setArray($res)
    {
        $this->_array = (array) $res;
        return $this;
    }	

	public function decode()
    {
        return json_decode($this->_array, true);
    }
    
    public function encode()
    {
        $this->_array = json_encode($this->_array, true);
    }
}

$i = new test();
// eintragen
$i->setArray(array('hallo', 'welt'))->encode();
print_r($i->getArray(array('hallo', 'welt'))->decode());
print_r($i);









$entries = 346;
$viewEntries = 20;

$maxPages = ceil($entries/$viewEntries);

$pages = array();

$start = 1;
$ends = $viewEntries;

for( $i=1; $i<$maxPages+1; $i++) {
	$pages[$i] = array($start, $ends);
	$start += $viewEntries;
	$ends += $viewEntries;
}

?><pre><?php
print_r($pages);
?></pre><?php
?>

DU LAPPEN
