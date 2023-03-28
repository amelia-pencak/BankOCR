<?php
var_dump($_REQUEST);
$a = $_REQUEST['test'];
$b = $_GET['test'];
if($_REQUEST) {
    echo 12;
    echo $b;
}
require "wczytaniePlikuHandler.php";
require "raportHTMLGenerator.php";
require_once('_liczba.php');

$host = 'localhost';
$db = 'ListaPobran';
$user = 'postgres';
$password = '1234';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
$conn = new PDO($dsn);

$czyJestNazwaPliku = empty($_GET['nazwaPliku']);
if (!$czyJestNazwaPliku) {
    $nazwaPliku = $_GET['nazwaPliku'];
    pobierzPlik(SCIEZKADOFOLDERU, $nazwaPliku);
    exit();
}

$tmp = empty($_FILES['plikDanych']['name'][0]);
if (!$tmp) {
    $handler = new WczytaniePlikuHandler($conn, SCIEZKADOFOLDERU);
    $handler->wczytaniePliku();
} else {
    echo "Wprowadź plik wejsciowy! </br>";
}
$wyswietlaczWynikowNaStronie = new RaportHTMLGenerator($conn);
echo $wyswietlaczWynikowNaStronie->zwrocRaportOcerowania();

function pobierzPlik(string $sciezkaDoFolderu, string $nazwaPliku)
{
    $sciezkaBezwzgledna =  $sciezkaDoFolderu . "\\" . $nazwaPliku;
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="' . $nazwaPliku . '"');
    readfile($sciezkaBezwzgledna);
}
