<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


//DB Connection
$db = connectDB();


use Model\ActiveRecord;


ActiveRecord::setDB($db);


