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
$wyswietlaczStronyPoczatkowej = new stronaPierwsza();

switch ($akcja) {
    case 'wczytaniePliku':
        $handler->wczytaniePliku();
        $wyswietlaczStronyPoczatkowej->wyswietlStronePoczatkowa();
        $handler->wyswietlanie();
        break;
    
    case 'pobierzPlik':
        $handler->pobierzPlik();
        break;
    
    default:
        $wyswietlaczStronyPoczatkowej->wyswietlStronePoczatkowa();
        $handler->wyswietlanie();
        break;
}


class stronaPierwsza {
    function wyswietlStronePoczatkowa() {
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Bank OCR</title>
            </head>
            <body>
            <form action="index.php?test=wczytaniePliku" enctype="multipart/form-data" method="post" class="form-example">
            <div class="form-example">
                <label for="name">Wybierz plik z numerami kont: </label>
            </div>
            <div class="form-example">
                <input type="file" name="plikDanych[]" id="file" multiple accept=".txt">
                <input type="submit" name="przycisk" value="sprawdz wynik!">
            </div>
            </form>
            </body>
        </html>';
    }
}