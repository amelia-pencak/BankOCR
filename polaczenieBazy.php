<?php

class polaczenieBazy {
    function polaczenieZBazaDanych() {
        $host = 'localhost';
        $db = 'ListaPobran';
        $user = 'postgres';
        $password = '1234';

        $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
        $conn = new PDO($dsn);
        return $conn;
    }
}