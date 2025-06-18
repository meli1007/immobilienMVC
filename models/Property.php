<?php

namespace Model;

class Property extends ActiveRecord {

    protected static $tableDB = 'properties';
    protected static $columnsDB = ['id', 'title', 'price', 'images', 'description', 'rooms', 'wc', 'parking', 'created', 'sellers_id'];

    public $id;
    public $title;
    public $price;
    public $images;
    public $description;
    public $rooms;
    public $wc;
    public $parking;
    public $created;
    public $sellers_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->images = $args['images'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->rooms = $args['rooms'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->created = date('Y/m/d');
        $this->sellers_id = $args['sellers_id'] ?? '';
    }

    public function validate() {
        if(!$this->title){
            self::$errors[] = "Bitte füllen Sie mit einem Titel aus";
        }

        if(!$this->price){
            self::$errors[] = "Bitte geben Sie einen Preis an";
        }

        if( strlen( $this->description ) < 50){
            self::$errors[] = "Bitte geben Sie eine Beschreibung mit mindestens 50 Zeichen ein";
        }

        if(!$this->rooms){
            self::$errors[] = "Die Anzahl der Zimmer ist erforderlich";
        }

        if(!$this->wc){
            self::$errors[] = "Die Anzahl der Badezimmer ist erforderlich";
        }

        if(!$this->parking){
            self::$errors[] = "Die Anzahl der Parkplätze ist erforderlich";
        }

        if(!$this->sellers_id){
            self::$errors[] = "Bitte wählen Sie einen Verkäufer";
        }

        if(!$this->images){
            self::$errors[] = "Bitte laden Sie ein Bild der Immobilie hoch";
        }
        return self::$errors;
    }
}