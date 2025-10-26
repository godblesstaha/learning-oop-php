<?php
require 'Athlete.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$athlete = new Athlete(NULL,
                    $_POST['nom'],
                    $_POST['prenom'],
                    $_POST['sexe'],
                    $_POST['age'],
                    $_POST['pays'],
                    $_POST['heures'] . ":" . $_POST['minutes'] . ":" . $_POST['secondes'],
                    '',
                    $_POST['login'],
                    $_POST['password']);
$dossard = $athlete->ajoutAthlete();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center">
        <div class="alert alert-success shadow p-4 rounded-3" role="alert">
            <p>Vous êtes inscrit(e) avec succès.</p>
            <hr>
            <p class="mb-0 fw-bold">Votre numéro de dossard est : <span class="text-primary"><?php echo $dossard; ?></span></p>
        </div>
    </div>
</body>
</html>
<?php
}
