<?php
namespace MyNamespace;
class Wyswietlacz {
    // public $sciezkaZapisu = "C:\\Temp\\wynik.txt";
    public $liczby = "";
    public function wyswietlJakoTekst(NumerKonta $numerKonta) {
        $liczby = $numerKonta->naNumericString();
        if(strlen($liczby) != 9) {
            $wynik = $this->wyswietlanieGdyZlaDlugoscNumeruJakoTekst($liczby);
            return $wynik;
        }
        if(!$numerKonta->czyPoprawnyNumerKonta()) {
            $wynik = $this->wyswietlanieGdyNumerNiprawidlowyJakoTekst($liczby, $numerKonta->utworzAlternatywy());
            return $wynik;
        }
        else {
            return  $liczby. "\n";
        }
        
    }
    public function wyswietlanieGdyNumerNiprawidlowyJakoTekst( $liczby, $alternatywneLiczby) {
        if(empty($alternatywneLiczby)) {
            return $liczby. " ERR \n";
        }
        else {
            if(sizeof($alternatywneLiczby)==1) {
                return  "[ ". $alternatywneLiczby[0]. " ]". " IRR \n";
            }
            else {
                return $liczby. " [ ". implode(", ", $alternatywneLiczby). " ]". " AMB \n";
            }
        }
    }
    public function wyswietlanieGdyZlaDlugoscNumeruJakoTekst($liczby) {
        if(strlen($liczby) >9) {
            return  "Numer konta za długi \n";
        }
        if(strlen($liczby) <9) {
            return "Numer konta za krótki \n";
        }
    }

    public function wyswietl(NumerKonta $numerKonta, $sciezkaZapisu) {
        $liczby = $numerKonta->naNumericString();
        if(strlen($liczby) != 9) {
            $this->wyswietlanieGdyZlaDlugoscNumeru($liczby,$sciezkaZapisu);
            return;
        }
        if(!$numerKonta->czyPoprawnyNumerKonta()) {
            $this->wyswietlanieGdyNumerNiprawidlowy($liczby, $numerKonta->utworzAlternatywy(), $sciezkaZapisu);
        }
        else {
            file_put_contents($sciezkaZapisu, $liczby. "\n", FILE_APPEND);
        }
        
    }
    public function wyswietlanieGdyNumerNiprawidlowy( $liczby, $alternatywneLiczby, $sciezkaZapisu) {
        if(empty($alternatywneLiczby)) {
            file_put_contents($sciezkaZapisu, $liczby. " ERR \n", FILE_APPEND);
        }
        else {
            if(sizeof($alternatywneLiczby)==1) {
                file_put_contents($sciezkaZapisu,  "[ ". $alternatywneLiczby[0]. " ]". " IRR \n", FILE_APPEND);
            }
            else {
                file_put_contents($sciezkaZapisu, $liczby. " [ ". implode(", ", $alternatywneLiczby). " ]". " AMB \n", FILE_APPEND);
            }
        }
    }
    public function wyswietlanieGdyZlaDlugoscNumeru($liczby, $sciezkaZapisu) {
        if(strlen($liczby) >9) {
            file_put_contents($sciezkaZapisu, "Numer konta za długi \n", FILE_APPEND);
        }
        if(strlen($liczby) <9) {
            file_put_contents($sciezkaZapisu, "Numer konta za krótki \n", FILE_APPEND);
        }
    }
}