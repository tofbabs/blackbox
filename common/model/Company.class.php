<?php
/**
 * Company Model
**/

class Company extends CacheModel {
	
    protected static $tableName = 'Company';
    protected static $primaryKey = 'company_id'; 
    
    function setId($value){
        $this->setColumnValue('company_id', $value);
    }
    function getId(){
        return $this->getColumnValue('company_id');
    }
    
    function setName($value){
        $this->setColumnValue('company_name', $value);
    }
    function getName(){
        return $this->getColumnValue('company_name');
    }
    
    function setPrivilege($value){
        $this->setColumnValue('company_role', $value);
    }
    function getPrivilege(){
        return $this->getColumnValue('company_role');
    }

    /*
    **  @desc Getter/Setter for Last Set Downloaded
    */
    function setLastDownloadSet($value){
        $this->setColumnValue('last_download_set', $value);
    }
    function getLastDownloadSet(){
        return $this->getColumnValue('last_download_set');
    }
    
}
