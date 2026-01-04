<?php
$server="localhost";
$username="root";
$password="";
$database="facturation";
try{
    $con=new PDO("mysql:host=$server;dbname=$database",$username,$password);
}catch(PDOException $e){
    echo "Erreur de connexion";
}