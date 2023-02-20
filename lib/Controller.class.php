<?php
/**
 * Base Controller class
 */
class Controller {

    protected $role;
    protected $template;
    protected $flash;
    protected $arrRoles = array(1=>'administrator', 2=>'customer care', 3=>'provider');
    protected $privRoles = array('admin' => 1,'customer_care' => 2,'provider' => 3);

    function __construct() {

        $this->template = new Template();
        $this->flash = array();

        $this->setVariable('title', substr($this->getPageTitle(),0,-10));

        // Custom Variables 
        $blacklist_count = Blacklist::getCount(array('status' => 1));
        $dnc_count = DNCList::getCount(array('status' => 1));
        $this->setVariable('blacklist_count', $blacklist_count);
        $this->setVariable('dnc_count', $dnc_count);

        // Start a new Session if none existed
        if ( $this->is_session_started() === FALSE ) {
            session_start();
            $this->setView('', 'login');
        }

        Utils::printOut(substr($this->getPageTitle(),0,-10));
        
    }

    function setPrivRoles(&$value){
        $this->privRoles = $value;
    }

    function setRole(&$value){
        $this->role = $value;
    }

    function checkPermission($priv){
      
        if (!in_array($priv, $this->privRoles)) {
            # code...
            return FALSE;
        }
        return TRUE;
    }

    public function isAllowed(){
        $allowed = TRUE;
        if (isset($_SESSION['user_role']) && $this->checkPermission($_SESSION['user_role']) == FALSE) $allowed = FALSE;
        return $allowed;
    }
    public function getPageTitle(){
        // echo get_called_class();
        return get_called_class();
    }
    
    function index(){
        error_log("Controller[".get_called_class()."] index method is not defined");
        
        
    }
    
    protected function setView($folder,$file){
        
        if (isset($_SESSION['user_role']) && $this->checkPermission($_SESSION['user_role']) == FALSE) {
            
            $this->template->set('','404');
            exit();
        } 
        Utils::trace("Setting View to " . $file);
        $this->template->set($folder,$file);
    }

    protected function ignoreSetView(){

        $this->template->norender();
    }

    protected function setVariable($key,$value){
        $this->template->setVariable($key,$value);
    }

    protected function is_session_started(){
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    function notifyBar($type, $msg){
        // $info = '';
        switch ($type) {
            case 'success':
                # code...
                $this->flash[] = '<div class="alert alert-success alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert">×</button>
                          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          <strong>Success: </strong>'. $msg .'</div>';

                break;
            case 'error':
                  # code...
                $this->flash[] = '<div class="alert alert-danger">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <strong>Error: </strong>'. $msg .'</div>';
                  break;  
            case 'info':
                  # code...
                $this->flash[] = '<div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                          <span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span>
                          <strong>Info: </strong>'. $msg .'</div>';
                  break;  

            case 'warning':
                  # code...
                $this->flash[] = '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <strong>Warning: </strong>'. $msg .'</div>';
                  break;

            default:
                # code...
                break;
        }
        // $this->flash[] = $info;
        // array_push($this->flash, $info);

    }

    public function resetview(){
        # code...
        $this->setView('','bulk');
    }
    
    function __destruct(){
        // Redeclare Info Variable
        $this->setVariable('flash', $this->flash);

        $this->template->render();
    }
}

?>