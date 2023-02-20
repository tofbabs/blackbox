<?php
global $privileges;
/**
 * Site Index Controller
 */
class UserController extends Controller {
	
    private $session_company;
    private $u;

	function __construct() {

        $this->privRoles = array(1);
		parent::__construct();
        $this->u = $_SESSION['company'];
        // Utils::printOut($u);

	}
    
    function index(){

        // print_r($_SESSION);
        $this->view();
    }

    /*
    **  Add a new User / Company
    */

    public function add(){

        $this->setView('', 'add-user');
        $isset_primary_user = FALSE;
    	
        /* 
            If Post Button is clicked 
        */
    	if(isset($_POST['addNewUserBtn'])) {

            // Validate POST INPUT
            if(isset($_POST['primary_email']) && isset($_POST['company_name'])) {

                // Initialize POST variables
                $primary_email = filter_var($_POST['primary_email'], FILTER_SANITIZE_EMAIL);
                $company_name = $_POST['company_name'];
                $role = $_POST['role'];

                // Check if user exist
                $pu = User::getOne(array('user_email' => $primary_email));
                /**
                *   Checking if Primary User exist
                *   Then Company Exist. Rule of Thumb
                *   Create New or Get Company Info
                */
                if($pu->getId() == NULL) {

                    # Change Primary User Flag
                    $isset_primary_user = TRUE;

                    $company = new Company();

                    // Create or Update Company Details
                    $company->setName($company_name);
                    $company->setPrivilege($role);
                    $company->setLastDownloadSet(0);

                    // Refresh Company Details after saving
                    $company_id = $company->save();
                    Utils::printOut("Company ID to Create/Update:" . $company_id);


                    // Create New User, Returns new User ID
                    $pu = User::create(
                        $company_id,
                        Utils::generatePassword(),
                        $primary_email,
                        'primary'
                    );

                    $this->sendWelcomeEmail($pu);
                }
                else{
                    $company = Company::getOne(array('company_id' => $pu->getCompany()));
                    $company_id = $company->getId();
                }
                    
                Utils::printOut("Company ID to Create/Update:" . $company_id);

                // Check if user set secodary email, create or update user if set
                if (isset($_POST['secondary_email'])) {
                    # code...
                    $secondary_email = filter_var($_POST['secondary_email'], FILTER_SANITIZE_EMAIL);
                    // Check if secondary user exist
                    $sec_u = User::getOne(array('user_email' => $secondary_email));

                    if($sec_u->getId() == NULL){

                        $su = User::create(
                            $company_id,
                            Utils::generatePassword(),
                            $secondary_email,
                            'secondary'
                        );

                        $this->sendWelcomeEmail($su);
                    }
                    

                // Log Company Account Creation
                Activity::create('add-user',$_SESSION['company']->getName(), $company_name);
                
                

                // Create or Update Company Details
                $company->setName($company_name);
                $company->setPrivilege($role);

                // Refresh Company Details after saving
                $company_id = $company->save();


                if ($isset_primary_user) $this->notifyBar('success', $company_name . ' Profile Updated.');
                else $this->notifyBar('success', $company_name .' Profile Created.');
            } 
            else{
                $this->notifyBar('error', 'Please Complete Required Fields');
            }

            $this->view();
            
    	}
        
    }
}

    /*
    **  View Method to display list of users  
    **
    */

    public function view($role = NULL){

        // Initializing Company List Variable Buffer
        $company_list = array();

        // Validating User request 
        $key = !is_null($role) ? array_search($role, $this->arrRoles) : TRUE;

        if (isset($role) && $key != FALSE) {
            # code...
            $company_list = Company::getAll(array('company_role'=> $key));
            // Building Data Structure for User View 
            $this->setVariable('role', $role);
            
        }else{

            if ($key == FALSE) {
                $this->notifyBar('error', 'User Group ' . $role . ' Doesn\'t exist.');
            }
            
            $company_list = Company::getAll();
            $this->setVariable('role', 'All Users');
        }

        $_userlist = $this->_buildUsers($company_list);

        Utils::printOut($_userlist);

        $this->setVariable('users', $_userlist);
        $this->setView('', 'users');
       
    }

