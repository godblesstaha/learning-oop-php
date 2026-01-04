<?php
require 'connexion.php';

if (isset($_POST['sexe'])) {
    $sexe = $_POST['sexe'];
} elseif (isset($_GET['sexe'])) {
    $sexe = $_GET['sexe'];
} else {
    $sexe = 'homme';
}
$stmt = $con->prepare("SELECT COUNT(*) FROM athlete WHERE sexe = ?");
$stmt->execute([$sexe]);
$totalAthletes = $stmt->fetchColumn();

$pages = ceil($totalAthletes / $athleteParPage);
$pageCourante = 1;

if (isset($_GET['page']) && isset($_GET['page'])) {
    $pageCourante = (int)$_GET['page'];
}

if ($pageCourante < 1) {
    $pageCourante = 1;
} elseif ($pageCourante > $pages) {
    $pageCourante = $pages;
}

$depart = ($pageCourante - 1) * $athleteParPage;
$sql = "SELECT * FROM athlete WHERE sexe = ? LIMIT $depart, $athleteParPage";
$stmt = $con->prepare($sql);
$stmt->execute([$sexe]);
$athletes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Athlètes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <form action="" method="post" class="row g-3 mb-4">
        <div class="col-auto">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-select">
                <option value="homme" <?php if ($sexe == 'homme') { echo 'selected'; } ?>>Homme</option>
                <option value="femme" <?php if ($sexe == 'femme') { echo 'selected'; } ?>>Femme</option>
            </select>
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Pays</th>
                <th>Chrono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($athletes) > 0) {
                foreach ($athletes as $athlete) {
                    echo "<tr>";
                    echo "<td>" . $athlete['nom'] . "</td>";
                    echo "<td>" . $athlete['prenom'] . "</td>";
                    echo "<td>" . $athlete['age'] . "</td>";
                    echo "<td>" . $athlete['pays'] . "</td>";
                    echo "<td>" . $athlete['meilleurChrono'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun athlète trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $prevPage = max(1, $pageCourante - 1);
    $nextPage = min($pages, $pageCourante + 1);

    function page_link($sexe, $p, $label = null, $class = '') {
        $label = $label ?? $p;
        return "<a class='page-link " . $class . "' href='?sexe=" . $sexe . "&page=" . $p . "'>" . $label . "</a>";
    }
    ?>

    <nav class="d-none d-md-block" aria-label="Pagination">
        <ul class="pagination justify-content-center flex-wrap">
            <li class="page-item <?php echo ($pageCourante == 1 ? 'disabled' : ''); ?>">
                <?php echo page_link($sexe, $prevPage, 'Précédent'); ?>
            </li>
            <?php
            if ($pages <= 9) {
                for ($i = 1; $i <= $pages; $i++) {
                    $active = ($i == $pageCourante) ? ' active' : '';
                    echo "<li class='page-item$active'>" . page_link($sexe, $i, $i) . "</li>";
                }
            } else {
                $active = (1 == $pageCourante) ? ' active' : '';
                echo "<li class='page-item$active'>" . page_link($sexe, 1, 1) . "</li>";

                if ($pageCourante > 4) {
                    echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                }

                $start = max(2, $pageCourante - 2);
                $end = min($pages - 1, $pageCourante + 2);
                for ($i = $start; $i <= $end; $i++) {
                    $active = ($i == $pageCourante) ? ' active' : '';
                    echo "<li class='page-item$active'>" . page_link($sexe, $i, $i) . "</li>";
                }

                if ($pageCourante < $pages - 3) {
                    echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                }

                $active = ($pages == $pageCourante) ? ' active' : '';
                echo "<li class='page-item$active'>" . page_link($sexe, $pages, $pages) . "</li>";
            }
            ?>
            <li class="page-item <?php echo ($pageCourante == $pages ? 'disabled' : ''); ?>">
                <?php echo page_link($sexe, $nextPage, 'Suivant'); ?>
            </li>
        </ul>
    </nav>
    <nav class="d-flex d-md-none justify-content-center align-items-center" aria-label="Pagination mobile">
        <ul class="pagination">
            <li class="page-item <?php echo ($pageCourante == 1 ? 'disabled' : ''); ?>">
                <?php echo page_link($sexe, $prevPage, '&lt;'); ?>
            </li>
            <li class="page-item disabled">
                <span class="page-link">Page <?php echo $pageCourante; ?> / <?php echo $pages; ?></span>
            </li>
            <li class="page-item <?php echo ($pageCourante == $pages ? 'disabled' : ''); ?>">
                <?php echo page_link($sexe, $nextPage, '&gt;'); ?>
            </li>
        </ul>
    </nav>

    <div class="text-end mt-4">
        <a href="index.php" class="btn btn-outline-primary">Retour au Dashboard</a>
    </div>
</div>

</body>
</html>
