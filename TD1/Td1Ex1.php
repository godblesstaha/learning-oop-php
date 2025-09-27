<?php
class Personne{
    
    //Constructeur
    public function __construct(
    protected $nom,
    protected $prenom,
    protected $dateNaissance,
    protected $tel){
    }
    //aficher les infos formatees de la personne
    public function afficherInfos(){

        echo "<table>";
       echo "<tr><th>Nom</th><th>Prenom</th><th>Date de naissance</th><th>Telephone</th></tr>";
       echo "<tr>";
       echo "<td>" . $this->nom . "</td>";
       echo "<td>" . $this->prenom . "</td>";
       echo "<td>" . $this->dateNaissance . "</td>";
       echo "<td>" . $this->tel . "</td>";
       echo "</tr>";
       echo "</table>";
    }
}
class Etudiant extends Personne{
    public function __construct(private $dateInscription,
    private $filiere,
    private $typeBac){
    }
    //Setters d'Etudiant
    public function setDateInscription($dateIns){
        $this->dateInscription = $dateIns;
    }
    public function setFiliere($fil){
        $this->filiere = $fil;
    }
    public function setTypeBac($type){
        $this->typeBac = $type;
    }
    //Affichage d'etudiant
    public function afficherInfos(){
       echo "<table>";
       echo "<tr><th>Date d'inscription</th><th>Filière</th><th>Type de Bac</th></tr>";
       echo "<tr>";
       echo "<td>" . $this->dateInscription . "</td>";
       echo "<td>" . $this->filiere . "</td>";
       echo "<td>" . $this->typeBac . "</td>";
       echo "</tr>";
       echo "</table>";
    }
}
class Professeur extends Personne{
    private $specialite;
    private $dateEmbauche;
    private $matiere;
    private $masseHoraire;
    public function __construct($nom,$prenom,$dateNaissance,$tel,$specialite,$dateEmbauche,$matiere,$masseHoraire){
        parent::__construct($nom,$prenom,$dateNaissance,$tel);
        $this->specialite=$specialite;
        $this->dateEmbauche=$dateEmbauche;
        $this->matiere=$matiere;
        $this->masseHoraire=$masseHoraire;
    }
    //Setters de Professeur
    public function setSpecialite($spec){
        $this->specialite = $spec;
    }
    public function setDateEmbauche($dateEmb){
        $this->dateEmbauche = $dateEmb;
    }
    public function setMatiere($mat){
        $this->matiere = $mat;
    }
    public function setMasseHoraire($masseH){
        $this->masseHoraire = $masseH;
    }
    //Redefinition de affichageInfos
    public function afficherInfos(){
       parent::afficherInfos();
       echo "<table>";
       echo "<tr><th>Spécialité</th><th>Date d'embauche</th><th>Matière</th><th>Masse Horaire</th></tr>";
       echo "<tr>";
       echo "<td>" . $this->specialite . "</td>";
       echo "<td>" . $this->dateEmbauche . "</td>";
       echo "<td>" . $this->matiere . "</td>";
       echo "<td>" . $this->masseHoraire . "</td>";
       echo "</tr>";
       echo "</table>";
    }
}
// Instentiation des objts
$et1 = new Etudiant("22/09/2025","DWFS","Sciences Maths");
$et1->afficherInfos();
echo "<br>";
$prof1 = new Professeur("PHP","09/09/1994","Programmation Web","24 heurs");
$prof1->afficherInfos();
?>
<html>
    <head>
        <title>
            Page du TD Clesses
        </title>
        <style>
            table,th,td{
                border: black solid 1px;
            }
        </style>
    </head>
</html>