<?php
$server="localhost";
$user="root";
$password="";
$db="bts1";
$con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes BTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Liste des Étudiants BTS</h1>

    <div class="mb-3 text-end">
        <a href="ajout.php" class="btn btn-primary">
            <span class="iconify" data-icon="mdi:account-plus" data-width="20"></span> Nouveau
        </a>
    </div>

    <table class="table  table-bordered shadow-sm">
        <thead class="table-dark text-center">
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Filière</th>
                <th>Details</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="text-center">
        <?php
        $sql = "SELECT * FROM etudiants";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
        ?>
            <tr>
                <td><?php echo $row['matriculeEtudiant']; ?></td>
                <td><?php echo $row['nomEtudiant']; ?></td>
                <td><?php echo $row['prenomEtudiant']; ?></td>
                <td><?php echo $row['filiereEtudiant']; ?></td>
                <td>
                    <a href="details.php?matricule=<?php echo $row['matriculeEtudiant']; ?>" class="text-info">
                        <span class="iconify" data-icon="mdi:eye" data-width="24"></span>
                    </a>
                </td>
                <td>
                    <a href="modifier.php?matricule=<?php echo $row['matriculeEtudiant']; ?>" class="text-secondary">
                        <span class="iconify" data-icon="mdi:pencil" data-width="24"></span>
                    </a>
                </td>
                <td>
                    <a href="supprimer.php?matricule=<?php echo $row['matriculeEtudiant']; ?>" class="text-danger" onclick="alert('Voulez-vous vraiment supprimer cet etudiant ?')">
                        <span class="iconify" data-icon="mdi:trash-can" data-width="24"></span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
</html>
