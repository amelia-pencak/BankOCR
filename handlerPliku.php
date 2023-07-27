<?php
// require "stronaPierwsza.php"; 
// require_once('_liczba.php');
use MyNamespace\OCR;

class HandlerPliku {
    private $conn;
    private $sciezkaDoFolderu;
    
    function __construct(PDO $conn, $sciezkaDoFolderu) {
        $this->sciezkaDoFolderu = $sciezkaDoFolderu;
        $this->conn = $conn;
    }

    public function wczytaniePliku(Request $request) {
        $pliki = $request->zwrocPlik('plikDanych','name');
        $tmpNazwaPliku = $request->zwrocTabliceTmpNazwPliku('plikDanych'); //tablica
        $tmp = empty($pliki[0]);
        if (!$tmp) {
            $liczbaPlikow = count($pliki);
            for ($i = 0; $i < $liczbaPlikow; $i++) {
                $filename = $this->utworzNowyPlik($i, $this->sciezkaDoFolderu,$tmpNazwaPliku);
                $this->zapiszWynikDoPliku($filename, $this->sciezkaDoFolderu);
                $this->zapiszSciezkeDoPlikuWynikowego($filename);
            }
        } else {
            echo "Wprowadź plik wejsciowy! </br>";
        }
        $this->wyswietlanie();
    }

    private function utworzNowyPlik($numerPliku, $sciezkaDoFolderu, $tmpNazwaPliku) {
        $filename = basename($tmpNazwaPliku[$numerPliku], ".tmp") . ".txt";
        $newFile = $sciezkaDoFolderu . "/" . $filename;
        move_uploaded_file($tmpNazwaPliku[$numerPliku], $newFile);
        return $filename;
    }

    private function zapiszWynikDoPliku(string $filename, string $sciezkaDoFolderu) {
        try {
            $numeryKont = file_get_contents($sciezkaDoFolderu . "/" . $filename);
            if ($numeryKont == false) {
                throw new Exception('Błąd odczytu pliku.');
            }
            $ocr = new OCR();
            $wyniki = $ocr->zmianaNumeruAsciiZTekstu($numeryKont);
            $zapisanieDoPliku = file_put_contents("../".$filename, $wyniki); // ?
            if ($zapisanieDoPliku == false) {
                throw new Exception('Błąd zapisu do pliku.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    private function zapiszSciezkeDoPlikuWynikowego(string $filename) {
        try {
            if (isset($filename)) {
                $obecnaData = date('d-m-y H:i:s');
                $sql = $this->conn->prepare('INSERT INTO pobrania("dataWgrania","nazwaPliku") VALUES (:dataWgraniaPliku , :nazwaPliku)');
                $sql->bindParam(':dataWgraniaPliku', $obecnaData);
                $sql->bindParam(':nazwaPliku', $filename);
                $sql->execute();
                $result = $this->conn->prepare('SELECT * FROM "pobrania"');
                $result->execute();
                $iloscWierszy = $result->rowCount();
                $this->usuwajWierszeWiekszeNiz10($iloscWierszy);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    private function usuwajWierszeWiekszeNiz10($iloscWierszy) {
        while ($iloscWierszy > 10) {
            $sqlDelete = 'DELETE FROM "pobrania" WHERE "dataWgrania" = (SELECT "dataWgrania" FROM "pobrania" ORDER BY "dataWgrania"  LIMIT 1)';
            $this->conn->query($sqlDelete);
            $iloscWierszy--;
        }
    }

    public function wyswietlanie() {
        $wyswietlaczStronyPoczatkowej = new stronaPierwsza();
        echo $wyswietlaczStronyPoczatkowej->wyswietlStronePoczatkowa();
        echo $this->zwrocRaportOcerowania();
    }

    public function zwrocRaportOcerowania() {
        $sqlSave = 'SELECT * FROM "pobrania"';
        $listaWynikowOcerowania = $this->conn->query($sqlSave);
        return $this->przygotujListeWynikowOcerowania($listaWynikowOcerowania);
    }

    private function przygotujListeWynikowOcerowania($listaWynikowOcerowania) { //nie kożystała z bazy danych - pobierac wyniki
        $listaWynikow = "";
        try {
            foreach($listaWynikowOcerowania as $row){
                $nazwa = $row['nazwaPliku'];
                $wyswietlLink = '<a href="index.php?akcja=pobierzPlik&nazwaPliku='.$nazwa.'" name="pobieraniePliku"> '.$nazwa .'</a>';
                $listaWynikow .= "<br/>";
                $listaWynikow .= $row['dataWgrania']. ' | '. $wyswietlLink . "<br/>";
            }
            return $listaWynikow;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function pobierzPlik(Request $request)
    {
        $nazwaPlikuDoPobrania = $request->zwrocParametrGet('nazwaPliku');
        $this->sciezkaDoFolderu = SCIEZKADOFOLDERU;
        $czyJestNazwaPliku = empty($nazwaPlikuDoPobrania);
        if (!$czyJestNazwaPliku) {
        $nazwaPliku = $nazwaPlikuDoPobrania;
        $sciezkaBezwzgledna =  $this->sciezkaDoFolderu . "\\" . $nazwaPliku;
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="' . $nazwaPliku . '"');
        readfile($sciezkaBezwzgledna);
        }
    }
    
}
