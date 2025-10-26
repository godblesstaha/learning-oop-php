<?php
    if(isset($_POST["recherche"])){
    $searchValue=$_POST["recherche"];

    $server="localhost";
    $user="root";
    $password="";
    $db="bts";
    $sql="SELECT * FROM etudiants WHERE idEtudiant='$searchValue' ";//or nom='$searchValue' or prenom='$searchValue' or filiere='$searchValue'
    $con=new mySQLi($server,$user,$password,$db);
    $result=$con->query($sql);
    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Filière</th></tr>";

    while($tabEtudiants = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $tabEtudiants['nom'] . "</td>";
        echo "<td>" . $tabEtudiants['prenom'] . "</td>";
        echo "<td>" . $tabEtudiants['filiere'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
</head>
<body>
    <form method="POST" action="">
        <label>Recherche par ID</label>
        <input type="text" name="recherche">
        <input type="submit" value="Chercher">
    </form>
</body>
</html>