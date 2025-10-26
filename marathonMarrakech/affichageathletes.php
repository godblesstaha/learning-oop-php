<?php
$server = "localhost";
$user = "root";
$passworddb = "";
$db = "marathon";
$athleteParPage = 25;

$con = new PDO("mysql:host=$server;dbname=$db", $user, $passworddb);

$sexe = isset($_GET['sexe']) ? $_GET['sexe'] : 'homme';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcul du décalage
$debut = ($page - 1) * $athleteParPage;

// Requête avec pagination
$sql = "SELECT * FROM athlete WHERE sexe = :sexe LIMIT $debut, $athleteParPage";
$stmt = $con->prepare($sql);
$stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();

// Calcul des pages
$total = $con->query("SELECT COUNT(*) FROM athlete WHERE sexe = '$sexe'")->fetchColumn();
$totalPages = ceil($total / $athleteParPage);

// Affichage du tableau
echo "<table class='table table-striped'>";
echo "<tr><th>Nom</th><th>Prenom</th><th>Age</th><th>Pays</th><th>Chrono</th></tr>";
foreach ($result as $tabAthlete) {
    echo "<tr>";
    echo "<td>" . $tabAthlete['nom'] . "</td>";
    echo "<td>" . $tabAthlete['prenom'] . "</td>";
    echo "<td>" . $tabAthlete['age'] . "</td>";
    echo "<td>" . $tabAthlete['pays'] . "</td>";
    echo "<td>" . $tabAthlete['meilleurChrono'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Pagination
if ($totalPages > 0) {
    echo '<nav><ul class="pagination">';
    
    // Pages numériques
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        echo "<li class='page-item $active'>";
        echo "<a class='page-link' href='?sexe=$sexe&page=$i'>$i</a>";
        echo "</li>";
    }
    
}

// Formulaire
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche par Sexe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="get" class="row g-3">
        <div class="col-auto">
            <label class="form-label">Sexe</label>
            <select name="sexe" class="form-select">
                <option value="homme" ' . (($sexe == 'homme') ? 'selected' : '') . '>Homme</option>
                <option value="femme" ' . (($sexe == 'femme') ? 'selected' : '') . '>Femme</option>
            </select>
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
</div>
</body>
</html>';
?>