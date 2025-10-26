<?php
$server="localhost";
$user="root";
$password="";
$db="bts";
$con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Test des operateurs</title>
</head>
<body>
    <h1>La moyenne des moyennes des etudiants:</h1>
    <?php
    $sql="SELECT AVG(moyenne) AS moyenneGenerale FROM etudiants WHERE bourse=1";
    $result=$con->query($sql);
    $row=$result->fetch();
    echo "<h2>".$row['moyenneGenerale']."</h2>";
    ?>
    <h1>Le nombre d'etudiants dans Informatique:</h1>
    <?php
    $sql="SELECT COUNT(*) AS nbEtudiants FROM etudiants WHERE filiere='Informatique'";
    $result=$con->query($sql);
    $row=$result->fetch();
    echo "<h2>".$row['nbEtudiants']."</h2>";
    ?>
    <h1>Le nombre de villes :</h1>
    <?php
    $sql="SELECT COUNT(DISTINCT ville) AS nbVilles FROM etudiants";
    $result=$con->query($sql);
    $row=$result->fetch();
    echo "<h2>".$row['nbVilles']."</h2>";
    ?>
    <h1>Moyenne Generele des eleves en Gestion</h1>
    <?php
    $sql="SELECT AVG(moyenne) AS moyenneGeneraleGestion FROM etudiants WHERE filiere='Gestion'";
    $result=$con->query($sql);
    $row=$result->fetch();
    echo "<h2>".$row['moyenneGeneraleGestion']."</h2>";
    ?>
    <h1>Liste de gens avec la lettre B:</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE nom LIKE 'B%'";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Moyenne</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['moyenne']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Liste de gens avec "ba":</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE nom LIKE '%ba%'";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Moyenne</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['moyenne']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Liste d'Informatique et Miage:</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE filiere IN ('Informatique','Miage')";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Moyenne</th><th>filiere</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['moyenne']."</td>";
        echo "<td>".$row['filiere']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Liste de non Informatique et non Miage:</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE filiere NOT IN ('Informatique','Miage')";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Moyenne</th><th>filiere</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['moyenne']."</td>";
        echo "<td>".$row['filiere']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Moyenne non saisie</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE moyenne IS NULL";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>filiere</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['filiere']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Moyenne entre 12 et 16</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE moyenne BETWEEN 12 AND 16";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Moyenne</th><th>filiere</th><th>Ville</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['moyenne']."</td>";
        echo "<td>".$row['filiere']."</td>";
        echo "<td>".$row['ville']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Les etudiants ayant entre 25 et 23 ans</h1>
    <?php
    $sql="SELECT * FROM etudiants WHERE dateNaissance BETWEEN '2000-01-01' AND '2002-12-31'";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Date de Naissance</th>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['dateNaissance']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    ?>
    <h1>Les filieres et leur nombre d'etudiants:</h1>
    <?php
    $sql="SELECT filiere, COUNT(*) AS nbEtudiants , AVG(moyenne) AS moyenneGenerale FROM etudiants GROUP BY filiere";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Filiere</th><th>Nombre d'etudiants</th><th>Moyenne Generale</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['filiere']."</td>";
        echo "<td>".$row['nbEtudiants']."</td>";
        echo "<td>".$row['moyenneGenerale']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h1>Ville et nombre de boursiers</h1>
    <?php
    $sql="SELECT ville, COUNT(*) AS nbBoursiers FROM etudiants WHERE bourse=1 GROUP BY ville";
    $result=$con->query($sql);
    echo "<table class='table table-striped'>";
    echo "<tr><th>Ville</th><th>Nombre</th></tr>";
    while($row=$result->fetch()){
        echo "<tr>";
        echo "<td>".$row['ville']."</td>";
        echo "<td>".$row['nbBoursiers']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    
    <!-- $sql="DELETE FROM etudiants WHERE filiere IN "; -->
</body>
</html>