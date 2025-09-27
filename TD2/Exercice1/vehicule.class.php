<?php
abstract class Vehicule{
    protected $marque;
    protected $modele;
    protected $annee;
    
    public function __construct($marque,$modele,$annee){
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
    }
    abstract public function consomation();

    public function afficherInfos(){
        echo $this->marque . "|" . $this->modele . "|" . $this->annee . "|" . consomation();
    }
}
