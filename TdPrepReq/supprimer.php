<?php
$server="localhost";
$user="root";
$password="";
$db="bts1";
$con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
$sql="DELETE FROM etudiants WHERE matriculeEtudiant=?";
if(isset($_GET['matricule'])){
    $matricule=$_GET['matricule'];
    $stmt=$con->prepare($sql);
    $stmt->execute([$matricule]);
    header("Location: liste.php");
}
