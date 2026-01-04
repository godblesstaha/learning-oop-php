<?php
session_start();
require 'connexion.php';

if (!isset($_SESSION['client'], $_SESSION['numero_facture'], $_SESSION['panier'])) {
    die("Erreur : données manquantes !");
}

try {
    $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO facture (numeroFacture, dateFacture, regle, idClient)
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['numero_facture'],
        date("Y-m-d"),
        0,
        $_SESSION['client']['idClient']
    ]);

    $idFacture = $con->lastInsertId();

    $stmtDetail = $con->prepare("INSERT INTO factures (idArticle, quantite, prixUnitaire, idFacture)
                                 VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['panier'] as $idArticle => $ligne) {
        $stmtDetail->execute([$idArticle, $ligne['quantite'], $ligne['prixUnitaire'], $idFacture]);
    }

    $con->commit();

    unset($_SESSION['numero_facture'], $_SESSION['panier'], $_SESSION['client']);

    echo "<div style='text-align:center;margin-top:50px;'>
            <h2 style='color:green;'>Facture enregistrée avec succès</h2>
            <a href='ajoutFactureForm.php' class='btn btn-primary mt-3'>Nouvelle Facture</a>
          </div>";
} catch (Exception $e) {
    $con->rollBack();
    echo "Erreur : " . $e->getMessage();
}
?>
