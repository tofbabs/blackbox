<?php

date_default_timezone_set('Africa/Lagos');
define('ROOT',dirname(realpath(__FILE__))."/");


global $host;
global $privileges;

$privileges = array(1=>'Administrators', 2=>'Customer Care Agent', 3=>'Service Providers');

/**
 * 
 * DO NOT DEFINE ANY CONSTANTS HERE. DEFINE THOSE IN CONFIG.PHP
 * 
 */
$thisDir=explode("/", ROOT);
$conflen=strlen(array_pop($thisDir));
$B=substr(__FILE__, 0, strrpos(__FILE__, '/'));
$A=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
$C=substr($B, strlen($A));
$posconf=strlen($C) - $conflen;
$D=substr($C, 0, $posconf);
$host='http://' . $_SERVER['SERVER_NAME'] . '/' . $D;

// define('ROOT_URL', $host);

include(ROOT . 'system/config/config.php');
include(ROOT . 'lib/functions.php');


/*
    Main Call Function 
    Application Router
*/

function callHook() {
    global $url;
    global $area;
    $url = rtrim($url,"/");
    $urlArray = array();
    $urlArray = explode("/",$url);
    // print_r($urlArray);
    $controller = DEFAULT_CONROLLER;
    $action = DEFAULT_ACTION;
    $data = array();
    // print_r($urlArray);
    //Check if the call is to admin area
    if($urlArray[0] == "admin"){
        $area = "admin";
        array_shift($urlArray);
    }

    //Controller
    if(isset($urlArray[0]) && !empty($urlArray[0])){
        $controller = array_shift($urlArray);
        // echo $controller;
    }

    if(isset($urlArray[0]) && !empty($urlArray[0])){

        $action = array_shift($urlArray);
        $action = str_replace('-', '_', $action);
    }

    // Get Data parsed with URL
    if(isset($urlArray[0]) && !empty($urlArray[0])){

        $data = $urlArray;
        // print_r($urlArray);
        // echo "No SMS parameters supplied";
    }

    //Setup database
    Database::getInstance('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    
    //LOAD THE CONTROLLER
    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    // echo $controller;


    if (class_exists($controller)) {
        $dispatch = new $controller();
    }else{
        // echo 'I am here';
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    // print_r($dispatch);
    
    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch,$action),$data);
    } else {
        error_log("Unknown page/action, Controller = ".$controller.", action = ".$action);
    }
}

function __autoloader($className) {
    $paths = array(
        ROOT."/lib/",
        ROOT."/site/controller/",
        ROOT."/admin/controller/",
        ROOT."/common/",
        ROOT."/common/model/"
    );
    foreach($paths as $path){
        if(file_exists($path.$className.".class.php")){
            // echo $path.$className.".class.php </br>";
            require_once($path.$className.".class.php");
            break;
        }
    }
}

spl_autoload_register('__autoloader');

$area = "site";

/*
    LOADS ALL UTILITY FUNCTIONS
*/
    
Utils::setErrorLogging();
Utils::removeMagicQuotes();
Utils::unregisterGlobals();

callHook();

?>