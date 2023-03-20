<?php

class Wyswietlacz {
    public $sciezkaZapisu = "C:\\xampp\\htdocs\\demo\\wynik.txt";
    public $liczby = "";
    public function wyswietl(NumerKonta $numerKonta) {
        $liczby = $numerKonta->naNumericString();
        if(strlen($liczby) != 9) {
            $this->wyswietlanieGdyZlaDlugoscNumeru($liczby);
            return;
        }
        if(!$numerKonta->czyPoprawnyNumerKonta()) {
            $this->wyswietlanieGdyNumerNiprawidlowy($liczby, $numerKonta->utworzAlternatywy());
        }
        else {
            file_put_contents($this->sciezkaZapisu, $liczby. "\n", FILE_APPEND);
        }
        
    }
    public function wyswietlanieGdyNumerNiprawidlowy( $liczby, $alternatywneLiczby) {
        if(empty($alternatywneLiczby)) {
            file_put_contents($this->sciezkaZapisu, $liczby. " ERR \n", FILE_APPEND);
        }
        else {
            if(sizeof($alternatywneLiczby)==1) {
                file_put_contents($this->sciezkaZapisu,  "[ ". $alternatywneLiczby[0]. " ]". " IRR \n", FILE_APPEND);
            }
            else {
                file_put_contents($this->sciezkaZapisu, $liczby. " [ ". implode(", ", $alternatywneLiczby). " ]". " AMB \n", FILE_APPEND);
            }
        }
    }
    public function wyswietlanieGdyZlaDlugoscNumeru($liczby) {
        if(strlen($liczby) >9) {
            file_put_contents($this->sciezkaZapisu, "Numer konta za długi \n", FILE_APPEND);
        }
        if(strlen($liczby) <9) {
            file_put_contents($this->sciezkaZapisu, "Numer konta za krótki \n", FILE_APPEND);
        }
    }
}
