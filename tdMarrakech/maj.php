<?php
$server = "localhost";
$user = "root";
$passworddb = "";
$db = "marathon";

$con = new PDO("mysql:host=$server;dbname=$db", $user, $passworddb);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dossard'])) {
        foreach ($_POST['dossard'] as $index => $dossard) {
            $heures = trim($_POST['heures'][$index]);
            $minutes = trim($_POST['minutes'][$index]);
            $secondes = trim($_POST['secondes'][$index]);

            if ($heures === '' && $minutes === '' && $secondes === '') {
                $chrono = null;
            } else {
                $chrono = $heures . ":" . $minutes . ":" . $secondes;
            }

            $sql = "UPDATE athlete SET chrono = ?, rempli = 1 WHERE dossard = ?";
            $stmt = $con->prepare($sql);
            $stmt->execute([$chrono, $dossard]);
        }
    }
}
$athletesParPage = 10;
$sql = "SELECT * FROM athlete WHERE rempli = 0 LIMIT $athletesParPage";
$result = $con->query($sql);
$athletes = $result->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du chrono</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Mise à jour du chrono</h2>

    <form method="post" action="maj.php">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Dossard</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Heures</th>
                    <th>Minutes</th>
                    <th>Secondes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($athletes as $athlete) { ?>
                    <tr>
                        <td>
                            <?php echo $athlete['dossard']; ?>
                            <input type="hidden" name="dossard[]" value="<?php echo $athlete['dossard']; ?>">
                        </td>
                        <td><?php echo $athlete['nom']; ?></td>
                        <td><?php echo $athlete['prenom']; ?></td>
                        <td><?php echo $athlete['sexe']; ?></td>
                        <td><input type="number" class="form-control" name="heures[]" min="0" max="9"></td>
                        <td><input type="number" class="form-control" name="minutes[]" min="0" max="59"></td>
                        <td><input type="number" class="form-control" name="secondes[]" min="0" max="59"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
    <div class="text-end mt-4">
        <a href="index.php" class="btn btn-outline-primary">Retour au Dashboard</a>
    </div>
</div>

</body>
</html>
