<?php
class Form{
    public function champSaisie($type,$label,$placeholder,$required=true,$maxlenght,$class,$id,$style){
        echo "<label for='$id'>$label</label><br>";
        if($required == true){
            echo "<input type=\"$type\" placeholder=\"$placeholder\" required maxlength=\"$maxlenght\" class=\"$class\" id=\"$id\" style=\"$style\">";
        }
        else{
            echo "<input type=\"$type\" placeholder=\"$placeholder\" maxlength=\"$maxlenght\" class=\"$class\" id=\"$id\" style=\"$style\">";
        }
    }

    public function zoneTexte($name,$label,$placeholder,$required,$maxlenght,$class,$id,$style){
        echo "<label for='$id'>$label</label><br>";
        if($required == true){
            echo "<textarea name=\"$name\" placeholder=\"$placeholder\" required maxlength=\"$maxlenght\" class=\"$class\" id=\"$id\" style=\"$style\"></textarea><br><br>";
        }
        else{
            echo "<textarea name=\"$name\" placeholder=\"$placeholder\" maxlength=\"$maxlenght\" class=\"$class\" id=\"$id\" style=\"$style\"></textarea><br><br>";
        }
    }
    public function listeDeroulante(){
        
    }
    public function caseCocher($name,$label,$value,$checked,$class,$id,$style){
        echo "<label for='$id'>$label</label> ";
        if($checked == true){
            echo "<input type=\"checkbox\" name=\"$name\" value=\"$value\" checked class=\"$class\" id=\"$id\" style=\"$style\">";
        }
        else{
            echo "<input type=\"checkbox\" name=\"$name\" value=\"$value\" class=\"$class\" id=\"$id\" style=\"$style\">";
        }
    }

    public function boutonRadio($name,$label,$value,$checked,$class,$id,$style){
        echo "<label for='$id'>$label</label> ";
        if($checked == true){
            echo "<input type=\"radio\" name=\"$name\" value=\"$value\" checked class=\"$class\" id=\"$id\" style=\"$style\">";
        }
        else{
            echo "<input type=\"radio\" name=\"$name\" value=\"$value\" class=\"$class\" id=\"$id\" style=\"$style\">";
        }
    }

    public function bouton($type,$value,$class,$id,$style){
        echo "<button type=\"$type\" value=\"$value\" class=\"$class\" id=\"$id\" style=\"$style\">$value</button>";
    }

    public function ouvertureForm($action,$label,$method,$class,$id,$style){
        echo "<form action=\"$action\" label=\"$label\" method=\"$method\" class=\"$class\" id=\"$id\"  style=$style>";
    }
    public function fermetureForm(){
        echo "</form>";
    }
}
// $texte=new Form();
// $texte->champSaisie("texte","Champ de test","Ceci est un test",true,100,"champ","champ","");
// $form = new Form();

// $form->ouvertureForm("traitement.php","Formulaire de Test","post","formulaire","form1","border:1px solid black; padding:20px; width:300px;");

// //champ de saisi
// $form->champSaisie("text","Nom:","Entrez votre nom",true,50,"input","nom","width:100%;");

// //zoone de texte
// $form->zoneTexte("message","Message:","Votre message ici",true,200,"textarea","msg","width:100%; height:80px;");

// //Case a cocher
// $form->caseCocher("newsletter","Remembar me","oui",false,"checkbox","news","");

// //boutons radio
// $form->boutonRadio("sexe","Homme","homme",true,"radio","homme","");
// $form->boutonRadio("sexe","Femme","femme",false,"radio","femme","");

// //boutons
// $form->bouton("submit","Envoyer","btn","submitBtn","background:green; color:white; padding:10px;");
// $form->bouton("reset","Réinitialiser","btn","resetBtn","background:red; color:white; padding:10px;");

// $form->fermetureForm();