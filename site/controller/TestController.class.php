<?php
/**
 * 404 Controller
 */
class TestController extends Controller {
	
	function __construct() {
		$this->template = new Template();
        $this->setVariable('title', substr($this->getPageTitle(),0,-10));

        // Default: Disable HTTP Basic Authentication
        $this->check = Utils::checkAccess();
        $this->setView('', 'raw');
	}
    
    function index(){

            	 
    }

    function testListController(){

        $l = new ListController();
        $l->index();

    }
   
}

?>