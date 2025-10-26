<?php
$server="localhost";
$user="root";
$password="";
$db="bts1";
$con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
$matricule=$_GET['matricule'];
$sql="SELECT * FROM etudiants WHERE matriculeEtudiant=?";
$stmt=$con->prepare($sql);
$stmt->execute([$matricule]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Etudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php $row=$stmt->fetch(); ?>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center">
                <h2>Détails de l'Étudiant</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="text-secondary">Matricule :</h5>
                    <p class="fw-bold"><?php echo $matricule; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Nom :</h5>
                    <p class="fw-bold"><?php echo $row['nomEtudiant']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Prenom :</h5>
                    <p class="fw-bold"><?php echo $row['prenomEtudiant']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Filière :</h5>
                    <p class="fw-bold"><?php echo $row['filiereEtudiant']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Date de Naissance :</h5>
                    <p class="fw-bold"><?php echo $row['dateNaissance']; ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Type de Bac :</h5>
                    <p class="fw-bold"><?php echo htmlspecialchars($row['typeBac']); ?></p>
                </div>

                <div class="mb-3">
                    <h5 class="text-secondary">Adresse :</h5>
                    <p class="fw-bold"><?php echo htmlspecialchars($row['adresseEtudiants']); ?></p>
                </div>
            </div>

            <div class="card-footer text-center">
                <a href="liste.php" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>

</body>
</html>