<?php

namespace Model;

class Admin extends ActiveRecord {

    //DB
    protected static $tableDB = 'users';
    protected static $columnsDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validate() {
        if(!$this->email){
            self::$errors[] = "E-mail ist erforderlich";
        }

        if(!$this->password){
            self::$errors[] = "Password ist erforderlich";
        }

        return self::$errors;
    }

    public function userExists() {
        //Check if a user exists
        $query = "SELECT * FROM " . self::$tableDB . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $result = self::$db->query($query);

        if(!$result->num_rows){
            self::$errors[] = 'User existiert nicht';
        }
        return $result;
    }

    public function checkPassword($result) {
        $user = $result->fetch_object();

        $auth = password_verify($this->password, $user->password);

        if(!$auth){
            self::$errors[] = 'Passwort ist nicht korrekt';
            
        }

        return $auth;
    }

    public function authenticate() {
        session_start();

        //add elements to the session array
        $_SESSION['user'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}