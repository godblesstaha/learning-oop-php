<?php
require_once "donnes.class.php";
$donnes = new Donnes();

if (!isset($_GET['id'])) {
    die("Catégorie manquante");
}

$idCat = intval($_GET['id']);
$produits = $donnes->getProduitsByCategorie($idCat);
$categories = $donnes->getCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">Produits de la catégorie</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($p = $produits->fetch(PDO::FETCH_ASSOC)): ?>

            <?php 
                $prixData = $donnes->getPrix($p['idArticle']);
                $image = $p['urlImage'] ?: 'images/default.png'; // fallback image
            ?>

            <div class="col">
                <div class="card h-100 shadow-sm">

                    <img src="<?= $image ?>" 
                         class="card-img-top" 
                         style="object-fit:cover;">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['libelle']) ?></h5>
                        
                        <?php if ($prixData['oldPrice']): ?>
                            <p class="text-danger fw-bold mb-2">
                                <?= number_format($prixData['prix'], 2) ?> DH
                                <span class="text-muted text-decoration-line-through fs-6">
                                    <?= number_format($prixData['oldPrice'], 2) ?> DH
                                </span>
                            </p>
                        <?php else: ?>
                            <p class="fw-bold mb-2"><?= number_format($prixData['prix'], 2) ?> DH</p>
                        <?php endif; ?>

                        <a href="produit.php?id=<?= $p['idArticle'] ?>" 
                           class="btn btn-primary w-100">
                            Ajouter au panier
                        </a>
                    </div>

                </div>
            </div>

        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
