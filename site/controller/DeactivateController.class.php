<?php
/**
 * Site Index Controller
 */
class DeactivateController extends Controller {
	
	function __construct() {
		parent::__construct();
        $this->privRoles = array(1);
	}
    
    function index(){
        
    	$this->setView('', 'deactivate');
    	 
    }

    function search(){
        $this->setView('', 'service_search');
    }
   
}

?>