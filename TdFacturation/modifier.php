<?php
require "connexion.php";
    $id=$_GET['id'];
    $select=$con->prepare("SELECT * FROM client WHERE idClient=?");
    $select->execute([$id]);
    $row=$select->fetch();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $update = "UPDATE client SET nom=?, prenom=?, adresse=? WHERE idClient=?";
        $stmt = $con->prepare($update);
        $stmt->execute([$nom, $prenom, $adresse, $id]);
        header("Location: listeClients.php");
    }
    ?>
