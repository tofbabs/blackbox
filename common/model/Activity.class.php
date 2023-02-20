<?php
/**
 * Activity Model
 */
class Activity extends CacheModel {
	
    protected static $tableName = 'Activity';
    protected static $primaryKey = 'id';    

    function getId(){
        return $this->getColumnValue('id');
    }
    
    /* 
        Possible Actions: Admin(add-user, delete-user, update-user, add-numbers, 
        delete-numbers, approve-numbers), Providers ( implement-list, filter-numbers), Agents (add-user)
    */
    function setAction($value){
        $this->setColumnValue('action', $value);
    }
    function getAction(){
        return $this->getColumnValue('action');
    }

    /*
        Possible Actors: Admin, Providers, Agents
    */
    function setActor($value){
        $this->setColumnValue('actor', $value);
    }
    function getActor(){
        return $this->getColumnValue('actor');
    }
    
    function setObject($value){
        $this->setColumnValue('object', $value);
    }
    function getObject(){
        return $this->getColumnValue('object');
    }
    
    function getTimestamp(){
        return $this->getColumnValue('timestamp');
    }

    static function create($action, $actor, $object){

        // Disallow null variable
        if ($action != NULL && $actor != NULL && $object != NULL) {
            # code...
            $a = new Activity();

            $a->setAction($action);
            $a->setObject($object);
            $a->setActor($actor);
            $a->save();
        }
        
    }
}
