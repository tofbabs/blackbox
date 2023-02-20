<?php
/**
 * Site Index Controller
 */
class LoginController extends Controller {
	
	function __construct() {
		parent::__construct();
	}
    
    function index(){
        
        unset($_SESSION['company']);
        unset($_SESSION['FILE_PROCESSING']);
    	$this->setView('', 'login');

    	if(isset($_POST['resetBtn'])){

    		$email = $_POST['email'];
    		$u = User::getOne(array('email' => $email));
    		$password = $u->getPassword();

    		if ($password!=NULL) {
    			# code...
    			Utils::sendmail($email, 'Reset Password', 'Find Password: ' . $password, EMAIL_HEADER);
    			$this->notifyBar('success','Check your Email');
    			exit();
    		}

    		$this->notifyBar('error','User Doesn\'t Exist');

    	}
    	 
    }

    function forgotten(){
    	$this->setView('', 'forgot-password');
    }

    // function reset($user_encode_email=null){

    //     $this->setView('', 'forgotpwd');

    //     if (isset($_POST['remindPwdBtn'])){

    //         $u = User::getOne(array('email' => $_POST['email']));
    //         if ($u->getId() != null ) {
    //             # code...
    //             $msg = 'Kindly follow this link to reset your password http://shuttlers.ng/login/reset/' . str_rot13(str_replace('@','blt',$u->getEmail()));
    //             Utils::send_mail("Shuttlers Team" , $msg, $_POST['email'], "shuttlersng@gmail.com", 'Password Reset');
    //             $this->notifyBar('success', 'Please Check ' . $_POST['email'] . ' to reset your password');
    //             str_replace(search, replace, subject)
    //         }else{
    //             $this->notifyBar('error', 'Account not found');

    //         }

    //     }

    //     if (!is_null($user_encode_email)) {
    //         # code...
    //         $user_email = (str_rot13($user_encode_email));
    //         $this->setVariable('user_email', );
    //         $this->setView('', 'resetpwd');

    //     }

    //     if (isset($_POST['changePwdBtn'])) {
    //         # code...
    //         $u = User::getOne(array('email'=> $_POST['email']));
    //         $u->setPassword($_POST['password']);
    //         $u->save();
    //         $this->notifyBar('success', 'Your Password now reset. Kindly Login below');

    //         $this->setView('', 'login');

    //     }

    // }

    function reset($user_encode_email=null){

        $this->setView('', 'forgot-password');

        if (isset($_POST['resetBtn'])){

            $u = User::getOne(array('user_email' => $_POST['email']));
            if ($u->getId() != null ) {
                # code...
                $msg = 'Kindly follow this link to reset your password '. ROOT_URL .'/login/reset/' . str_rot13($u->getEmail());
                Utils::printOut($msg);
                Utils::sendmail("RESET PASSWORD" , $msg, $_POST['email'], EMAIL_HEADER);
                $this->notifyBar('success', 'Please Check ' . $_POST['email'] . ' for your password');

            }else{
                $this->notifyBar('error', 'Account not found');

            }

        }

        if (!is_null($user_encode_email)) {
            # code...
            $this->setVariable('user_email', str_rot13($user_encode_email));
            $this->setView('', 'resetpwd');

        }

        if (isset($_POST['changePwdBtn'])) {
            # code...
            $u = User::getOne(array('user_email'=> $_POST['email']));
            $u->setPassword($_POST['password']);
            $u->setActive(1);

            $u->save();

            Utils::printOut($u);
            $this->notifyBar('success', 'Your Password now reset. Kindly Login below');

            $this->setView('', 'login');

        }

    }
   
}

?>