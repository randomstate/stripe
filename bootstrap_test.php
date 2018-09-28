<?php

require_once('vendor/autoload.php'); // Composer autoloader

$dotenv= new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

function env($var) {
    return getenv($var);
}