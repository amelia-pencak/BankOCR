<?php

$wskaznik = $_GET['test'];
require "handlerPliku.php";
$host = 'localhost';
$db = 'ListaPobran';
$user = 'postgres';
$password = '1234';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
$conn = new PDO($dsn);
$handler = new handlerPliku($conn, SCIEZKADOFOLDERU);
switch ($wskaznik) {
    case 'wczytaniePliku':
        $handler->wczytaniePliku();
        break;
    
    case 3:
        $handler->pobierzPlik();
        break;
    
    default:
        $handler->wyswietlanie();
        break;
}