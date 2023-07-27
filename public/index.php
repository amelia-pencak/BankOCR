<?php
require_once "../vendor/autoload.php";
// require "../handlerPliku.php"; 
// require "../polaczenieBazy.php"; 
spl_autoload_register(function($class_name){
    $sciezka = '../'.$class_name. '.php';
     if(file_exists($sciezka)) {
        require_once $sciezka;
     }
});
// spl_autoload_register(function($class_name){
//     $parts = explode('\\', $class_name);
//     $nameClass = end($parts);
//     $count = strlen($nameClass);
//     $foldery = substr($class_name, -$count);
//     $sciezkaDoOcr = "..\\lib\\" .$foldery . $nameClass . ".php";
//     if(file_exists($sciezkaDoOcr)) {
//         require_once $sciezkaDoOcr;
//     }
// });
// spl_autoload_register(function($class_name){
//     $parts = explode('\\', $class_name);
//     $sciezkaDoOcr = "..\\lib\\" . end($parts) . ".php";
//     if(file_exists($sciezkaDoOcr)) {
//         require_once $sciezkaDoOcr;
//     }
// });

$akcja = $_GET['akcja'] ?? 'brakAkcji'; // jeżli get jest null to przechodzi do kolejnego argumentu

$polaczenieDoBazy = new PolaczenieBazy();
$conn = $polaczenieDoBazy->polaczZBazaDanych();
$handler = new HandlerPliku($conn, SCIEZKADOFOLDERU);
$request = new Request();
switch ($akcja) {
    case 'wczytaniePliku':
        $handler->wczytaniePliku($request);
        break;
    
    case 'pobierzPlik':
        $handler->pobierzPlik($request);
        break;
    
    default:
        $handler->wyswietlanie();
        break;
}