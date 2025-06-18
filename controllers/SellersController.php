<?php

namespace Controllers;
use MVC\Router;
use Model\Seller;

class SellersController {
    
    public static function create(Router $router) { 

        $errors = Seller::getErrors();

        $seller = new Seller;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //create a new instance
            $seller = new Seller($_POST['seller']);

            //validation
            $errors = $seller->validate();

            if(empty($errors)) {
                $seller->save();
            }
        }

        $router->render('sellers/create', [
            'errors' => $errors,
            'seller' => $seller
        ]);
    }

    public static function update(Router $router) { 

        $id = validateOrRedirect('/admin');
        $seller = Seller::find($id);

        $errors = Seller::getErrors();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //asign the values
            $args = $_POST['seller'];

            //synchronize memory object with what the user typed
            $seller->synchronize($args);

            //validation
            $errors = $seller->validate();
            
            if(empty($errors)){
                $seller->save();
            }

        }

        $router->render('sellers/update', [
            'errors' => $errors,
            'seller' => $seller
        ]);
    }

    public static function delete() { 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $type = $_POST['type'];

                if(validateContentType($type)) {
                    $seller = Seller::find($id);
                    $seller->delete();
                }
            }
        }
    }
}