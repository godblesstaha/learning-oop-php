<?php
session_start();

$idArticle = $_POST['idArticle'];
$quantite = $_POST['quantite'];
$prixUnitaire = $_POST['prixUnitaire'];

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_SESSION['panier'][$idArticle])) {
    $_SESSION['panier'][$idArticle]['quantite'] += $quantite;
} else {
    $_SESSION['panier'][$idArticle] = [
        'quantite' => $quantite,
        'prixUnitaire' => $prixUnitaire
    ];
}

header("Location: ajoutFactureForm.php");
?>
