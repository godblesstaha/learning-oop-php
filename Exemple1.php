<?php
// class Rectangle{
//     public $longueur;
//     public $largeur;
//     public function surfaceRectangle(){
//         return $this->longueur * $this->largeur;
//     }
// }
// $rect3 = new Rectangle();
// $rect3->longueur = 20;
// $rect3->largeur = 100;
// echo $surface = $rect3->surfaceRectangle();
class Rectangle{
    private $longueur;
    private $largeur;
    public function setLongueur($long){
        if ($long < 0 )
            echo "Longueur non valide";
        else
            $this->longueur = $long;
    }
    public function setLargeur($large){
        if ($large < 0 )
            echo "Largeur non valide";
        else
            $this->largeur = $large;
    }
    public function getLongueur(){
        return $this->longueur;
    }
    public function getLargeur(){
        return $this->largeur;
    }
    public function surfaceRectangle(){
        return $this->longueur * $this->largeur;
    }
}
$rect4 = new Rectangle;
$rect4->setLongueur(100);
$rect4->setLargeur(10);
echo $rect4->surfaceRectangle(). "<br>";