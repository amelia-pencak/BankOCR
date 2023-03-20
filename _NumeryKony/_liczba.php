<?php

require_once('_wyswietlacz.php');
require_once('_numerKonta.php');

class OCR {
    function zmianaNumeruAscii() {
    $plik = fopen("C:\\xampp\\htdocs\\demo\\weejscie.txt", 'r');
    $_3wiersze = ["","",""];
    while (!feof($plik)) {
        array_shift($_3wiersze);
        $_3wiersze[] = fgets($plik);
        $liczbaAscii = implode($_3wiersze);
        $numer = new NumerKonta($liczbaAscii);
        if($numer->czySamePytajniki()) {
            continue;
        } 
        $wyswietlacz = new Wyswietlacz();
        $wyswietlacz->wyswietl($numer);
    }
    fclose($plik);
    }
}

$ocr = new OCR();
$ocr->zmianaNumeruAscii();