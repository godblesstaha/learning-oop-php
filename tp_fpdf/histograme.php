<?php
require "fpdf186/fpdf.php";
$pdf = new FPDF();
$pdf->AddPage();

$produits = [
    "Ordinateurs bureau" => 120,
    "Ordinateurs portables" => 130,
    "Imprimantes" => 150,
    "Scanners" => 100,
    "Routeurs" => 190,
    "Switchs" => 120,
    "Tablettes graphiques" => 150,
    "Logiciels" => 140
];
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'TOTAL DES VENTES',0,1,'C');

$hautZone=150;
$largeZone=150;
$valMax=max($produits);
$echelle=$hautZone/$valMax;
$largeBat=$largeZone/count($produits);
$margTop=50;
$margLeft=50;
$dx=$margLeft;
foreach ($produits as $product => $prix) {
    c:\Users\HP\Desktop\Faraji\codes
    $hautBat=$prix*$echelle;
    $pdf->rect($dx,($hautZone+$margTop)-$hautBat,$largeBat,$hautBat);
    $dx+=$largeBat;
}
$pdf->Output();