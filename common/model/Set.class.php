<?php
/**
 * User Model
 */
class Set extends CacheModel {
	
    protected static $tableName = 'UpdateSet';
    protected static $primaryKey = 'id';

    
    function setId($value){
        $this->setColumnValue('id', $value);
    }
    function getId(){
        return $this->getColumnValue('id');
    }
    
    function setComment($value){
        $this->setColumnValue('comment', $value);
    }
    function getComment(){
        return $this->getColumnValue('comment');
    } 

    function getTime(){
        return $this->getColumnValue('createdon');
    }

    function setListSize($value){
        $this->setColumnValue('listsize', $value);
    }
    function getListSize(){
        return $this->getColumnValue('listsize');
    }

    function setListType($value){
        $this->setColumnValue('list_type', $value);
    }
    function getListType(){
        return $this->getColumnValue('list_type');
    }

    function setUser($value){
        $this->setColumnValue('approved_by', $value);
    }

    function getUser(){
        return $this->getColumnValue('approved_by');
    }    


    static function getLast(){
        # code...
        return self::getOne(array(), 'id DESC')->getId();
    }

    
   
}
