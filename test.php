<?php 

$host = 'localhost';
$db = 'Test';
$user = 'postgres';
$password = '1234';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";

try{
    $conn = new PDO($dsn);
    $sql = 'SELECT * FROM "TestTable"';

    foreach($conn->query($sql) as $row){
        echo "\n";
        echo $row['Name']. ' | '. $row['Age']. "\n";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}