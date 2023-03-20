<?php

class Cyfra {
    public $cyfraAscii = "";
    function __construct($cyfraAscii) {
      $this->cyfraAscii = $cyfraAscii;  
    }
    public function naNumericString() {
        if($this->cyfraAscii == " _ | ||_|") {
            return 0;
        }
        if($this->cyfraAscii == "    |  | ") {
            return 1;
        }
        if($this->cyfraAscii == " _  _||_ ") {  
            return 2;
        }
        if($this->cyfraAscii == " _  _| _|") {
            return 3;
        }
        if($this->cyfraAscii == "   |_|  |") {
            return 4;
        }
        if($this->cyfraAscii == " _ |_  _|") {
            return 5;
        }
        if($this->cyfraAscii == " _ |_ |_|") {
            return 6;
        }
        if($this->cyfraAscii == " _   |  |") {
            return 7;
        }
        if($this->cyfraAscii == " _ |_||_|") {
            return 8;
        }
        if($this->cyfraAscii == " _ |_| _|") {
            return 9;
        }
        else {
            return "?";
        }
    }

    public function zwrocAlternatywneCyfry() {
        $tablicaPoprawnychAlternatywnychCyfr = [];
        $tablicaAlternatywRozniacychSieZnakem = $this->zwrocAlternatywyRozniaceSieJednymZnakiem();
        foreach($tablicaAlternatywRozniacychSieZnakem as $alternatywa) {
            if(is_numeric($alternatywa->naNumericString())) {
                $tablicaPoprawnychAlternatywnychCyfr[] = $alternatywa;
            }
        }
        return $tablicaPoprawnychAlternatywnychCyfr;
    }

    private function zwrocAlternatywyRozniaceSieJednymZnakiem() {
        $tablicaAlternatywDlaCyfr = [];
        for($i=0;$i<9;$i++) {
            $aktualnaCyfra = $this->cyfraAscii;
            if($aktualnaCyfra[$i] == " ") {
               $aktualnaCyfra[$i] = "|";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra); 
               $aktualnaCyfra[$i] = "_";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra);
               continue; 
            }
            if($aktualnaCyfra[$i] == "|") {
               $aktualnaCyfra[$i] = " ";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra); 
               $aktualnaCyfra[$i] = "_";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra);
               continue; 
            }
            if($aktualnaCyfra[$i] == "_") {
               $aktualnaCyfra[$i] = "|";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra); 
               $aktualnaCyfra[$i] = " ";
               $tablicaAlternatywDlaCyfr[] = new Cyfra($aktualnaCyfra);
               continue; 
            }
        }
        return $tablicaAlternatywDlaCyfr;
    }
}