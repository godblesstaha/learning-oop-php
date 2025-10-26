<?php
if(isset($_POST["filiere"])){
    $searchValue=$_POST["filiere"];

    $server="localhost";
    $user="root";
    $password="";
    $db="bts";
    $sql="SELECT * FROM etudiants WHERE filiere='$searchValue'";
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
    <title>Recherche par Filiere</title>
</head>
<body>
    <form action="" method="post">
        <select name="filiere">
            <option value="dwfs">DWFS</option>
            <option value="pme">PME</option>
            <option value="mi">MI</option>
        </select>
        <input type="submit" value="Rechercher">
    </form>
</body>
</html>