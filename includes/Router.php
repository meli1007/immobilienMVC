<?php

namespace MVC;

class Router {

    public $routesGET = [];
    public $routesPOST = [];

    public function get($url, $fn) {
        $this->routesGET[$url] = $fn;
    }
    
    public function post($url, $fn) {
        $this->routesPOST[$url] = $fn;
    }

    //Based on the URL I visit there is an associated function
    public function checkRoutes() {

        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Array of protected routes 
        $routes_protected = [
            '/admin', 
            '/properties/create',
            '/properties/update',
            '/properties/delete',
            '/sellers/create',
            '/sellers/update',
            '/sellers/delete',
        ];

        $urlCurrent = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $fn = $this->routesGET[$urlCurrent] ?? null;
        } else {
            $fn = $this->routesPOST[$urlCurrent] ?? null;
        }
        //Protect the routes
        if(in_array($urlCurrent, $routes_protected) && !$auth) {
            header('Location: /');
        }

       //The URL exists and there is an associated function.
        if($fn) {
            //Call a function when its name is unknown - dynamic
            call_user_func($fn, $this);
        } else {
            echo "PAGE NOT FOUND";
        }
    }

    //Show view
    public function render($view, $data = [] ) {
        
        foreach($data as $key => $value) {
            //$$ variable variable
            //means that the variable name is stored in another variable, 
            //and the value of that variable is used as the name of the original variable.
            $$key = $value;
        }

        //It's like starting memory storage
        ob_start();
        include __DIR__ . "/../views/{$view}.php";
        //clean the memory
        $content = ob_get_clean();

        include __DIR__ . "/../views/layout.php";
    }
}