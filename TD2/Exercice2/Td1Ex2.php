<?php
require_once 'employe.class.php';
require_once 'voitureDeService.class.php';
require_once 'chefEquipe.class.php';
$employe1 = new Employe("Doe", 2500);
$employe1->afficherInfos();
echo "<br>";
$employe2 = new Employe("Smith", 3000);
$employe2->afficherInfos();
echo "<br>";
$chef1 = new ChefEquipe("Brown", "Alice", 4000, 500);
$chef1->afficherInfos();
echo "<br>";
$chef1->getSalaireTotal();
echo "<br>";
$voiture1 = new VoitureDeService("123-A-25");
$voiture1->afficherInfos();
echo "<br>";
