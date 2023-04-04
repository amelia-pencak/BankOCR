<?php

require "../handlerPliku.php"; 
require "../polaczenieBazy.php"; 

$akcja = $_GET['akcja'] ?? 'brakAkcji' ; // jeżli get jest null
$polaczenieDoBazy = new polaczenieBazy();
$conn = $polaczenieDoBazy->polaczenieZBazaDanych();
$handler = new handlerPliku($conn, SCIEZKADOFOLDERU);

switch ($akcja) {
    case 'wczytaniePliku':
        $handler->wczytaniePliku();
        break;
    
    case 'pobierzPlik':
        $handler->pobierzPlik();
        break;
    
    default:
        $handler->wyswietlanie();
        break;
}
