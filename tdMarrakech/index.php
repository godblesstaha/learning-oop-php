<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Marathon de Marrakech</a>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="mb-4 text-primary fw-bold">
            Bienvenue sur le site officiel du Marathon de Marrakech
        </h1>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="list-group shadow">
                    <a href="afficherathlete.php" class="list-group-item list-group-item-action list-group-item-primary fw-semibold">
                        Afficher les athlètes
                    </a>
                    <a href="maj.php" class="list-group-item list-group-item-action list-group-item-warning fw-semibold">
                        Mettre à jour le chrono d'un athlète
                    </a>
                    <a href="Suppresion.php" class="list-group-item list-group-item-action list-group-item-danger fw-semibold">
                        Supprimer un athlète
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
