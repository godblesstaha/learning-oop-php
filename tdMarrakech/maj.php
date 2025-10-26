<?php
$sever="localhost";
$user="root";
$passworddb="";
$db="marathon";
$con=new PDO("mysql:host=$sever;dbname=$db",$user,$passworddb);
if(isset($_POST['dossard']) && isset($_POST['heures']) && isset($_POST['minutes']) && isset($_POST['secondes'])){
    $dossard=$_POST['dossard'];
    $heures=$_POST['heures'];
    $minutes=$_POST['minutes'];
    $secondes=$_POST['secondes'];
    $chrono=$_POST['heures'] . ":" . $_POST['minutes'] . ":" . $_POST['secondes'];
    $sql="UPDATE athlete SET chrono='$chrono' WHERE dossard='$dossard'";
    $con->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise a jour du Chrono</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Mise a jour du Chrono</h2>
    <form action="maj.php" method="post">
        <div class="mb-3">
            <label for="dossard" class="form-label">Dossard de l'athlète</label>
            <input type="number" class="form-control" name="dossard" id="dossard" required>
            <div class="mb-3">
            <label for="chrono">Chrono:</label>
            <div class="d-flex gap-2">
                <input type="number" class="form-control" name="heures" min="0" max="10" placeholder="heures" required>
                <span class="align-self-center">:</span>
                <input type="number" class="form-control" name="minutes" min="0" max="59" placeholder="minutes" required>
                <span class="align-self-center">:</span>
                <input type="number" class="form-control" name="secondes" min="0" max="59" placeholder="secondes" required>
            </div>
            <input type="submit" value="Mettre à jour" class="btn btn-primary mt-3">
        </div>
    </form>
</div>
</body>
</html>
