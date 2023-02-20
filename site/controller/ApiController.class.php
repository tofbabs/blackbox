<?php
header('Content-Type: text/plain');

/**
 * Site Index Controller
 */
global $host;

class ApiController extends Controller {
	private $host;
	function __construct() {
		$this->template = new Template();
        $this->setVariable('title', substr($this->getPageTitle(),0,-10));

        // Default: Disable HTTP Basic Authentication
        $this->check = Utils::checkAccess();
        $this->setView('', 'raw');

	}

    /* 
        Get list of Blacklisted Numbers @$value=NULL
        Get a SIGNAL variable for a particular MSISDN e.g @$value=23480..
        Resp: 2000
    */

    function index(){

        $this->setVariable('default', 'Bad HTTP Header or No Formal Request...Try again');
    }

    function fetchRecent($list_type){

        // Enable HTTP Basic Authentication
        $this->check = Utils::checkAccess(null,null,TRUE);

        $this->setView('', 'raw');

        $u = User::getOne(array('user_email' => $_SERVER['PHP_AUTH_USER']));
        $company = Company::getOne(array('company_id' => $u->getCompany()));

        $user_last_set_id = $company->getLastDownloadSet();
        $all_set = array();
        $list = '';

        $last = Set::getLast();
        if ($user_last_set_id != $last) {
            # get difference from the last time user implemented blacklist

            for ($i = $last; $i > $user_last_set_id; $i--) { 
                # code...
                Utils::printOut('Checking...Set '. $i);
                $tmp_file = FILE_PATH . $list_type . '_set' . $i . '.csv';
                $all_set[]= $i;
                if(file_exists($tmp_file)) $list .= file_get_contents($tmp_file);
            }

            // Make file available for Download

            $company->setLastDownloadSet($last);
            $company->save();

            Activity::create('implement', $company->getName(), ' ' . ucfirst($list_type). ' Set' . implode(',', $all_set));

        }
        Utils::printOut($list);
        if ($this->check) echo $list;
        else echo "501: Bad Authentication";

        // $this->setVariable('response',$list);

    }

    function fetchAllBlacklist($list_type='blacklist'){

        $this->setView('', 'raw');

        // Enable HTTP Basic Authentication
        $this->check = Utils::checkAccess(null,null,TRUE);

        $l = FILE_PATH . $list_type . '.csv';
        Utils::printOut($l);

        if(!file_exists($l)){
            Utils::printOut('File Cache not exist, May take longer to load.');
            $listModel =  $list_type=='blacklist' ? 'Blacklist' : 'DNCList';
            $l = $listModel::getUnique();
            // $this->setVariable('response',$l);
            Utils::printOut($l);
            foreach ($l as $list) {
                echo $list->getMsisdn() . PHP_EOL;
            }
            exit();
        }

        if ($this->check) {
            # code...
            echo file_get_contents($l);
        }
        else echo "501: Bad Authentication";
        // $this->setVariable('response', file_get_contents($l));

        $u = User::getOne(array('user_email' => $_SERVER['PHP_AUTH_USER']));
        $company = Company::getOne(array('company_id' => $u->getCompany()));

        if ($company->getId() != NULL) {
            // Activity Log
            Activity::create('implement', $company->getName(), 'All ' . strtoupper($list_type));
        }
        
    }

    function fetchAllDNC(){
        $this->fetchAllBlacklist('dnc');
    }

    // function createUser($email, $company){

    //     $c = Company::getOne(array('company_id'=> $company));

    //     if ($c->getId() != NULL) {
    //         # code...
    //         $u = User::create(
    //             $c->getId(),
    //             Utils::generatePassword(),
    //             $email,
    //             'secondary'
    //         );

    //         $resp = $u->save(); 
    //         if (explode(':', $resp)[0] == 201) {
    //             # code...
    //             $this->setVariable('response', '200:User Exist');
    //         }else{
    //             $this->setVariable('response', '200:User Created');
    //         }
    //     }else{
    //         $this->setVariable('response', '401:Company Doesn\'t exist');
    //     }

    //     // echo $this->check;
    //     $this->setVariable('check', TRUE);
    // }

