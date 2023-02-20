<?php

/**
 * DNCList Model Class
 * @extend ParentList Class
 */
include_once 'ParentList.class.php';

class DNCList extends ParentList {
	
    protected static $primaryKey = 'id';
    protected static $list_type = 'dnc';

    function setListType($value='dnc'){
        # code...
        $this->setColumnValue('list_type', $value);
    }

}
