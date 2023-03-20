<?php

require_once('_cyfry.php');
class NumerKonta {
    public $liczbaAscii = "";
    public $tablicaObiektowCyfr = [];
    function __construct($liczbaAscii) {
        if (is_string($liczbaAscii)) {
            $this->liczbaAscii = $liczbaAscii;
            $this->tablicaObiektowCyfr = $this->utworzTabliceCyfr();
        }
        else if(is_array($liczbaAscii)){
            $this->tablicaObiektowCyfr = $liczbaAscii;
        }
    }
    public function naNumericString() {
        $wynik = "";
        foreach($this->tablicaObiektowCyfr as $cyfra) {
            $wynik .=  $cyfra->naNumericString();
        }
        return $wynik; // String numer konta
    }
    function utworzTabliceCyfr() {
        $tablicaObiektówCyfr = [];
        $wierszeAscii = explode("\r\n", $this->liczbaAscii);
        $tablicaCyfrAscii = [];
        $dlugosc = strlen(max($wierszeAscii));
        for($i = 0;$i < $dlugosc;$i++) {
            $cyfraAscii = "";
            foreach ($wierszeAscii as $wiesz) {
                $cyfraAscii .= substr($wiesz, $i, 3);
            }
            $i +=2;
            $tablicaCyfrAscii[] = $cyfraAscii;
        }
        foreach($tablicaCyfrAscii as $cyfraAscii) {
            $tablicaObiektówCyfr[] = new Cyfra($cyfraAscii);
        }
        return $tablicaObiektówCyfr;            
    }
     public function czySamePytajniki() {
        $stringCyfr = $this->naNumericString();
        $tablicaCyfr = str_split($stringCyfr, 1);
        $tablicaCyfrBezDuplikatow = array_unique($tablicaCyfr);
        $stringBezDuplikatow = implode("", $tablicaCyfrBezDuplikatow);
        if($stringBezDuplikatow == '?') {
            return true;
        }
        return false;
    }
    public function utworzAlternatywy() {
        $alternatywneLiczby = [];
        for($i =0;$i < 9;$i++) { 
            $a= $this->tablicaObiektowCyfr[$i];
            $tablicaAlternatywnychCyfr = $this->tablicaObiektowCyfr[$i]->zwrocAlternatywneCyfry();
            foreach($tablicaAlternatywnychCyfr as $alternatywnaCyfra) {
                $aktualnaTablicaObiektowCyfr = $this->tablicaObiektowCyfr;
                $aktualnaTablicaObiektowCyfr[$i] = $alternatywnaCyfra;
                $numerKonta = new NumerKonta($aktualnaTablicaObiektowCyfr);
                if($numerKonta->czyPoprawnyNumerKonta()) {
                    $alternatywneLiczby[] = $numerKonta;
                }
            }
        }
        return $alternatywneLiczby;
    }
    private function czySameCyfry() {
        $tablicaCyfr = str_split($this->naNumericString(), 1);
        foreach($tablicaCyfr as $cyfra) {
            if($cyfra == "?") {
                return false;
            }
        }
        return true;
    }
    public function czyPoprawnyNumerKonta() {
        $tablicaCyfr = str_split($this->naNumericString(), 1);
        if ($this->czySameCyfry()) {
            $wynik = 0;
            $mnoznik = 9;
            for ($i =0; $i<9;$i++) {
                $wynik += (int)$tablicaCyfr[$i] * $mnoznik;
                $mnoznik --;
            }
            if($wynik % 11 == 0) {
                return true;
            }
        }
        return false;
    }

    function __toString() {
        return $this->naNumericString();
    }
    
}