<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Marathon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Inscription Marathon</h2>
    <form action="ajout.php" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sexe</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sexe" id="sexeM" value="homme" required>
                <label class="form-check-label" for="sexeM">Masculin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sexe" id="sexeF" value="femme">
                <label class="form-check-label" for="sexeF">Féminin</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="age" required>
        </div>

        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" name="pays" id="pays" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Votre meilleur temps de marathon</label>
            <div class="d-flex gap-2">
                <input type="number" class="form-control" name="heures" min="0" max="10" placeholder="heures" required>
                <span class="align-self-center">:</span>
                <input type="number" class="form-control" name="minutes" min="0" max="59" placeholder="minutes" required>
                <span class="align-self-center">:</span>
                <input type="number" class="form-control" name="secondes" min="0" max="59" placeholder="secondes" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" name="login" id="login" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
<div class="text-end mt-4">
        <a href="index.php" class="btn btn-outline-primary">Retour au Dashboard</a>
    </div>

</body>
</html>