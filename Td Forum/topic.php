<?php
require 'connexion.php';

$idforum = $_GET['id'];
$req = "SELECT * FROM topics WHERE idForum = ?";
$stmt = $con->prepare($req);
$stmt->execute([$idforum]);
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
