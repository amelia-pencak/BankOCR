<?php

require_once('_wyswietlacz.php');
require_once('_numerKonta.php');

class OCR {
    function zmianaNumeruAsciiZTekstu(string $numeryKont) {
    $sciezkaZapisu = 'C:\xampp\htdocs\studia\wynikiA.txt';
    $tablicaNumerowKont = explode("\r\n", $numeryKont);
    $_3wiersze = ["","",""];
    $wielkosc = count($tablicaNumerowKont);
    $tablica = [];
    for($i =0; $i<$wielkosc;$i++) {
        array_shift($_3wiersze);
        $_3wiersze[] = $tablicaNumerowKont[$i]."\r\n";
        $liczbaAscii = implode($_3wiersze);
        $numer = new NumerKonta($liczbaAscii);
        if($numer->czySamePytajniki()) {
            continue;
        } 
        $wyswietlacz = new Wyswietlacz();
        $tablica[]=$wyswietlacz->wyswietlJakoTekst($numer);
    }
    $wynik = implode($tablica);
    return $wynik;
    }
    function zmianaNumeruAscii(string $sciezkaDoPliku, string $sciezkaZapisu) {
        // $scierzkaDoPliku = "C:\\xampp\\htdocs\\demo\\weejscie.txt";
        $plik = fopen($sciezkaDoPliku, 'r');
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
            $wyswietlacz->wyswietl($numer,$sciezkaZapisu);
        }
        fclose($plik);
        }
}