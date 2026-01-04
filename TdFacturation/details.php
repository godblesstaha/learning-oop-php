<?php
require 'connexion.php';
$id=$_GET['id'];
$select=$con->prepare("SELECT * FROM client WHERE idClient=?");
$select->execute([$id]);
$client=$select->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details du client</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center">
                <h2>Détails du client</h2>
            </div>
            <div class>

            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="text-secondary">ID:<h5>
                    <p class="fw-bold"><?php echo $id; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Nom :</h5>
                    <p class="fw-bold"><?php echo $client['nom']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Prenom :</h5>
                    <p class="fw-bold"><?php echo $client['prenom']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Adresse :</h5>
                    <p class="fw-bold"><?php echo $client['adresse']; ?></p>
                </div>

            <div class="card-footer text-center">
                <a href="listeClients.php" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>