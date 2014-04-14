<?php
################################################################################################################################
## Bl�tter classe f�r eine forschleife ### Habe fr�her sehr sehr viel mit dem Datei System programiert!
## Die ist Alt aber sie functioniert noch ^^, ob wohl mann sie etwas abspecken k�nnte, werde ich mal machen wenn ich mehr zeit habe.
class blaetter   
{   
    var $counter;   
    var $config;  
    var $site;  
      
    function msa()  ### Hier erfolg die Ausgabe f�r den anfang der for Schleife
    {  
        $seite = array();       
        $pages = $this->counter / $this->config;  
        $pages = ceil($pages);  
        $start = 0;  
        $seite[0] = "";  
        for($i=1; $i < $pages+1; $i++){  
            $seite[] = $start;  
            $start = $start + $this->config;  
        }
		 
        if( !empty( $this->site )){
        	return $seite[$this->site];
		}else{
			return 0;
		}     
    }  
      
    function mse()  ### Hier erfolg die Ausgabe f�r das ende der for Schleife
    {  
        $seite = array();       
        $pages = $this->counter / $this->config;  
        $pages = ceil($pages);  
        $stop = $this->config;  
        $seite[0] = "";  
        for($i=1; $i < $pages+1; $i++){  
            $seite[] = $stop;  
            $stop = $stop + $this->config;  
        }
		
		if( !empty( $this->site )){
        	return $seite[$this->site];
		}else{
			return $this->config;
		}      
    }  
           
    function msl($pfad, $post, $maxshow = 2) ### Hier werden die Hyperlinks erzeugt womit mann Bl�ttern kann!
    {    
        $link = "";       
        $pages = $this->counter / $this->config;  
        $pages = ceil($pages);
		$max_anzeigen = $maxshow;
		$aktive_seite = $this->site;
		if( empty( $aktive_seite )){
			$aktive_seite = 1;
		}else{
			$aktive_seite = $this->site;
		}
		### Den anfang bestimmen
		if( $aktive_seite > $max_anzeigen ){
			$zeige_start = $aktive_seite - $max_anzeigen;
		}else{
			$zeige_start = 1;
		}
		### Das ende Bestimmen
		if( $aktive_seite <= $pages - $max_anzeigen ){
			$zeige_ende = $aktive_seite + $max_anzeigen;
		}else{
			$zeige_ende = $pages;
		}
		### Ein Sprung bis zu 1 und ein schrit zur�ck
		if( $aktive_seite != 1 ){
			$link .= "[<a href='".$pfad."&".$post."=1'>1</a>]";
			$seite_sprung = $aktive_seite - 1;
			$link .= "[<a href='".$pfad."&".$post."=".$seite_sprung."'><b>&laquo;</b></a>] - ";
		}
		### Dynamische seitenanzhal ausgeben!
		for($i=$zeige_start; $i < $zeige_ende+1; $i++){  
            if( $aktive_seite != $i ){  
                $link .= "[<a href='".$pfad."&".$post."=" . $i . "'>". $i ."</a>]";
            }else{  
                $link .= "[<b>". $i ."</b>]";  
            }  
        } 
		### Ein Sprung bis zum ende
		if( $aktive_seite != $pages && $aktive_seite > 1 || $aktive_seite != $pages && $pages > 1){
			$seite_sprung = $aktive_seite + 1;
			$link .= " - [<a href='".$pfad."&".$post."=".$seite_sprung."'><b>&raquo;</b></a>]";
			$link .= "[<a href='".$pfad."&".$post."=".$pages."'>".$pages."</a>]";
		}
        return $link;  
    } 
}



    public static function ar()
    {
        ?><pre><?php
        foreach(func_get_args() as $arg){
            if( is_array($arg) || is_object($arg)){
                print_r($arg);
                ?><hr><?php
            } else {
                echo $arg;
                ?><hr><?php
            }
        }
        ?></pre><?php
    }
    
    public static function dump()
    {
        ?><pre><?php
        foreach(func_get_args() as $arg){
            var_dump($arg);
            ?><hr><?php
        }
        ?></pre><?php
    }
?>