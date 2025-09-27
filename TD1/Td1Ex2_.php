<?php
class Formulaire{
    public function champSaisie($args) {
        echo "<input";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo ">";
    }
    public function zoneTexte($args) {
        echo "<textarea";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo "></textarea>";
    }
    public function listeDeroulante($name, $options = [], $args = []) {
        echo "<select name=\"$name\"";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo ">";
        foreach ($options as $key => $value) {
            echo "<option value=\"$key\">$value</option>";
        }
        echo "</select>";
    }
    public function caseCocher($args) {
        echo "<input type=\"checkbox\"";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo ">";
    }
    public function boutonRadio($args) {
        echo "<input type=\"radio\"";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo ">";
    }
    public function bouton($args) {
        echo "<button";
        foreach ($args as $key => $value) {
            if ($key !== 'text') {
                echo " $key=\"$value\"";
            }
        }
        echo ">" . ($args['text'] ?? '') . "</button>";
    }
    public function ouvertureForm($args) {
        echo "<form";
        foreach ($args as $key => $value) {
            echo " $key=\"$value\"";
        }
        echo ">";
    }
    public function fermetureForm() {
        echo "</form>";
    }
}

