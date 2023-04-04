<?php

require "../handlerPliku.php"; 
if(isset($_GET['test'])) {
    $akcja = $_GET['test'];
} else {
    $akcja = 'brakAkcji';
}
$host = 'localhost';
$db = 'ListaPobran';
$user = 'postgres';
$password = '1234';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
$conn = new PDO($dsn);
$handler = new handlerPliku($conn, SCIEZKADOFOLDERU);
switch ($akcja) {
    case 'wczytaniePliku':
        $handler->wczytaniePliku();
        break;
    
    case 'pobierzPlik':
        $handler->pobierzPlik();
        break;
    
    default:
        break;
}
$handler->wyswietlanie();