<pre>
<?php
/*	Copyright: Balthazar3k
 *	Adressen String Builder
 *	2014 Wiesbaden
*/

$streets = file_get_contents('streetsWiesbaden');

$streets = explode("\n", $streets);
array_walk($streets, function(&$item){
	$item = trim($item);	
});

$file = new fileSaver;
$file->path('cache/streets.json')->set($streets);



$file->path('cache/test/streets.json')->push(array(
	"Sonnenberger Straße."
));

class fileSaver {
	
	protected $_filepath;
	protected $_filecontent;
	protected $_errors = array();
	
	public function path($filepath){
		$this->_filepath = $filepath;
		$this->setDir();
		return ($this);
	}
	
	public function get(){
		if( file_exists( $this->_filepath ) ){
			if( $this->_filecontent = file_get_contents( $this->_filepath ) ) {
				$res = json_decode( $this->_filecontent, true);
				
				// überprüfen ob datei inhalt ein array ist
				if( is_array( $res ) ){
					$this->_filecontent = $res;
				}
				
				return $this->_filecontent;
			}else{
				$this->_errors[] = "Datei kann nicht gelesen werden.";
				return ($this);
			}
		}else{
			$this->_errors[] = "Datei konnte nicht gefunden werden.";
			return ($this);
		}
	}
	
	public function set( $content ){
		if( !is_array( $content ) ){
			$this->_filecontent = $content;
		}else{
			array_walk_recursive( $content, function( &$item, $key ){
				$item = htmlentities( $item );
			});
			
			$this->_filecontent = json_encode( $content, true);
		}
	
		if( file_put_contents( $this->_filepath, $this->_filecontent ) ){
			return($this);
		}else{
			$this->_errors[] = "Datei konnte nicht erstellt werden!";
			return($this);
		}
	}
	
	public function push( $new_content ){
		if( !empty( $new_content ) ){
			$old_content = $this->get_json( $this->path( $this->_filepath )->get() );
			
			array_walk_recursive( $old_content, function( &$item, $key ){
				$item = html_entity_decode( $item );
			});
			
			if( is_array( $old_content ) ){
				$content = array_merge( $old_content, $new_content );
			}else{
				$content = $old_content . $new_content;
			}
			
			$this->_filecontent = $content;
			$this->path($this->_filepath)->set( $content );
		}
	}
	
	public function remove(){
		if( file_exists( $this->_filepath ) ){
			if( @unlink( $this->_filepath ) ){
				return ($this);
			}else{
				$this->_errors[] = "Datei konnte nicht gel&ouml;scht werden!";
				return ($this);
			}
		}else{
			$this->_errors[] = "Datei exestiert nicht!";
			return ($this);
		}
	}
	
	public function set_json( $array ){
		if( is_array( $array ) ){
			return json_encode( $array, true);
		}
	}
	
	public function get_json( $string, &$is_json = false ){
		
		$is_array = NULL;
		
		if( !is_array( $string ) ){
			$is_array = json_decode( $string, true );
		}
		
		if( is_array( $is_array ) ){
			$is_json = true;
			return $is_array;
		}else{
			return $string;
		}
	}
	
	public function setDir(){
		if( file_exists( dirname( $this->_filepath ) ) ){
			mkdir( dirname( $this->_filepath ) );
		}
	}
	
}
?>
</pre>
