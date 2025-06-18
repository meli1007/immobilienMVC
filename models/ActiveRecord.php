<?php

namespace Model;

class ActiveRecord {
    //DB static because all of then requires the same db conexion
    protected static $db;
    protected static $columnsDB = [];
    protected static $tableDB = '';

    //Errors
    //static -> don't need a new instance for validate
    protected static $errors = [];

    //define the DB connection
    public static function setDB($database) {
        self::$db = $database;
    }


    public function save() {
        if(!is_null($this->id)) {
            //update
            $this->update();
        } else {
            //create a new register
            $this->create();
        }
    }


    public function create() {

        //Sanitize the data
        $attributes = $this->sanitizeAttributes();

        //Insert into DB
        $query = " INSERT INTO " . static::$tableDB . " ( ";
        //generate a new string
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .=" ')";
        
        //or more simple 
        //$columns = join(', ',array_keys($attributes));
        //$rows = join("', '",array_values($attributes));
        //$query = "INSERT INTO properties ($columns) VALUES ('$rows')";

        $result = self::$db->query($query);

        //success message
        if($result) {
            //redirect user
            header('Location: /admin?result=1');
        }

    }
    
    public function update(){
        //Sanitize the data
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach($attributes as $key => $value){
            $values[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tableDB . " SET ";
        $query .= join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);

        if($result) {
            //redirect user
            header('Location: /admin?result=2');
        }
    }

    //delete register
    public function delete() {
        $query = " DELETE FROM " . static::$tableDB . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);

        if($result){
            $this->deleteImage();
            header('Location: /admin?result=3');
        }
    }   

    //Identify and bind attributes from DB
    public function attributes() {
        $attributes = [];

        //map, create a new array with the attributes and object data
        foreach(static::$columnsDB as $column) {
            //if = true, then id will not be added in $attributes
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }
    
    public function sanitizeAttributes(){
        $attributes = $this->attributes();
        $sanitized = [];
        
        foreach($attributes as $attributesKey => $attributesValue) {
            $sanitized[$attributesKey] = self::$db->escape_string($attributesValue);
        }
        
        return $sanitized;
    }

    //Validation
    public static function getErrors() {
        return static::$errors;
    }
    
    public function validate() {
        static::$errors = [];
        return static::$errors;
    }

    public function setImage($image) {
        //delete previous image
        if(!is_null($this->id)) {
            $this->deleteImage();
        }     
        //assign image attribute to image name
        if($image) {
            $this->images = $image;
        }
    }

    //delete file
    public function deleteImage() {
        //proof if file exists
        $existsFile = file_exists(FILE_IMAGES . $this->images);
        if($existsFile){
            unlink(FILE_IMAGES . $this->images);
        }
    }
    
    //List of all registers
    public static function all() {
        $query = "SELECT * FROM " . static::$tableDB;

        $result = self::consultSQL($query);

        return $result;
    }

    //gets a certain number of records
    public static function get($amount) {
        $query = "SELECT * FROM " . static::$tableDB . " LIMIT " . $amount;
        
        $result = self::consultSQL($query);

        return $result;
    }

    //get register by id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tableDB . " WHERE id = $id";
        $result = self::consultSQL($query);

        //array_shift -> return the first element of a array
        return array_shift($result);
    }

    public static function consultSQL($query) {
        // consult DB
        $result = self::$db->query($query);

        //Array Iteration
        $array = [];
        while($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        //free memory
        $result->free();

        //return results of the query
        return $array;
    }

    //create object for the active record
    protected static function createObject($register) {
        $object = new static;

        foreach ($register as $key => $value) {
            //proof if the key exists in the object
            //map the array data to the object
            if(property_exists($object, $key)) {
                $object->$key = $value;
            }
        }
        
        return $object;
    }

    //synchronizes the memory object with the changes from user
    public function synchronize($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}