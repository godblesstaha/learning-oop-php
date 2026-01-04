<?php
require "connexion.php";
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
    <title>Modifier le client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <div class="container mt-5">
        <div class="card shadow-lg mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Modifier le client</h4>
            </div>
            <div class="card-body">
                <form method="post" action="modifier.php?id=<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $client["nom"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $client["prenom"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" value="<?php echo $client["adresse"] ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="listeClients.php" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
