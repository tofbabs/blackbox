<?php

	error_reporting(E_ALL | E_STRICT);	        
	ini_set('display_errors', "0");

	require 'Mail.php';
	

	class SendMail extends Mail {

	    protected static $smtp_session;
	    
	    //A cache to hold prepared statements
	    protected $smtp;
	    
	    /**
	     * Get session of SMTP
	     * @return smtp_session
	     */
	    static function getSession($host,$port=465,$username,$password){
	        if(!self::$smtp_session){
	            self::$smtp_session = self::factory('smtp', array(
			        'host' => $host,
			        'port' => $port,
			        'auth' => true,
			        'username' => $username,
			        'password' => $password,
			        'persist' => true
			    ));
	        }
// 	        print_r(self::$smtp_session);
	        return self::$smtp_session;
	    }
	    
	    static function destroy(){
	    	$smtp_session = NULL;
	    }
	}

?>
