<?php
require("fpdf186/fpdf.php");

try {
    $con = new PDO(
        "mysql:host=localhost;dbname=ecommercedb",
        "root",
        "",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$stmt = $con->prepare("SELECT nom, adresse, dateAbn FROM clients");
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

class PDF extends FPDF
{
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}
$pdf = new PDF();
$pdf->SetFont("Arial","",12);

$clientsParPage = 3;
$compteur = 0;

foreach ($clients as $client) {

    if ($compteur % $clientsParPage == 0) {
        $pdf->AddPage();
        $pdf->SetFont("Arial","B",16);
        $pdf->Cell(0,10,"Liste des Clients",0,1,"C");
        $pdf->Ln(5);
        $pdf->SetFont("Arial","",12);
    }

    $pdf->Cell(40,8,"Nom :",0,0);
    $pdf->Cell(0,8,$client["nom"],0,1);

    $pdf->Cell(40,8,"Adresse :",0,0);
    $pdf->MultiCell(0,8,$client["adresse"]);

    $pdf->Cell(40,8,"Date Abonnement :",0,0);
    $pdf->Cell(0,8,$client["dateAbn"],0,1);

    $pdf->Ln(5);

    $compteur++;
}
$pdf->Output();
?>
