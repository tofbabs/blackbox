<?php

/*
	Utility operation e.g. CURL, 
*/

class Utils{

	/*
	**	Get DATA via HTTP
	*/

	static function getData($url){
 
	    // is cURL installed yet?
	    if (!function_exists('curl_init')){
	        die('Sorry cURL is not installed!');
	    }
	 	
	   	$ch = curl_init();  
	   	
	   	curl_setopt($ch,CURLOPT_URL,$url);
	   	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	   	
	   	$output = curl_exec($ch);
	   	
	   	if($output === false){
	   	    self::debug_to_console("Error Number:".curl_errno($ch)."<br>");
	   	    self::debug_to_consol("Error String:".curl_error($ch));
	   	}

	   	curl_close($ch);
	   	return $output;
	}

	/*
	**	Post DATA via HTTP
	*/

	static function postData($url,$params){

	   //create name value pairs seperated by &
	  $postData = http_build_query($params);
	 
	    $ch = curl_init();  
	 
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    curl_setopt($ch,CURLOPT_HEADER, false); 
	    curl_setopt($ch, CURLOPT_POST, count($postData));
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
	 
	    $output=curl_exec($ch);
	 
	    curl_close($ch);
	    return $output;
	 
	}
	/**
	 * Set error reporting | From Config File
	 */
	
	static function setErrorLogging(){
	    if(DEVELOPMENT_ENVIRONMENT == true){
	        error_reporting(E_ALL | E_STRICT);
	        ini_set('display_errors', "1");
	    }else{
	        error_reporting(E_ALL | E_STRICT);
	        ini_set('display_errors', "0");
	    }
	    ini_set('log_errors', "1");
	    ini_set('error_log', ROOT . 'system/log/error_log.php');
	}

	/**
	 * Trace function which outputs variables to system/log/output.php file
	 */
	static function trace($var,$append=true){
		
	    // $oldString="<?php\ndie();/*";
	    if($append){
	        file_put_contents(ROOT . 'system/log/access.log', $var . PHP_EOL , FILE_APPEND);
	    }
	    else file_put_contents(ROOT . 'system/log/access.log', $var . PHP_EOL);
	}

	static function sanitize($dirty){
		 $whiteSpace = '';  //if you dnt even want to allow white-space set it to ''
		 $pattern = '/[^a-zA-Z0-9'  . $whiteSpace . ']/u';
    	 $cleared = preg_replace($pattern, '', (string) $dirty);
    	 return trim($cleared);
	}

	/** Check for Magic Quotes and remove them **/
	static function stripSlashesDeep($value) {
	    $value = is_array($value) ? array_map('Utils::stripSlashesDeep', $value)  : stripslashes($value);
	    return $value;
	}

	static function removeMagicQuotes() {
	    if ( get_magic_quotes_gpc() ) {
	        $_GET    = self::stripSlashesDeep($_GET);
	        $_POST   = self::stripSlashesDeep($_POST);
	        $_COOKIE = self::stripSlashesDeep($_COOKIE);
	    }
	}

	/** Check register globals and remove them **/
	static function unregisterGlobals() {
	    if (ini_get('register_globals')) {
	        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
	        foreach ($array as $value) {
	            foreach ($GLOBALS[$value] as $key => $var) {
	                if ($var === $GLOBALS[$key]) {
	                    unset($GLOBALS[$key]);
	                }
	            }
	        }
	    }
	}

	// Generate Password for New Users
	static public function generatePassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    // Validate MSISDN being uploaded:
    static public function trimMsisdn($_msisdn){

    	// Sanitize Input MSISDN before further processing
    	$_msisdn = filter_var($_msisdn, FILTER_SANITIZE_NUMBER_INT);

    	$check = substr($_msisdn, 0,3);
    	// First 3 characters are not 234
    	if ($check == '234') {
    		# code...
    		$_msisdn = substr($_msisdn, 3,10);
    		// echo $_msisdn;

    	} else {
    		# code...
    		$_msisdn = substr(trim($_msisdn), -10);
    	}

    	if ( strlen($_msisdn) != 10) {
    		# code...
    		return 500;
    	}
 
    	return "200:" . $_msisdn;
    }

