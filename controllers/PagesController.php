<?php

namespace Controllers;
use MVC\Router;
use Model\Property;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController {

    public static function index(Router $router) {
        $properties = Property::get(3);
        $start = true;
        $router->render('pages/index', [
            'properties' => $properties,
            'start' => $start
        ]);
    }
    public static function about(Router $router) {
        $router->render('pages/about');
    }
    public static function listings(Router $router) {
        $properties = Property::all();
        $router->render('pages/listings', [
            'properties' => $properties
        ]);
    }
    public static function listing(Router $router) {
        $id = validateOrRedirect('/properties');

        $property = Property::find($id);

        $router->render('pages/listing', [
            'property' => $property
        ]);
    }
    public static function blog(Router $router) {
        //importar nuevo modelo, 
        $router->render('pages/blog');
    }
    public static function entry(Router $router) {
        //utilizar clase record, el mismo modelo de blog y utilizar metodo find
        $router->render('pages/entry');
    }
    public static function contact(Router $router) {

        $message = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $responses = $_POST['contact'];

            //create PHPMailer instance
            $mail = new PHPMailer();

            //config. SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
            
            
            $mail->setFrom('admin@immobilien.com');
            $mail->addAddress('admin@immobilien.com', 'Immobilien.com');
            $mail->Subject = 'Sie haben eine neue Nachricht';

            //Enable HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Define content
            $content = '<html>';
            $content .= '<p>Sie haben eine neue Nachricht</p>';
            $content .= '<p>Name: ' . $responses['name'] . '</p>';
            
            //Send email or phone fields conditionally
            if($responses['contact'] === 'telefon') {
                $content .= '<p>Die bevorzugte Kontaktmethode ist Telefon.</p>';
                $content .= '<p>Telefonnummer: ' . $responses['phone'] . '</p>';
                $content .= '<p>Möchte am: ' . $responses['date'] .' um ' .  $responses['hour'] . ' kontaktiert werden.</p>';
                
            } else {
                //email
                $content .= '<p>Die bevorzugte Kontaktmethode ist E-Mail.</p>';
                $content .= '<p>E-mail: ' . $responses['email'] . '</p>';
            }

            $content .= '<p>Message: ' . $responses['message'] . '</p>';
            $content .= '<p>kaufen oder verkaufen: ' . $responses['type'] . '</p>';
            $content .= '<p>Preis: ' . $responses['price'] . '€</p>';
            
            $content .= '</html>';

            $mail->Body = $content;
            $mail->AltBody = 'Text ohne HTML';

            //Send email
            if($mail->send()){
                $message = "Nachricht erfolgreich gesendet";
            } else {
                $message = "Nachricht konnte nicht gesendet werden";
            }
        }

        $router->render('pages/contact', [
            'message' => $message
        ]);
    }
}