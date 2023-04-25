<?php
class Konfiguracja {
    public static $host = 'localhost';
    public static $db = 'ListaPobran';
    public static $user = 'postgres';
    public static $password = '1234';
    public static function getDbHost() {
        return self::$host;
    }
    public static function getDb() {
        return self::$db;
    }
    public static function getDbUser() {
        return self::$user;
    }
    public static function getDbPassword() {
        return self::$password;
    }
}
define("SCIEZKADOFOLDERU","C:\Temp");
