<?php
/**
 * User Model
 */
class User extends CacheModel {
	
    protected static $tableName = 'User';
    protected static $primaryKey = 'user_id'; 
    

    function getId(){
        return $this->getColumnValue('user_id');
    }
    
    function setCompany($value){
        $this->setColumnValue('user_company_id', $value);
    }
    function getCompany(){
        return $this->getColumnValue('user_company_id');
    }

    function setPassword($value){
        $this->setColumnValue('user_pass', $value);
    }
    function getPassword(){
        return $this->getColumnValue('user_pass');
    }
    
    // Email is Unique Variable
    function setEmail($value){
        $this->setColumnValue('user_email', $value);
    }
    function getEmail(){
        return $this->getColumnValue('user_email');
    }
    
    //  Set Level e.g. Secondary or Primary
    function setLevel($value){
        $this->setColumnValue('user_level', $value);
    }
    function getLevel(){
        return $this->getColumnValue('user_level');
    }
    
    //  Set Level e.g. Secondary or Primary
    function setActive($value){
        $this->setColumnValue('active', $value);
    }
    function getActive(){
        return $this->getColumnValue('active');
    }

    static function create($company,$pass,$email,$level){

        $u = new User();

        $u->setCompany($company);
        $u->setPassword($pass);
        $u->setEmail($email);
        $u->setLevel($level);
        $u->setActive(0);

        $u->save();
        return $u;

    }
}
