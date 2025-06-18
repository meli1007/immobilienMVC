<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL',  __DIR__ . 'functions.php');
define('FILE_IMAGES', $_SERVER['DOCUMENT_ROOT'] . '/images/');

function includeTemplate( string $name, bool $start = false ) {
    include TEMPLATES_URL . "/{$name}.php";
}

function isAuthenticated() {
    session_start();

    //if is not auth. then redirect to /
    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//scape / sanitize html
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//validate content type
function validateContentType($type) {
    $types = ['seller', 'property'];
    return in_array($type, $types);
}

//show messages
function showNotifications($code) {
    $message = '';

    switch($code) {
        case 1: 
            $message = 'Erfolgreich erstellt';
            break;
        case 2: 
            $message = 'Erfolgreich aktualisiert';
            break;
        case 3: 
            $message = 'Erfolgreich gelöscht';
            break;
        default:
            $message = false;
            break;
    }
    return $message;
}

function validateOrRedirect(string $url) {
    //validate URL for validate ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url ");
    }
    
    return $id;
}