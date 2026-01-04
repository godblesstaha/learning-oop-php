<?php
session_start();
require 'connexion.php';
if (isset($_GET['id'])) {
    $idClient = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM client WHERE idClient = ?");
    $stmt->execute([$idClient]);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $clients = $con->query("SELECT * FROM client")->fetchAll(PDO::FETCH_ASSOC);
    $idClient = null;
}

if (!isset($_SESSION['numero_facture'])) {
    $lastId = $con->query("SELECT idFacture FROM facture ORDER BY idFacture DESC LIMIT 1")->fetchColumn();
    $nextNumber = $lastId ? $lastId + 1 : 1;
    $_SESSION['numero_facture'] = "FAC-" . date("Y") . "-" . str_pad($nextNumber, 4, "0", STR_PAD_LEFT);
}
$numero_facture = $_SESSION['numero_facture'];

$articles = $con->query("SELECT * FROM article")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle Facture</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">Création d’une Facture</h2>

    <form method="POST" action="">
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Numéro Facture</label>
                <input type="text" class="form-control" value="<?= $numero_facture ?>" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Choisir un client</label>
                <select name="idClient" class="form-select" onchange="this.form.submit()" required>
                    <option value="">-- Sélectionner un client --</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['idClient'] ?>" 
                            <?= (isset($_SESSION['client']['idClient']) && $_SESSION['client']['idClient'] == $client['idClient']) ? 'selected' : '' ?>>
                            <?= $client['nom'] . ' ' . $client['prenom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idClient'])) {
        $idClient = $_POST['idClient'];
        $stmt = $con->prepare("SELECT * FROM client WHERE idClient=?");
        $stmt->execute([$idClient]);
        $_SESSION['client'] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (isset($_SESSION['client'])):
    ?>
        <div class="alert alert-info">
            <strong>Client sélectionné :</strong>
            <?= $_SESSION['client']['nom'] . ' ' . $_SESSION['client']['prenom'] ?> —
            <?= $_SESSION['client']['adresse'] ?>
        </div>

        <h4 class="text-success mb-3">Articles disponibles</h4>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th><th>Nom</th><th>Prix (DH)</th><th>Quantité</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <form action="ajoutArticle.php" method="POST">
                            <td><?= $article['idArticle'] ?></td>
                            <td><?= $article['libelle'] ?></td>
                            <td><?= $article['prix'] ?></td>
                            <td>
                                <input type="number" name="quantite" min="1" value="1" class="form-control text-center" style="width:90px;margin:auto;">
                            </td>
                            <td>
                                <input type="hidden" name="idArticle" value="<?= $article['idArticle'] ?>">
                                <input type="hidden" name="prixUnitaire" value="<?= $article['prix'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="text-success mt-5">Articles Sélectionnés</h4>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID Article</th><th>Quantité</th><th>Prix Unitaire (DH)</th><th>Total (DH)</th><th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalGeneral = 0;
                if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])):
                    foreach ($_SESSION['panier'] as $id => $article):
                        $total = $article['quantite'] * $article['prixUnitaire'];
                        $totalGeneral += $total;
                ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $article['quantite'] ?></td>
                    <td><?= $article['prixUnitaire'] ?></td>
                    <td><?= $total ?></td>
                    <td></td>
                    <td>
                        <a href="supprimerArticle.php?id=<?= $id ?>" class="btn btn-danger btn-sm">X</a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>

        <h4 class="text-end text-primary">Total Général : <?= $totalGeneral ?> DH</h4>

        <form action="validerFacture.php" method="POST" class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">Valider la Facture</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
