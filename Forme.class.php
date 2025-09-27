<?php
abstract class Forme{
    protected $aire;
    abstract public function calculAire();
    public function afficheAire(){
        echo $this->aire;
    }
}
class Rectangle extends Forme{
    private $longueur;
    private $largeur;
    public function __construct($longueur,$largeur){
        $this->longueur=$longueur;
        $this->largeur=$largeur;
    }
    public function calculAire(){
        $this->aire = $this->longueur * $this->largeur;
    }
}
$rect=new Rectangle(10,2);
$rect->calculAire();
$rect->afficheAire();
