<?php
    //Mode procedural:
    $server="localhost";
    $user="root";
    $password="";
    $db="bts";
    // $con=mysqli_connect($server,$user,$password,$db);
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $filiere=$_POST['filiere'];
    //$sql="INSERT INTO etudiants VALUES(NULL,'$nom','$prenom','$filiere')";
    // mysqli_query($con,$sql);//execution de la requete
    //classe mySQLI:
    // $con=new mySQLi($server,$user,$password,$db);
    // $con->query($sql);
    // PDO:
    $sql="DELETE FROM etudiants";
    //$sql="UPDATE etudiants SET nom='ELOMARI' WHERE idEtudiant=16";
    $con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
    $con->query($sql);
    header("location:formulaire.php");
 