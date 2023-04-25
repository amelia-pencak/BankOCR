<?php

class PolaczenieBazy { 
    function polaczZBazaDanych() {
        $host = konfiguracja::getDbHost();
        $db = konfiguracja::getDb();
        $user = konfiguracja::getDbUser();
        $password = konfiguracja::getDbPassword();

        $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
        $conn = new PDO($dsn);
        return $conn;
    }
}

