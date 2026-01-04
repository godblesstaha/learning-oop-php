<?php
require "fpdf186/fpdf.php";
$con = new PDO("mysql:host=localhost;dbname=ecommercedb","root","");
function enc($text) {
    return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $text);
}
$pdf = new FPDF();
$pdf->AddPage();
$stmt=$con->query("SELECT * FROM images LIMIT 1");
$photo= $stmt->fetch();
$pdf->Image($photo['urlImage'],10,10,30,30);
$pdf->SetFont("Arial","B",16);
$stmt = $con->prepare("SELECT * FROM commandes");
$stmt->execute();
$factures = $stmt->fetchAll();
$facture = $factures[0];
$idClient = 1;
$stmt1 = $con->prepare("SELECT * FROM clients WHERE idClient=?");
$stmt1->execute([$idClient]);
$client = $stmt1->fetch();
$pdf->SetFont("Arial","B",20);
$pdf->Cell(0, 10, enc("COIN_INFO"), 0, 1, "C");
$pdf->Ln(30);

$pdf->SetFont("Arial","B",16);
$pdf->Cell(0, 10, enc("Nom client : ".$client['nom']), 0, 1);
$pdf->Cell(0, 10, enc("Adresse : ".$client['adresse']), 0, 1);
$pdf->Cell(0, 10, enc("Facture numéro : ".$facture["idCommande"]), 0, 1);
$pdf->Ln(10);
$pdf->SetFont("Arial","BU",14);
$pdf->Cell(0, 10, enc("Facture"), 0, 1, "C");
$pdf->Ln(5);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(40,10,"Num Ordre",1,0,"C",true);
$pdf->Cell(40,10,enc("Désignation"),1,0,"C",true);
$pdf->Cell(40,10,"Prix",1,0,"C",true);
$pdf->Cell(40,10,enc("Quantité"),1,0,"C",true);
$pdf->Cell(40,10,"Montant",1,1,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","",9);
$stmt2 = $con->prepare("SELECT * FROM lignecommande WHERE idCommande=?");
$stmt2->execute([$facture['idCommande']]);
$lignes = $stmt2->fetchAll();
$total = 0;
foreach ($lignes as $ligne) {

    $stmt3 = $con->prepare("SELECT * FROM article WHERE idArticle=?");
    $stmt3->execute([$ligne['idArticle']]);
    $produit = $stmt3->fetch();

    $montant = $produit['prix'] * $ligne['quantite'];
    $total += $montant;

    $pdf->Cell(40,10, enc($ligne['idArticle']),1,0,"C");
    $pdf->Cell(40,10, enc($produit['libelle']),1,0,"C");
    $pdf->Cell(40,10, enc($produit['prix']." DH"),1,0,"C");
    $pdf->Cell(40,10, enc($ligne['quantite']),1,0,"C");
    $pdf->Cell(40,10, enc($montant." DH"),1,1,"C");
}
$pdf->SetFont("Arial","B",12);
$pdf->Cell(120,10,"",0,0);
$pdf->Cell(40,10, enc("TOTAL"),1,0,"C");
$pdf->Cell(40,10, enc($total." DH"),1,1,"C");

$pdf->Output();
