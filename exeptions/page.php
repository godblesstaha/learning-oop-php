<?php
$server="localhost";
$user="root";
$password="";
$db="bts1";
try {
    $con=new PDO("mysql:host=$server;dbname=$db",$user,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM table_non_existent";
    $stmt = $con->query($sql);

} catch (PDOException $e) {
    // echo "une erreur est survenu";
    // echo "Erreur : " . $e->getMessage();
    error_log($e->getMessage());
    echo "OK";
}
