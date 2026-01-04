<?php
require_once 'donnes.class.php';
$donnes = new Donnes();

$categories = $donnes->getCategories();
$pubs = $donnes->getPublicites();
$nouveauxProduits = $donnes->getNouveauxProduits();
$promotions = $donnes->getPromotions();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid p-0">
    <?php while ($p = $pubs->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="mb-3">
            <img src="<?= $p['url']; ?>"
                 class="img-fluid w-100"
                 style="object-fit: cover; border-radius: 10px;"
                 alt="Publicité">
        </div>
    <?php endwhile; ?>
</div>

<div class="container">
    <section class="categories mb-5">
        <h2 class="mb-3">Catégories</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($categories as $cat): ?>
                <div class="col">
                    <a href="categorie.php?id=<?= $cat['idCategorie']; ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="card-title"><?= $cat['categorie']; ?></h5>
                                <p class="card-text"><?= $cat['description']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

    <section class="nouveaux-produits mb-5">
        <h2 class="mb-3">Nouveaux Produits</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($nouveauxProduits as $prod): ?>
                <?php $prix = $donnes->getPrix($prod['idArticle']); ?>

                <div class="col">
                    <div class="card h-100">
                        <img src="<?= $prod['urlImage']; ?>" class="card-img-top" style="object-fit:cover;">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $prod['libelle']; ?></h5>
                            <?php if ($prix['oldPrice']): ?>
                                <p class="card-text text-danger">
                                    <s><?= $prix['oldPrice']; ?> DH</s>
                                </p>
                                <p class="card-text fw-bold"><?= $prix['prix']; ?> DH</p>
                            <?php else: ?>
                                <p class="card-text fw-bold"><?= $prix['prix']; ?> DH</p>
                            <?php endif; ?>

                            <a href="produit.php?id=<?= $prod['idArticle']; ?>" 
                               class="btn btn-primary mt-auto">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </section>
    <section class="promotions mb-5">
        <h2 class="mb-3">Promotions</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($promotions as $promo): ?>
                <?php $prix = $donnes->getPrix($promo['idArticle']); ?>

                <div class="col">
                    <div class="card h-100 border-success">
                        <img src="<?= $promo['urlImage']; ?>" 
                             class="card-img-top" 
                             style="object-fit:cover;">

                        <div class="card-body">

                            <h5 class="card-title"><?= $promo['libelle']; ?></h5>
                            <p class="text-danger"><s><?= $prix['oldPrice']; ?> DH</s></p>
                            <p class="fw-bold text-success"><?= $prix['prix']; ?> DH</p>

                            <a href="produit.php?id=<?= $promo['idArticle']; ?>" 
                               class="btn btn-primary w-100">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </section>

</div>

</body>
</html>