    static public function sendmail($email, $subject, $body, $headers){
    	// ... handle form validation, etc

    	$client = new GearmanClient();
    	$client->addServer();
    	$result = $client->doBackground("send_email", json_encode(array(
    	   // whatever details you gathered from the form
    	  'email' => $email,
    	  'subject' => $subject,
    	  'body' => $body,
    	  'from' => $headers
    	)));

    	// Debug Print
    	self::printOut(array(
    	   // whatever details you gathered from the form
    	  'email' => $email,
    	  'subject' => $subject,
    	  'body' => $body,
    	  'from' => $headers
    	));


    }

    static public function httpAuth($user,$pass){
        $auth_key = base64_encode($user . ":" . $pass);
        // header("Content-Type: text/plain" . "\nAuthorization: Basic $auth_key");
        $_SERVER['PHP_AUTH_USER'] = $user;
        $_SERVER['PHP_AUTH_PW'] = $pass;


    }

    static public function checkAccess($username=null,$password=null,$auth=false){

		// print_r($_SERVER);

		if (!$auth) {
			# code...
			return TRUE;
		}

		if (isset($_SERVER['PHP_AUTH_USER'])) {
		    $username = trim($_SERVER['PHP_AUTH_USER']);
		    $password = $_SERVER['PHP_AUTH_PW'];

		// most other servers
		} elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {

		        if (strpos(strtolower($_SERVER['HTTP_AUTHORIZATION']),'basic')===0)
		          list($username,$password) = explode(':',base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'])));

		}

		if ( ((is_null($username) || $username == '' ) || $_SERVER['PHP_AUTH_USER'] == 'logout' || $password=='') ) {

		    header('WWW-Authenticate: Basic realm=Blacklist API confirmation: Enter Your Registerd Email as Username with corresponding password' . $_SERVER['PHP_AUTH_USER']);
		    header('HTTP/1.0 401 Unauthorized');
		    return false;

		} else {

			$u = User::getOne(array('user_email' => $username));
			if ($u->getPassword() == $password) {
				# code...
				// print_r($u);
				$_SESSION['basicauthuser'] = $username;
				return TRUE;
			}else{
				header('Location: http://logout@localhost/blacklist/');
				header('HTTP/1.0 401 Unauthorized');

				return FALSE;
			}

			return TRUE;
		    
		}

    }

    /*
	**	Check if user has priviledge for url
    */
    static public function checkPriv($url){

    	$request = explode('/',$url); 
    	// print_r($request);
    	// echo ucfirst(array_shift($request));
    	$controller = ucfirst(array_shift($request)) . 'Controller' ;
    	// echo $controller;
    	$c = new $controller();
    	$c->setPermToggle(1);

    	if (isset($request[0])) {
    		# code...
    		$method = array_shift($request);
    		$params = implode(',', $request);
    		// echo $params;
    		if($params!='') $c->$method($params);
    	}
    	// $c->resetview();

    	return $c->isAllowed(); #0 or 1

    }

    /**  
     * Downlaods File to Browser for User
     * @return NULL
     */ 
    static public function downloadFile($content, $filename='FileDownload'){

        # code...
        $disposition = 'Content-Disposition: attachment; filename="'. $filename .'"';
        header('Content-Type: application/text');
        header($disposition);
        header('Content-Length: ' . strlen($content));
        echo $content;
    }

    /**  
     * DEBUG Print
     * @return NULL
    **/ 

    static public function printOut($msg){

		if (DEVELOPMENT_ENVIRONMENT) {
			var_export($msg) . PHP_EOL;
		}

    }



}

