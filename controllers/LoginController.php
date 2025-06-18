<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Admin($_POST);

            $errors = $auth->validate();

            if(empty($errors)) {
                //check if user exists
                $result = $auth->userExists();

                if(!$result) {
                    $errors = Admin::getErrors();
                } else {
                    //verification of password -- return true or false
                    $authenticated = $auth->checkPassword($result);

                    if($authenticated) {
                        //auth. user
                        $auth->authenticate();
                    } else {
                        $errors = Admin::getErrors();
                    }
                    
                }
                
                

            }


        }

        $router->render('auth/login', [
            'errors' => $errors
        ]);

    }

    public static function logout() {
        //access to the session
        session_start();

        //session_destroy is a option but this is better
        $_SESSION = [];

        header('Location: /');
    }
}