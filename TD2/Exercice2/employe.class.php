<?php
class Employe{
    public function __construct(protected $nom, protected $salaire){
        $this->nom = $nom;
        $this->salaire = $salaire;
    }
    final public function getSalaireBase(){
        return $this->salaire;
    }
    public function afficherInfos(){
        echo "$this->nom | $this->salaire";
    }
}
