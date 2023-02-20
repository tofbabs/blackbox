<?php

/**
 * Model base class
 */
class Model {

    protected static $tableName = '';
    protected static $primaryKey = '';
    protected $columns;

    function __construct() {
        $this->columns = array();
    }

    function setColumnValue($column, $value) {
        $this->columns[$column] = $value;
    }

    function getColumnValue($column) {
        return key_exists($column, $this->columns) ? $this->columns[$column] : NULL;
    }

    /**
     * Save or update the item data in database
     */
    function save() {

        $class = get_called_class();
        $query = "REPLACE INTO " . static::$tableName . " (" . implode(",", array_keys($this->columns)) . ") VALUES(";
        $keys = array();
        Utils::printOut($this->columns);
        foreach ($this->columns as $key => $value) {
            $keys[":" . $key] = $value;
        }
        $query .= implode(",", array_keys($keys)) . ")";

        Utils::printOut($query);
        $db = Database::getInstance();

        $s = $db->getPreparedStatment($query);
        // snippet uses PDO
        // Check for Duplicate Entry
        try {
            $s->execute($keys);
            return $db->lastInsertId();

            // do other things if successfully inserted
        } catch (PDOException $e) {

            if ($e->errorInfo[1] == 1062) {
                // duplicate entry, do something else
                Utils::trace('This Unique Value already exists.');
                Utils::printOut('201:Duplicate Entry');
            } else {
                // an error other than duplicate entry occurred
                Utils::trace('A database insert error occured' . $e->errorInfo[1]);
                Utils::printOut('500:'.$e->errorInfo[1]);
            }
        }
        // $s->execute($keys);
    }

    /**
     * Delete this item data from database
     */
    function delete() {
        $class = get_called_class();
        $query = "DELETE FROM " . static::$tableName . " WHERE " . static::$primaryKey . "=:id LIMIT 1";
        $db = Database::getInstance();
        $s = $db->getPreparedStatment($query);
        $s->execute(array(':id' => $this->columns[static::$primaryKey]));
    }

    /**
     * Create an instance of this Model from the database row
     */
    function createFromDb($column) {
        if (is_array($column)) {
            # code...
            foreach ($column as $key => $value) {
                $this->columns[$key] = $value;
            }
        } else {
            return false;
        }
    }

    /**
     * Get all items
     * Conditions are combined by logical AND
     * @example getAll(array(name=>'Bond',job=>'artist'),'age DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND job='artist' ORDER BY age DESC LIMIT 0,25
     */
    static function getAll($condition = array(), $order = NULL, $startIndex = NULL, $count = NULL) {
        $query = "SELECT * FROM " . static::$tableName;
        if (!empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($startIndex !== NULL) {
            $query .= " LIMIT " . $startIndex;
            if ($count) {
                $query .= "," . $count;
            }
        }
        // echo $query;
        return self::get($query, $condition);
    }

    /**
     * Pass a custom query and condition
     * @example get('SELECT * FROM TABLE WHERE name=:user OR age<:age',array(name=>'Bond',age=>25))
     */
    static function get($query, $condition = array()) {
        
        Utils::printOut($query);

        $db = Database::getInstance();
        $s = $db->getPreparedStatment($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $result = $s->fetchAll(PDO::FETCH_ASSOC);
        $collection = array();
        $className = get_called_class();
        foreach ($result as $row) {
            $item = new $className();
            $item->createFromDb($row);
            array_push($collection, $item);
        }
        return $collection;
    }

    // GET RAW FROM DB
    static function justGet($query) {
        $db = Database::getInstance();
        $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 0);
        $s = $db->getPreparedStatment($query);

        $s->execute();
        $result = $s->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Get a single item
     */
    static function getOne($condition = array(), $order = NULL, $startIndex = NULL) {
        $query = "SELECT * FROM " . static::$tableName;
        if (!empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($startIndex !== NULL) {
            $query .= " LIMIT " . $startIndex . ",1";
        }
        $db = Database::getInstance();
        // echo $query;
        $s = $db->getPreparedStatment($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $row = $s->fetch(PDO::FETCH_ASSOC);
        $className = get_called_class();
        $item = new $className();
        $item->createFromDb($row);
        return $item;
    }

    /**
     * Get an item by the primarykey
     */
    static function getByPrimaryKey($value) {
        $condition = array();
        $condition[static::$primaryKey] = $value;
        return self::getOne($condition);
    }

    /**
     * Get the number of items
     */
    static function getCount($condition = array()) {
        $query = "SELECT COUNT(*) FROM " . static::$tableName;
        if (!empty($condition)) {
            $query .= " WHERE ";
            foreach ($condition as $key => $value) {
                $query .= $key . "=:" . $key . " AND ";
            }
        }
        $query = rtrim($query, ' AND ');
        $db = Database::getInstance();
        $s = $db->getPreparedStatment($query);
        foreach ($condition as $key => $value) {
            $condition[':' . $key] = $value;
            unset($condition[$key]);
        }
        $s->execute($condition);
        $countArr = $s->fetch();
        return $countArr[0];
    }

}
