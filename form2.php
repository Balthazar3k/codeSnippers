<pre><?php
/**
 * @copyright Balthazar3k 2014
 * @package Eventplaner 2.0
 */

class form{

	protected $_label = true;

	protected $_fields = array();


	protected $_html = array(
		'label' 	=> '<label for="%s">%s:</label>',
		'input' 	=> "<input %s value="%s" />",
		'select' 	=> "<select %s>%s</select>",
		'textarea' 	=> "<textarea %s>%s</textarea>",
		'option' 	=> "<option %s>%s</option>"
	);

	protected $_search = array('value', 'text');

	public function lableSwitch()
	{
		if( $this->_label ){
			$this->_label = false;
		} else {
			$this->_label = true;
		}

		return $this;
	}

	public function element($type, $array)
	{
		foreach( $array as $attr => $val ){
			if( $key = array_search($attr, $this->_search ) ){
				$any = $array[$this->_search[$key]];
				unset($array[$this->_search[$key]]);
			} else {
				$any = NULL;
			}
		}

		$this->_fields[] = array(
			$type => $array,
			'value' => $any
		);

		return ($this);
	}

	/*

	Array
	(
	    [0] => Array
	        (
	            [input] => Array
	                (
	                    [type] => text
	                    [name] => banane
	                )

	            [value] => hallo mein Name ist Hase
	        )

	)

	*/


	public function get()
	{
		$fields = array();
		$secondValue = '';

		foreach( $this->_fields as $i => $type ){
			if( $this->_label ){
				$fields[] = sprintf($this->_html['label'], $this->_fields[$i][$type]['name'], ucfirst($array['name']) );
			}

			foreach( $type as $key => $val ){
				if( in_array( $type, array('text'))){
					$secondValue = $array[$type];
					unset($array[$type]);
				}

				$fields[] = sprintf($this->_html[$type], $this->array2attributes($val), $secondValue);
			}
		}

		print_r ($this->_fields);
		return implode("\n", $fields);
	}

	public function set()
	{
		echo $this->get();
	}

	/**
     * change the array to a HTML Atributes string
     * 
     * @param array $attributes
     * @return string
     */
    
    private function array2attributes($attributes)
    {
        if( is_array($attributes) && count($attributes) > 0 ){
            $attr = array();
            foreach( $attributes as $key => $value){
                $attr[] = $key . '="'.$value.'"';
            }
            return implode(' ', $attr);
        }
    }

}

$form = new form();

$form
	->element('input', array(
		'type' => 'text',
		'name' => 'banane', 
		'text' => 'hallo mein Name ist Hase'
	));

	$form->set();




?></pre>