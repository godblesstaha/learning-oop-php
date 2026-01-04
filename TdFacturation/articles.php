<?php
require 'connexion.php';

$select = $con->prepare("SELECT * FROM article");
$select->execute();
$articles = $select->fetchAll();

$facturesSelect = $con->prepare("
    SELECT f.idFacture, a.libelle, f.quantite, f.prixUnitaire, (f.quantite * f.prixUnitaire) AS total
    FROM factures f
    JOIN article a ON f.idArticle = a.idArticle
");
$facturesSelect->execute();
$factures = $facturesSelect->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des articles</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Articles</h1>
    <table class="table table-bordered table-hover table-striped align-middle shadow-sm">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach($articles as $article){ ?>
            <tr>
                <form action="ajoutArticle.php" method="POST">
                    <td><?= $article['idArticle']; ?></td>
                    <td><?= $article['libelle']; ?></td>
                    <td><?= $article['prix']; ?> DH</td>
                    <td>
                        <input type="number" name="quantite" min="1" value="1" class="form-control form-control-sm" style="width:80px">
                        <input type="hidden" name="idArticle" value="<?= $article['idArticle']; ?>">
                        <input type="hidden" name="prixUnitaire" value="<?= $article['prix']; ?>">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                    </td>
                </form>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2 class="mt-5 text-center text-success">Articles sélectionnés</h2>

    <table class="table table-bordered table-striped align-middle shadow-sm">
        <thead class="table-secondary text-center">
            <tr>
                <th>ID Facture</th>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach($factures as $facture){ ?>
            <tr>
                <td><?= $facture['idFacture']; ?></td>
                <td><?= $facture['libelle']; ?></td>
                <td><?= $facture['quantite']; ?></td>
                <td><?= $facture['prixUnitaire']; ?> DH</td>
                <td><?= $facture['total']; ?> DH</td>
                <td>
                    <a href="supprimerFacture.php?id=<?= $facture['idFacture']; ?>" class="btn btn-danger btn-sm" onclick="alert('Article supprimé avec succès!')">
                        <span class="iconify" data-icon="mdi:trash-can" data-width="24"></span>
                    </a>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<form action="passerCommande.php" method="POST" class="text-center mt-4">
    <label for="idClient" class="form-label">ID Client :</label>
    <input type="number" name="idClient" id="idClient" class="form-control d-inline-block" style="width:120px" required>
    <button type="submit" class="btn btn-success mt-2">Passer commande</button>
</form>
</div>
</body>
</html>
