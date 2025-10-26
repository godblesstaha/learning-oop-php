<?php
require 'Athlete.php';

if(isset($_POST['dossard']) && isset($_POST['login']) && isset($_POST['password'])){
   $athlete = new Athlete(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $_POST['login'], $_POST['password']);
   $athlete->supprimerAthlete($_POST['dossard']);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un athlète</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Suppression d'un athlète</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="dossard" >Dossard de l'athlète à supprimer</label>
            <input type="number" class="form-control" name="dossard" id="dossard" required>
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" name="login" id="login" required>
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" required>
            <input type="submit" value="Supprimer" class="btn btn-danger mt-3" onclick="alert('Athlète supprimé avec succès');">
        </div>
    </form>
</div>
</body>
</html>

