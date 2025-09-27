<?php
class Camion extends Vehicule{
    private $tonnage;
    public function setTonnage($tonnage){
        $this->tonnage = $tonnage;
    }

    public function consomation(){
        return ($this->tonnage * 0.8) + 15;
    }
}
