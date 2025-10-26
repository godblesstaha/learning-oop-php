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
$row=$stmt->fetch();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere = $_POST['filiere'];
    $dateNaissance = $_POST['dateNaissance'];
    $typeBac = $_POST['typeBac'];
    $adresseEtudiants = $_POST['adresseEtudiants'];
    $update = "UPDATE etudiants SET nomEtudiant=?, prenomEtudiant=?, filiere=?, dateNaissance=?, typeBac=?, adresseEtudiants=? WHERE matriculeEtudiant=?";
    $stmt = $con->prepare($update);
    $stmt->execute([$nom, $prenom, $filiere, $dateNaissance, $typeBac, $adresseEtudiants, $matricule]);
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
            <h4>Modifier Etudiant</h4>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $row["nomEtudiant"] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $row["prenomEtudiant"] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="filiere" class="form-label">Filière</label>
                    <select name="filiere" id="filiere" class="form-select" required>
                        <option value="DWFS" <?php if($row["filiereEtudiant"]=="DWFS") {echo "selected";}?>>DWFS</option>
                        <option value="PME" <?php if($row["filiereEtudiant"]=="PME") {echo "selected";}?>>PME</option>
                        <option value="MI" <?php if($row["filiereEtudiant"]=="MI") {echo "selected";}?>>MI</option>
                        <option value="ENERGETIQUE" <?php if($row["filiereEtudiant"]=="ENERGETIQUE") {echo "selected";}?>>ENERGETIQUE</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dateNaissance" class="form-label">Date de Naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" value="<?php echo $row["dateNaissance"] ?>" class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="typeBac" class="form-label">Type du Bac</label>
                    <select name="typeBac" id="typeBac" class="form-select" required>
                        <option value="Sciences Physiques" <?php if($row["typeBac"]=="Sciences Physiques") {echo "selected";}?>>Sciences Physiques</option>
                        <option value="Sciences Math A" <?php if($row["typeBac"]=="Sciences Math A") {echo "selected";}?>>Sciences Math A</option>
                        <option value="Sciences Math B" <?php if($row["typeBac"]=="Sciences Math B") {echo "selected";}?>>Sciences Math B</option>
                        <option value="Sciences Économiques" <?php if($row["typeBac"]=="Sciences Économiques") {echo "selected";}?>>Sciences Économiques</option>
                        <option value="Sciences de la Vie" <?php if($row["typeBac"]=="Sciences de la Vie") {echo "selected";}?>>Sciences de la Vie</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="adresseEtudiants" class="form-label">Adresse</label>
                    <input type="text" id="adresseEtudiants" name="adresseEtudiants" value="<?php echo $row["adresseEtudiants"] ?>" class="form-control"required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="liste.php" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>