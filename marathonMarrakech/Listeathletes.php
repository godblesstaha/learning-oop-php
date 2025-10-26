<?php
    $server="localhost";
    $user="root";
    $passworddb="";
    $db="marathon";
    $sexe=$_POST['sexe'];
    $sql="select * from athlete WHERE sexe='$sexe'";
    $con=new PDO("mysql:host=$server;dbname=$db",$user,$passworddb);
    $con->query($sql);
    $result=$con->query($sql);
    echo "<table border='1' class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Age</th><th>Pays</th><th>Chrono</th></tr>";
    while($tabAthlete = $result->fetch()){
        echo "<tr>";
        echo "<td>" . $tabAthlete['nom'] . "</td>";
        echo "<td>" . $tabAthlete['prenom'] . "</td>";
        echo "<td>" . $tabAthlete['age'] . "</td>";
        echo "<td>" . $tabAthlete['pays'] . "</td>";
        echo "<td>" . $tabAthlete['meilleurChrono'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
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
    <form action="" method="post" class="row g-3">
        <div class="col-auto">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-select">
                <option value="male">Male</option>
                <option value="femelle">Femelle</option>
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