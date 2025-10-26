<?php
$server="localhost";
$user="root";
$password="";
$db="newdb";
$con=new PDO("mysql:server=$server;dbname=$db",$user,$password);
$con->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
$con->beginTransaction();
// $montantCheque=500;
// $stmt1="UPDATE comptes SET solde=solde-? WHERE idCompte=1";
// $prep1=$con->prepare($stmt1);
// $prep1->execute([$montantCheque]);
// $stmt2="UPDATE comptes SET solde=solde+? WHERE idCompte=2";
// $prep2=$con->prepare($stmt2);
// $prep2->execute([$montantCheque]);
// $ok=true;
// if(!$stmt1 OR !$stmt2){
//     $ok=false;
// }
// if($ok){
//     $con->commit();
//     echo "Transaction validée";
// }else{
//     $con->rollBack();
//     echo "Transaction annulée";
// }
$idClient = 1;
$stmt1="INSERT INTO commandes (dateCmd,idClient) Values(?,?)";
$prep1=$con->prepare($stmt1);
$ok1=$prep1->execute(["2025-10-16",$idClient]);
$idCmd=$con->lastInsertId();
$stmt2="INSERT INTO detailsCmd (libelle, prix, qte, idCmd) Values(?,?,?,?)";
$prep2=$con->prepare($stmt2);
$ok2=true;
$prep2->execute(["Ordinateur", 500, 2, $idCmd]);

if($ok1 && $ok2){
    $con->commit();
    echo "Transaction validee";
}else{
    $con->rollBack();
    echo "Transaction annulee";
}

