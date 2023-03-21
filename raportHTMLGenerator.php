<?php

class RaportHTMLGenerator {
    private $conn;
    function __construct(PDO $conn)
    {
        $this->conn = $conn;
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
                $wyswietlLink = '<a href="uploadPliku.php?nazwaPliku='.$nazwa.'" name="pobieraniePliku"> '.$nazwa .'</a>';
                $listaWynikow .= "<br/>";
                $listaWynikow .= $row['dataWgrania']. ' | '. $wyswietlLink . "<br/>";
            }
            return $listaWynikow;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}

