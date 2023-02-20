<?php
/**
 * CacheModel extends Model base class
 * $tableName
 * $primaryKey
 */
class CacheModel extends Model{
    
    protected static $tableName = '';
    protected static $primaryKey = '';
    protected $columns;

	function __construct() {
		$this->columns = array();
	}

    static public function clearCache($key=NULL){

        $redis = Cache::getInstance();
        if ($redis == FALSE) {
            # code...
            return false;
        }

        if (isset($key)) {
            # code...
            $response = $redis->executeRaw(['FLUSHALL']);
        }else{

            // Flush All Cache on save
            $response = $redis->executeRaw(['DEL ' . $key]);
        }

    }

    /**
     * Get all items
     * Conditions are combined by logical AND
     * @example getAll(array(name=>'Bond',job=>'artist'),'age DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND job='artist' ORDER BY age DESC LIMIT 0,25
     */
    // static function getAll($condition=array(),$order=NULL,$startIndex=NULL,$count=NULL){
    //     $query = "SELECT * FROM " . static::$tableName;
    //     if(!empty($condition)){
    //         $query .= " WHERE ";
    //         foreach ($condition as $key => $value) {
    //             $query .= $key . "=:".$key." AND ";
    //         }
    //     }
    //     $query = rtrim($query,' AND ');
    //     if($order){
    //         $query .= " ORDER BY " . $order;
    //     }
    //     if($startIndex !== NULL){
    //         $query .= " LIMIT " . $startIndex;
    //         if($count){
    //             $query .= "," . $count;
    //         }
    //     }
    //     // echo $query;
    //     // print_r(self::get($query,$condition));
    //     return self::get($query,$condition);
    // }
    
    /**
     * Pass a custom query and condition
     * @example get('SELECT * FROM TABLE WHERE name=:user OR age<:age',array(name=>'Bond',age=>25))
     */
    static function get($query,$condition=array()){

        $redis = Cache::getInstance();
        if ($redis == FALSE) {
            # code...
            $data = parent::get($query, $condition);
            // Callback Function to fetch from Cache
            // self::get($query, $condition);
            return $data;
        }

        $options = array();
        $options['condition'] = serialize($condition);
        $options['query'] = $query;

        $query_key = serialize($options);
        $query_list = static::$tableName. "_get_set";

        $check = $redis->hget($query_list, $query_key) == NULL ? FALSE : TRUE;
        if ($check){
            // echo($redis->hget($query_list, $query_key));

            return unserialize($redis->hget($query_list, $query_key));

        } else{
            
            $data = parent::get($query, $condition);
            self::clearCache($query_key);
            // id to column array mapping
            $redis->hset($query_list, $query_key, serialize($data));
            $redis->expire($query_list, 3600);

            // Callback Function to fetch from Cache
            // self::get($query, $condition);
            return $data;

        }
        
    }
    
    /**
     * Get a single item
     */
    static function getOne($condition=array(),$order=NULL,$startIndex=NULL){

        $redis = Cache::getInstance();
        if ($redis == FALSE) {
            # code...
            $data = parent::getOne($condition,$order,$startIndex);
            // Callback Function to fetch from Cache
            // self::get($query, $condition);
            return $data;
        }

        $options = array();
        $options['condition'] = serialize($condition);
        $options['order'] = $order;
        $options['startIndex'] = $startIndex;

        $query_key = serialize($options);
        $query_list = static::$tableName. "_getone_set";

        // echo $query_list .''. $query_key . ''. $redis->hexists($query_list, $query_key);
        // echo $redis->hget($query_list, $query_key);
        $check = $redis->hget($query_list, $query_key) == NULL ? FALSE : TRUE;
        if ($check){
            // print_r(($redis->hget($query_list, $query_key)));
            return unserialize($redis->hget($query_list, $query_key));
        } else{


            $data = parent::getOne($condition,$order,$startIndex);
            self::clearCache($query_key);
            // id to column array mapping
            $redis->hset($query_list, $query_key, serialize($data));
            $redis->expire($query_list, 3600);

            

            // Callback Function to fetch from Cache
            // self::getOne($condition,$order,$startIndex);

            return $data;
        }
        
    }
    
}