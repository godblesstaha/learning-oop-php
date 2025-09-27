<?php
final class VoitureDeService{
    public function __construct(private $matricule){
        $this->matricule = $matricule;
    }
    public function afficherInfos(){
        echo $this->matricule;
    }
}

