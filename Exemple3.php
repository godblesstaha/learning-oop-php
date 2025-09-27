<?php
class Document{
    protected $titre;
    protected $isbn;
    protected $prix;

    public function __construct($titre,$isbn,$prix){
        $this->titre=$titre;
        $this->isbn=$isbn;
        $this->prix=$prix;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function afficheInfo(){
        echo $this->titre;
        echo $this->isbn;
        echo $this->prix;
    }
}
class Livre extends Document{
    private $auteur;
    private $annePublication;
    private $editeur;

    public function afficheLivre(){
        echo "Le livre $this->titre est ecrit par $this->auteur";
    }
    public function setLivre($auteur,$annePublication,$editeur){
        $this->auteur=$auteur;
        $this->anneePublication=$annePublication;
        $this->editeur=$editeur;
    }
    public function afficheInfo(){
        parent::afficheInfo();
        echo $this->auteur;
        echo $this->annePublication;
        echo $this->editeur;
    }
}
$doc1=new Livre("Antigone","ISBN 1234",120);
// echo $doc1->getTitre();