<?php

namespace Model;

class Seller extends ActiveRecord {
    
    protected static $tableDB = 'sellers';
    protected static $columnsDB = ['id', 'firstName', 'lastName', 'phone'];

    public $id;
    public $firstName;
    public $lastName;
    public $phone;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->firstName = $args['firstName'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->phone = $args['phone'] ?? '';
    }

    public function validate() {
        if(!$this->firstName){
            self::$errors[] = "Bitte geben Sie einen Vornamen ein";
        }

        if(!$this->lastName){
            self::$errors[] = "Bitte geben Sie einen Nachnamen ein";
        }

        if(!$this->phone){
            self::$errors[] = "Bitte geben Sie eine Telefonnummer ein";
        }
        //only numbers 0 to 9 and 10 digits
        if(!preg_match('/[0-9]{10}/', $this->phone)){
            self::$errors[] = "ungültiges Format";
        }

        return self::$errors;
    }
}