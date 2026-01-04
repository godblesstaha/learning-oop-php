<?php
require "connexion.php";
$id=$_GET['id'];
$select=$con->prepare("DELETE FROM factures WHERE idFacture=?");
$select->execute([$id]);
header("Location: articles.php");
