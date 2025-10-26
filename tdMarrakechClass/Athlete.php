<?php
class Athlete
{
    public $SERVEUR="localhost";
    public $USER="root";
    public $PASSWORDDB="";
    public $DB="marathon";

    public function __construct(private $dossard,
    private $nom,
    private $prenom,
    private $sexe,
    private $age,
    private $pays,
    private $meilleurChrono,
    private $chrono,
    private $login,
    private $passWord){
        //constructeur
    }
    // les getters
    public function getDossard()
    {
        return $this->dossard;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function getMeilleurChrono()
    {
        return $this->meilleurChrono;
    }

    public function getChrono()
    {
        return $this->chrono;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassWord()
    {
        return $this->passWord;
    }
    //les setters
    public function setDossard($dossard)
    {
        $this->dossard = $dossard;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    public function setMeilleurChrono($meilleurChrono)
    {
        $this->meilleurChrono = $meilleurChrono;
    }

    public function setChrono($chrono)
    {
        $this->chrono = $chrono;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
    }
    //les methodes

    public function ajoutAthlete(){
        
        $sql="INSERT INTO athlete VALUES(?,?,?,?,?,?,?,?,?,?)";
        $con = new PDO("mysql:server=$this->SERVEUR;dbname=$this->DB",$this->USER,$this->PASSWORDDB);
        $stmt=$con->prepare($sql);
        $stmt->execute([$this->dossard,
        $this->nom,
        $this->prenom,
        $this->sexe,
        $this->age,
        $this->pays,
        $this->meilleurChrono,
        $this->chrono,
        $this->login,
        $this->passWord]);

        return $con->lastInsertId();
    }

    public function supprimerAthlete($dossard){
        $sql="DELETE FROM athlete WHERE login='$this->login' AND passWord='$this->passWord'";
        $con = new PDO("mysql:server=$this->SERVEUR;dbname=$this->DB",$this->USER,$this->PASSWORDDB);
        $stmt=$con->prepare($sql);
        $stmt->execute();
    }

}
