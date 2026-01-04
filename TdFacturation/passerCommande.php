<?php
require 'connexion.php';

$idClient = $_POST['idClient'];

$dateFacture = date('Y-m-d');
$insertFacture = $con->prepare("INSERT INTO facture (dateFacture, idClient) VALUES (?, ?)");
$insertFacture->execute([$dateFacture, $idClient]);

$idFacture = $con->lastInsertId();

$articles = $con->query("SELECT * FROM factures")->fetchAll();
foreach ($articles as $article) {
    $insertDetail = $con->prepare("
        INSERT INTO details_facture (idFacture, idArticle, quantite, prixUnitaire)
        VALUES (?, ?, ?, ?)
    ");
    $insertDetail->execute([
        $idFacture,
        $article['idArticle'],
        $article['quantite'],
        $article['prixUnitaire']
    ]);
}

$con->query("DELETE FROM factures");
header("Location: articles.php");
