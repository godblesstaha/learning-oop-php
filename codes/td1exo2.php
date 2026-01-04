<?php
    $connexion=new PDO("mysql:host=localhost;dbname=bts","root","");

    $stmt=$connexion->prepare("SELECT * FROM etudiants");
    $stmt->execute();

    $file = fopen("etudiant.xml",'w');
    fwrite($file,"<?xml version='1.0'?>");
    fwrite($file,"<etudiants>");
    while ($tabEtudiant = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fwrite($file,"<etudiant>\n");
        fwrite($file,"<id>".$tabEtudiant['matricule']."</id>\n");
        fwrite($file,"<nom>".$tabEtudiant['nom']."</nom>\n");
        fwrite($file,"<prenom>".$tabEtudiant['prenom']."</prenom>\n");
        fwrite($file,"<sexe>".$tabEtudiant['sexe']."</sexe>\n");
        fwrite($file,"<filiere>".$tabEtudiant['filiere']."</filiere>\n");
        fwrite($file,"<dateNaissance>".$tabEtudiant['dateNaissance']."</dateNaissance>\n");
        fwrite($file,"</etudiant>");
    }
    fwrite($file,"</etudiants>");
    fclose($file);

// dom
    $dom = new DOMdocument('1.0','utf_8');
    $racine = $dom->createElement("etudiants");
    $dom->appendChild($racine);
    while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $etudiant = $dom->createElement("etudiant");
        $nom = $dom->createElement("nom",$array['nom']);
        $etudiant->appendChild($nom);
        $prenom = $dom->createElement("prenom",$array['prenom']);
        $etudiant->appendChild($prenom);
        $sexe = $dom->createElement("sexe",$array['sexe']);
        $etudiant->appendChild($sexe);
        $filiere = $dom->createElement("filiere",$array['filiere']);
        $etudiant->appendChild($prenom);
        $dateNai = $dom->createElement("dateNaissance",$array['dateNaissance']);
        $etudiant->appendChild($dateNai);
        $racine->appendChild($etudiant);
    }
    $dom->save("etudiant.xml");
?>