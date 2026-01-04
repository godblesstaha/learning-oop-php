<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: url('marathon.jpg') no-repeat center center; background-size: cover;">
     
    <div class="container text-center p-5 rounded bg-dark bg-opacity-25">
        <h1 class="text-white mb-5 fw-bold">Bienvenue sur le site du marathon</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-grid gap-3">
                    <a href="formajout.php" class="btn btn-success btn-lg fw-semibold">
                        Inscrire un nouvel athlète
                    </a>
                    <a href="afficherathlete.php" class="btn btn-primary btn-lg fw-semibold">
                        Afficher les athlètes
                    </a>
                    <a href="maj.php" class="btn btn-warning btn-lg fw-semibold">
                        Mettre à jour le chrono d'un athlète
                    </a>
                    <a href="Suppresion.php" class="btn btn-danger btn-lg fw-semibold">
                        Supprimer un athlète
                    </a>
                    <a href="resultat.php" class="btn btn-info btn-lg fw-semibold">
                        Voir les résultats du marathon
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
