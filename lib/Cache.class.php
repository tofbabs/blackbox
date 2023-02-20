<?php
/**
 * Redis Database Singleton
 */
require ROOT . "vendor/predis/autoload.php";

class Cache {
    protected static $instance;
    // protected static $redis;

    /**
     * Get instance of the Redis Connection
     * @return Redis
     */

    static function getInstance(){
        if(!self::$instance){
            $redis = new Predis\Client(); 

            // Check if Redis is available else use redundant memory
            try {
                $redis->ping();
            } catch (Exception $e) {
                // LOG that redis is down : $e->getMessage();
                Utils::trace('Redis is down. Check If running on port' . $e->getMessage());
            }

            if( isset($e) ) {
                //use MySQL
                return false;
            }else{
                Utils::trace('Connecting To Redis');
                self::$instance = $redis;
            }
        }

        return self::$instance;
    }

    
    function __destruct(){
        // $this->cache = NULL;
    }
    
    
}

?>