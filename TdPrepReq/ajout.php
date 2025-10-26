<?php
$server="localhost";
$user="root";
$password="";
$db="bts1";
$con=new PDO("mysql:host=$server;dbname=$db",$user,$password);
if($_SERVER['REQUEST_METHOD']=="POST"){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $filiere=$_POST['filiere'];
    $dateNaissance=$_POST['dateNaissance'];
    $typeBac=$_POST['typeBac'];
    $adresseEtudiants=$_POST['adresseEtudiants'];
    $sql="INSERT INTO etudiants(nomEtudiant,prenomEtudiant,filiereEtudiant,dateNaissance,typeBac,adresseEtudiants) VALUES(?,?,?,?,?,?)";
    $stmt=$con->prepare($sql);
    $stmt->execute([$nom,$prenom,$filiere,$dateNaissance,$typeBac,$adresseEtudiants]);
    header("Location: liste.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Etudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Ajouter un Étudiant</h4>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control"required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control"required>
                </div>

                <div class="mb-3">
                    <label for="filiere" class="form-label">Filière</label>
                    <select name="filiere" id="filiere" class="form-select" required>
                        <option value="DWFS">DWFS</option>
                        <option value="PME">PME</option>
                        <option value="MI">MI</option>
                        <option value="ENERGETIQUE">ENERGETIQUE</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dateNaissance" class="form-label">Date de Naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="typeBac" class="form-label">Type du Bac</label>
                    <select name="typeBac" id="typeBac" class="form-select" required>
                        <option value="Sciences Physiques">Sciences Physiques</option>
                        <option value="Sciences Math A">Sciences Math A</option>
                        <option value="Sciences Math B">Sciences Math B</option>
                        <option value="Sciences Économiques">Sciences Économiques</option>
                        <option value="Sciences de la Vie">Sciences de la Vie</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="adresseEtudiants" class="form-label">Adresse</label>
                    <input type="text" id="adresseEtudiants" name="adresseEtudiants" class="form-control"required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="liste.php" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>