    function deleteUser($email){

        $u = User::getOne(array('user_email' => $email));
        if ($u->getId() != NULL) {
            # code...
            $u->delete();
            echo 'successful';
            $this->setVariable('response', '200:User Deleted');
        }else{
            $this->setVariable('response', '401:User Doesn\'t exist');
        }
    }

    // To be improved - 

    function get($_msisdn=NULL){

        $this->check = Utils::checkAccess(null,null,TRUE);

        if (isset($_msisdn)){

            $b = Blacklist::getOne(array('msisdn' => $_msisdn));
            $this->setVariable('response', $b->getId() != null ? '200:Number Exist in Blacklist' : '204:Number not in Blacklist');

        }

        // Verify URL Parameter
    /*    
        $user = isset($_GET['u']) ? User::getOne(array('id' => trim($_GET['u']))) : $this->setVariable('response','403: Incomplete Parameter - No User ID');
        // print_r($user);
        $pass = ($user->getPassword() == trim($_GET['p'])) ? TRUE : FALSE;
        $set_info = isset($set_info) ? $set_info : date('Y-m-d');

         if ($pass) {
            // Activity Log
            $log = new Activity();
            $log->setAction('implement');
            $log->setActor($user->getName());
            $log->setObject('Blacklist - ' . $set_info);
            $log->save();

            if (isset($value)){

                $b = Blacklist::getOne(array('msisdn' => $value));
                $this->setVariable('response', $b->getId() != null ? 200 : 0);

            }else{
                # code...
                $l = Blacklist::getUnique(); //Get one user with username==admin
                $this->setVariable('response', $l);
            }

        }
        else{
            $this->setVariable('response', '305: Bad Authentication');
        } 
    */ 
    }

    function search($msisdn){

        $this->check = Utils::checkAccess(null,null,TRUE);

        if (isset($_GET['search'])) {
            # code...
            $msisdn = $_GET['search'];
        }

        $resp = 0;
        $result = Utils::trimMsisdn($msisdn);
        $msisdn = explode(':', $result);
        if ($msisdn[0] == 200) {
            # code...
            $b = Blacklist::getOne(array('msisdn' => $msisdn[1]));
            $resp = $b==FALSE ? 200 : 0; 
        }
       
        $this->setVariable('response', $resp);
        return $resp;
        
    }

    /*
    **  @last=NULL Fetches last 10 Activity
    **  e.g. @last=2 Fetches last 10 setting Starting Point of Dataset to variable
    */

    function activity($last = NULL){

        $count = Activity::getCount();
        $startIndex = 0;
        if(!is_null($last)){
            $startIndex = $last; 
        }
        $a = Activity::getAll(array(), "timestamp DESC",$startIndex, 10);

        $toJson = array();
        foreach ($a as $event) {
            # code...
            $af = new ActivityFrame();
            $af->id = $event->getId();
            $af->action = $event->getAction();
            $af->actor = $event->getActor();
            $af->object = $event->getObject();
            $af->timestamp = $event->getTimestamp();

            $c = Company::getOne(array('company_name' => $event->getActor()));

            // $af->url = $GLOBALS['host'] . "/user/profile/" .str_replace(' ', '-', $event->getActor());

            $af->url = $GLOBALS['host'] . "/user/profile/" .$c->getId();

            $toJson[] = $af;
        }

        echo json_encode($toJson);
    }

    function report(){

        $today = date('Y-m-d');
        $s = Set::get('SELECT * FROM UpdateSet WHERE createdon>"' . $today . '"');
        // print_r($s);

        $resp = array();
        foreach ($s as $key => $set) {
            # code...
            $a = array(strtotime($set->getTime()) . '000', $set->getListSize() );
            array_push($resp, $a );
        }
        // $r = array(
        //     array('1364598000000','2134'),
        //     array('1364619600000','5133'),
        //     array('1364641200000', '8195'),
        //     array('1364662800000','2134'),
        //     array('1364684400000','5133')
        // );
        echo json_encode($resp);

    }

    function __destruct(){
        $this->setVariable('check', $this->check);
    }
   
}

Class ActivityFrame{
    public $id;
    public $action;
    public $actor;
    public $object;
    public $timestamp;
    public $url;
}

?>