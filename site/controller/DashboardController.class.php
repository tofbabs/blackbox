<?php
/**
 * Site Index Controller
 */
class DashboardController extends Controller {
	
	function __construct() {
		parent::__construct();

		if(!isset($_SESSION['company'])){

		    $this->setView('', 'login');

		}else{

			$this->initDashboard($_SESSION['company']);
		}
	}


	function index(){

		if(isset($_POST['loginBtn'])){

		    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
		    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

		    $u = User::getOne(array('user_email' => $email));
		    // $c = new Company();
		    $c = Company::getOne(array('company_id' => $u->getCompany()));

		    if ($u->getActive() == 0) {
		    	# code...
		    	$this->notifyBar(
		    		'error', 
		    		'Please re-activate your account. Kindly follow this link to <a href="'. ROOT_URL .'/login/reset/' . str_rot13($u->getEmail()) . '">Reset Your Password</a>');
		    	$this->setView('', 'login');
		    	exit();
		    }

		    if($u->getPassword() == $password){
		    	
		    	$_SESSION['user_id'] = $u->getId();
		    	$_SESSION['company'] = $c;
		    	$u->setActive(1);
		    	$this->initDashboard($c);
		    	
		    	Activity::create('login',$c->getName(),'Blacklist System');
		    	
		    }else{

		    	$this->notifyBar('error', 'Wrong Username/Password.');
		    	$this->setView('', 'login');
		    	exit();
		    }
		}
		
	
	}

	public function initDashboard(&$company){

		$s = Set::getOne(array(), 'id DESC');
		$this->setVariable('set', $s);
		$this->setVariable('session_company', $company);

		$this->setView('', 'dashboard');
		

	}
   
}

?>