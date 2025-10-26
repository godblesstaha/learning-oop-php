<?php
$server = "localhost";
$user = "root";
$passworddb = "";
$db = "marathon";
$athleteParPage = 25;

$con = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $passworddb);

function compterAthletesParSexe($con, $sexe) {
    $stmt = $con->prepare("SELECT COUNT(*) FROM athlete WHERE sexe = ?");
    $stmt->execute([$sexe]);
    return $stmt->fetchColumn();
}


function getAthletesParSexe($con, $sexe, $depart, $limite) {
    $stmt = $con->prepare("SELECT * FROM athlete WHERE sexe = ? LIMIT $depart, $limite");
    $stmt->execute([$sexe]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function afficherTableauAthletes($athletes) {
    echo '<table class="table table-striped">';
    echo '<thead><tr>
            <th>Nom</th><th>Prénom</th><th>Âge</th>
            <th>Pays</th><th>Chrono</th>
          </tr></thead><tbody>';

    foreach ($athletes as $athlete) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($athlete['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($athlete['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($athlete['age']) . '</td>';
        echo '<td>' . htmlspecialchars($athlete['pays']) . '</td>';
        echo '<td>' . htmlspecialchars($athlete['meilleurChrono']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
}


function afficherPagination($pageCourante, $pages, $sexe) {
    echo '<nav><ul class="pagination justify-content-center">';
    for ($i = 1; $i <= $pages; $i++) {
        $active = ($i == $pageCourante) ? 'active' : '';
        echo "<li class='page-item $active'>
                <a class='page-link' href='?sexe=$sexe&page=$i'>$i</a>
              </li>";
    }
    echo '</ul></nav>';
}

$athletes = [];
$total = 0;
$pages = 0;
$pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if (isset($_POST['sexe'])) {
    $sexe = $_POST['sexe'];

} elseif (isset($_GET['sexe'])) {
    
    $sexe = $_GET['sexe'];
}

if (isset($sexe)) {
    $total = compterAthletesParSexe($con, $sexe);
    $pages = ceil($total / $athleteParPage);
    $depart = ($pageCourante - 1) * $athleteParPage;
    $athletes = getAthletesParSexe($con, $sexe, $depart, $athleteParPage);
}
else {
    $sexe = 'homme';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche par Sexe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="container mt-3">
  <a href="index.php" class="btn btn-outline-primary">
    Retour au Dashboard
  </a>
</div>
    <form action="" method="post" class="row g-3">
        <div class="col-auto">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-select">
                <option value="homme" <?php if($sexe == 'homme') { echo 'selected';} ?>>Homme</option>
                <option value="femme" <?php if ($sexe == 'femme') { echo 'selected';} ?>>Femme</option>
            </select>
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>


            <?php afficherTableauAthletes($athletes); ?>
            <?php afficherPagination($pageCourante, $pages, $sexe); ?>


</div>
</body>
</html>
