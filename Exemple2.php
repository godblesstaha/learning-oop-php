<?php
// class Etudiant{
//     private $nom;
//     private $prenom;
//     private $numMassar;
//     public function __construct($no,$pre,$numMas){
//         $this->nom = $no;
//         $this->prenom = $pre;
//         $this->numMassar = $numMas;
//     }
//     public function getNom(){
//         return $this->nom;
//     }
// }
// $etud1 = new Etudiant("Ahmad","ALAOUI","A12345");
// echo $etud1->getNom();
// class Etudiant{
//     public function __construct(private $nom,private $prenom,private $numMassar){

//     } 
//     public function getNom(){
//         return $this->nom;
//     }
// }
// $etud1 = new Etudiant("Ali","ALAOUI","A12345");
// echo $etud1->getNom();
class Etudiant{
    const FILIERE='DWFS';
    public $nom;
    public $prenom;
    private static $nbreEtudiant;
    public function __construct($no,$pr){
        $this->nom = $no;
        $this->prenom = $pre;
        self::$nbreEtudiant++;
    }
    public static getNbreEtudiant(){
        return self::nbreEtudiant;
    }
}
$et1=new Etudiant("EL OMARI","Taha");
echo Etudiant::getNbrEtudiant();
