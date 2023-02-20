<?php
/**
 * Site Index Controller
 */
class DocumentationController extends Controller {
	
	function __construct() {
		parent::__construct();
        $this->privRoles = array(1);
	}
    
    function index(){
        
    	$this->setView('', 'help');
    	 
    }
   
}

?>