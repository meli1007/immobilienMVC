<?php

namespace Controllers;
use MVC\Router;
use Model\Property;
use Model\Seller;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropertyController {
    public static function index(Router $router) {
        $properties = Property::all();

        $sellers = Seller::all();
        //show condicional message
        $result = $_GET['result'] ?? null; 

        $router->render('properties/admin', [
            'properties' => $properties,
            'result' => $result,
            'sellers' => $sellers
        ]);
    }
    public static function create(Router $router) {

        $property = new Property;
        $sellers = Seller::all();
        //array with error messages
        $errors = Property::getErrors();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $property = new Property($_POST['property']);

            //generate unic name 
            $nameImage = md5( uniqid( rand(), true ) ) . ".jpg";   
            if($_FILES['property']['tmp_name']['image']) {
                $manager = new Image(Driver::class);
                $images = $manager->read($_FILES['property']['tmp_name']['image'])->cover(800, 600);
                $property->setImage($nameImage);
            }

            $errors = $property->validate();

            //proof if the array is empty 
            if(empty($errors)) {
                /*UPLOAD FILES*/
                if(!is_dir(FILE_IMAGES)){
                    mkdir(FILE_IMAGES);
                }

                //save image in server
                $images->save(FILE_IMAGES . $nameImage);
                
                $property->save();
            }
        }

        $router->render('properties/create', [
            'property' => $property,
            'sellers' => $sellers,
            'errors' => $errors

        ]);
    }

    public static function update(Router $router) {

        $id = validateOrRedirect('/admin');
        $property = Property::find($id);
        $sellers = Seller::all();

        $errors = Property::getErrors();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //assign attributes
            $args = $_POST['property'];

            $property->synchronize($args);

            //validation
            $errors = $property->validate();

            //upload files
            //generate unic name 
            $nameImage = md5( uniqid( rand(), true ) ) . ".jpg";   
            
            if($_FILES['property']['tmp_name']['image']) {
                $manager = new Image(Driver::class);
                $images = $manager->read($_FILES['property']['tmp_name']['image'])->cover(800, 600);
                $property->setImage($nameImage);
            }


            if(empty($errors)) {
                if($_FILES['property']['tmp_name']['image']) {
                    // save image
                    $images->save(FILE_IMAGES . $nameImage);
                }
                
                $property->save();
            }
        }
        
        $router->render('/properties/update', [
            'property' => $property,
            'sellers' => $sellers,
            'errors' => $errors
        ]);
    }

    public static function delete() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validate the id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $type = $_POST['type'];

                if(validateContentType($type)) {
                    $property = Property::find($id);
                    $property->delete();
                }
            }
        }
    }
}
