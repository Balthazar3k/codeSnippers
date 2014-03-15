<pre><?php
/**
 * @copyright Balthazar3k 2014
 * @package Eventplaner 2.0
 */

class form{

	protected $_label;

	protected $_fields = array();


	protected $_html = array(
		'label' 	=> '<label for="{name}">{label}:</label>',
		'input' 	=> "<input{type}{id}{name}{value}{class}{style} />",
		'select' 	=> "<select{type}{id}{name}{class}{style}>{html}{text}{options}</select>",
		'textarea' 	=> "<textarea{type}{id}{name}{class}{style}>{html}{text}</textarea>",
		'options' 	=> "<option{id}{value}{class}{style}>{option}</option>\n"
	);

	protected $_noAttribute = array(
		"options",
		"option",
		"html",
		"text"
	);

	protected $_isArray = array(
		"options" => "options"
	);


	/*$this->element('input', array(
			'id' => 'name',
			'name' => 'name',
			'value' => 'YourName'
	))*/
	
	public function label($label){
		$this->_label = $label;
		return ($this);
	}

	public function element($element, array $ar){
		$ar = $this->checkAttributes($ar);
		$this->_fields[] = array($element => $ar);
		$this->compile();
		return ($this);
	}
	
	protected function compile(){
		$string = '';
		foreach( $this->_fields as $key1 => $ar1 ){
			foreach( $ar1 as $key2 => $val1 ){
				$string  = $this->parseString($this->_html['label'], array('name' => $val1['name'], 'label' => $this->_label ) );
				$string .= $this->parseString($this->_html[$key2], $this->attributes($val1) );
			}

		}
		

		echo $string;
	}

	protected function attributes(array $array){
		$attributesArray = array(); 

		//print_r( $array );

		foreach($array as $attr => $val ){
			
			if( !in_array($attr, $this->_noAttribute) ){
				$attributesArray[$attr] = " ".$attr . '="' . $val . '"';
			}
		}

		return $attributesArray;
	}

	public function parseString($template, array $array){
		preg_match_all("/\{([A-Za-z0-9\-\_]*)\}/Us", $template, $res);

		$replace = $to = array();

		foreach( $res[1] as $i => $pattern ){
			if( isset($array[$pattern]) ){

				$replace[] = $res[0][$i];
				$to[] = $array[$pattern]; 

			}else{

				$replace[] = $res[0][$i];
				$to[] = NULL; 

			}
		}

		return str_replace($replace, $to, $template);
	}

	

	protected function checkAttributes(array $array){
		if( !empty($this->_label) and ( !isset($array['id']) or !isset($array['name']) ) ){
			$array['name'] = strtolower($this->_label);
			$array['id'] = strtolower($this->_label);
		}

		if( !isset($array['id']) and isset($array['name']) ){
			$array['id'] = $array['name'];
		}

		if( !isset($array['name']) and isset($array['id']) ){
			$array['name'] = $array['id'];
		}

		if( !isset($array['id']) or !isset($array['name']) ){
			exit('Formular Element brauch eine id oder Name');
		}

		return $array;
	}

}

$form = new form();
/*
$form->label('Name')->element('input', array(
	'type' => 'text',
	'id' => 'name',
	'name' => 'name',
	'value' => 'Hase'
)); 

$form->label('Passwort')->element('input', array(
	'type' => 'password',
	'value' => '********'
)); */

$form->label('Passwort')->element('select', 
	array(
		'options' => array(
			array('option' => 'Angelo', "value" => "1"),
			array('option' => 'Marco', "value" => "2"),
			array('option' => 'Lucas', "value" => "3")
		)
	)
);


?>