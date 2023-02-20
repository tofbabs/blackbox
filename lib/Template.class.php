<?php
/**
 * Template class
 */
class Template {
	
    protected $file;
    protected $folder;
    protected $variables;
    
	function __construct() {
		$this->variables = array();
	}
    
    /**
     * Set the folder and filename for the view template file
     */
    function set($folder,$file){
        $this->folder = $folder;
        $this->file = $file;
    }
    
    /**
     * Set the variables to be exported into the template file
     */
    function setVariable($key,$value){
        $this->variables[$key] = $value;
    }
    
    function render(){
        global $area; //Get the global variable $area
        global $host; //Get the global $host variable
        extract($this->variables); //Extract the variables into the page, so that each key is available inside the page as php variable
        
        //Include defined view
        $filename = ROOT.$area."/view/".$this->folder."/".$this->file.".php";
        if(file_exists($filename)){
            include($filename);
        }
       
    }
}

?>