    function _buildUsers(&$company_list){

        $userlist = array();
        foreach ($company_list as $key => $c) {
            # code...
            $u = User::getOne(array('user_company_id' => $c->getId(), 'user_level' => 'primary'));

            $ul = array(
                'email' => $u->getEmail(),
                'company' => $c->getName(),
                'role' => ucfirst($this->arrRoles[$c->getPrivilege()]),
                'company_id' => $c->getId()
            );
            array_push($userlist,$ul);

        }

        return $userlist;
        Utils::printOut($userlist);

    }

    /*
        Send Welcome Message to Inactive users
    */
    function sendWelcomeEmail(User $user){
        # code...
        $subject = "Automation of Subscriber Blacklisting on the Etisalat Network";

        $body = "Dear Partner," . PHP_EOL . PHP_EOL;
        $body .= "Sequel to the Email from Etisalat as regards the new blacklisting solution" . PHP_EOL . "Kindly find your details to access the Portal below. " . PHP_EOL . PHP_EOL . "On successful login, click on Documentation to view the User Manual." . PHP_EOL . PHP_EOL;
        $body .= "URL: http://blacklist.atp-sevas.com/blacklist" . PHP_EOL;

        // Sending Email to all users for a company

        if ($user->getActive() == 0) {
            # code...
            $body .= "Email: " . $user->getEmail() . PHP_EOL ;
            $body .= "Password: " . $user->getPassword() . PHP_EOL ;
            $body .= PHP_EOL . "Regards";

            Utils::sendmail($user->getEmail(), $subject, $body, EMAIL_HEADER);
        }
            
    }

    function delete($company_id){

        $c = Company::getOne(array('company_id' => $company_id));
        // Activity Log
        Activity::create('delete', $_SESSION['company']->getName(), $c->getName());

        // delete company entry
        $c->delete();

        // Get all users for company
        $u = User::getAll(array('user_company_id' => $company_id));
        foreach ($u as $key => $user) {
            # code...
            $user->delete();
        }

        $this->view();

    }

    function edit($id){

        $isAllowed = FALSE;

        if (!isset($id)) {
            # code...
            $this->setView('', 'add-user');
            exit();
        }

        Utils::printOut($this->u);
        Utils::printOut('Company Role' . $this->u->getPrivilege());

        // Check if Session User has permission to edit particular User
        if($this->u->getId() != $id && $this->u->getPrivilege() !== '1') {
            
            $this->profile($id);
            exit();
        }

        $c = Company::getOne(array('company_id' => $id));
        $u = User::getAll(array('user_company_id' => $c->getId()));

        // Determine Primary User
        foreach ($u as $key => $user) {
            # code...
            if ($user->getLevel() == 'primary') {
                # code...
                $this->setVariable('primary_user', $user);
                unset($u[$key]);
                continue;
            }
            // Set the rest as Secondary User
            $this->setVariable('secondary_user', $user);
            
        }

        
        $this->setVariable('company_id', $id);
        $this->setVariable('company_name', $c->getName());
        $this->setVariable('role', ucfirst($this->arrRoles[$c->getPrivilege()]));

        $this->setView('', 'add-user');

    }

    function profile($company_id){

        $company = Company::getOne(array('company_id' => $company_id));
        
        if ($company->getId() == NULL) {
            # code...
            $this->notifyBar('error','Company Doesn\'t Exist');
        }

        $this->privRoles = array(1,2,3);
        $this->setView('', 'profile');

        // Fetch All Activities for Company Profile
        $a = Activity::getAll(array('actor' => $company->getName()));

        $user = User::getOne(array('user_company_id' => $company->getId()));

        $this->setVariable('primary_contact',$user->getEmail());
        $this->setVariable('company', $company);
        $this->setVariable('activities', $a);

    }
}

?>