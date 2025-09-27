<?php
class ChefEquipe extends Employe{
    private $prime;
    public function __construct($nom, $prenom, $salaire, $prime){
        parent::__construct($nom, $prenom, $salaire);
        $this->prime = $prime;
    }
    public function getSalaireBase($prime){
        parent::getSalaireBase();
        return parent::$salaire;
    }
    public function getSalaireTotal(){
        echo $this->salaire + $this->prime;
    }
}
