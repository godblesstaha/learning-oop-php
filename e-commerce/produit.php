<?php
require_once "donnes.class.php";
$donnes = new Donnes();

if (!isset($_GET['id'])) {
    die("Produit manquant");
}

$idArticle = intval($_GET['id']);

// Get product info
$produit = $donnes->getProduit($idArticle);
if (!$produit) {
    die("Produit introuvable");
}

// Get product images
$imagesData = $donnes->getImages($idArticle);
$mainImage = 'images/default.png'; // fallback
$galleryImages = [];
while ($img = $imagesData->fetch(PDO::FETCH_ASSOC)) {
    if ($img['principal'] === 'oui' && $mainImage === 'images/default.png') {
        $mainImage = $img['urlImage'];
    } else {
        $galleryImages[] = $img['urlImage'];
    }
}

// Get price with promotion
$prixData = $donnes->getPrix($produit['idArticle']);

// Get characteristics
$caractsData = $donnes->getCaracteristiques($idArticle);
$caracteristiques = $caractsData->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produit['libelle']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= $mainImage ?>" class="img-fluid mb-3" style="object-fit:cover; width:100%;">
            
            <?php if ($galleryImages): ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($galleryImages as $img): ?>
                        <img src="<?= $img ?>" class="img-thumbnail" style="width:80px; object-fit:cover;">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h2><?= $produit['libelle'] ?></h2>
            <p><?= nl2br($produit['description']) ?></p>

            <?php if ($prixData['oldPrice']): ?>
                <p class="text-danger fw-bold fs-4">
                    <?= number_format($prixData['prix'], 2) ?> DH
                    <span class="text-muted text-decoration-line-through fs-6">
                        <?= number_format($prixData['oldPrice'], 2) ?> DH
                    </span>
                </p>
            <?php else: ?>
                <p class="fw-bold fs-4"><?= number_format($prixData['prix'], 2) ?> DH</p>
            <?php endif; ?>

            <p><strong>Stock disponible:</strong> <?= $produit['quantiteStock'] ?></p>

            <a href="panier.php?add=<?= $produit['idArticle'] ?>" class="btn btn-primary btn-lg">Ajouter au panier</a>
        </div>
    </div>
    <?php if ($caracteristiques): ?>
        <div class="mt-5">
            <h4>Caractéristiques</h4>
            <table class="table table-bordered">
                <tbody>
                    <?php foreach ($caracteristiques as $c): ?>
                        <tr>
                            <th><?= $c['champ'] ?></th>
                            <td><?= htmlspecialchars($c['definition']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
