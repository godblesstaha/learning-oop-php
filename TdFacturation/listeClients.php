<?php
require 'connexion.php';
$select=$con->prepare("SELECT * FROM client");
$select->execute();
$clients=$select->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body class="bg-light">

  <div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Liste des Clients</h1>

    <table class="table table-bordered table-hover table-striped align-middle shadow-sm">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Détails</th>
          <th>Modifier</th>
          <th>Supprimer</th>
          <th>Ajouter Facture</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach($clients as $client){ ?>
        <tr>
          <td><?= $client['idClient']; ?></td>
          <td><?= $client['nom']; ?></td>
          <td><?= $client['prenom']; ?></td>
          <td><?= $client['adresse']; ?></td>
          <td>
            <a href="details.php?id=<?= $client['idClient']; ?>" class="btn btn-info btn-sm">
              <iconify-icon icon="mdi:information-outline"></iconify-icon>
            </a>
          </td>
          <td>
            <a href="modifierForm.php?id=<?= $client['idClient']; ?>" class="btn btn-warning btn-sm">
              <iconify-icon icon="mdi:pencil-outline"></iconify-icon>
            </a>
          </td>
          <td>
            <a href="supprimer.php?id=<?= $client['idClient']; ?>" class="btn btn-danger btn-sm" onclick="alert('Client supprimé avec succès!')">
              <iconify-icon icon="mdi:delete-outline"></iconify-icon>
            </a>
          </td>
          <td>
            <a href="ajoutFactureForm.php?id=<?= $client['idClient']; ?>" class="btn btn-success btn-sm">
              <iconify-icon icon="mdi:plus-box-outline"></iconify-icon>
            </a>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
