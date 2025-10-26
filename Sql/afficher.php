<?php
    $server="localhost";
    $user="root";
    $password="";
    $db="bts";
    $sql="SELECT * FROM etudiants";
    $con=new mySQLi($server,$user,$password,$db);
    $result=$con->query($sql);
    //boucle de parcours
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