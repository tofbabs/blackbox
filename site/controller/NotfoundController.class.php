<?php
/**
 * 404 Controller
 */
class NotfoundController extends Controller {
	
	function __construct() {
		// parent::__construct();
        $this->template = new Template();
        // $this->setVariable('title', substr($this->getPageTitle(),0,-10));
	}
    
    function index(){

    	$this->setView('', '404');
    	 
    }
   
}

?>