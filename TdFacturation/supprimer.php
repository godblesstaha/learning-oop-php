<?php
require "connexion.php";
$sql="DELETE FROM client WHERE idClient=?";
$stmt=$con->prepare($sql);
$id=$_GET['id'];
$stmt->execute([$id]);
header("Location: listeClients.php");
