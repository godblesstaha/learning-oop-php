<?php
class Voiture extends Vehicule{
    private $puissance;
    public function setPuissance($puissance){
        $this->puissance = $puissance;
    }

    public function consomation(){
        return ($this->puissance * 0.05) + 5;
    }
}
