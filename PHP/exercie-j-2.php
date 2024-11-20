<?php

function texte() {
    $texte = "Bonjour monsieur comment allez-vous ce matin";

    // Remplace les espaces par des points
    $new_texte = str_replace(" ", ".", $texte);
    echo $new_texte;
    echo "<br><br>";

    // Inverse chaque mot du texte
    $mots = explode(" ", $texte);
    $mots_inverses = array_map(function($mot) {
        return strrev($mot);
    }, $mots);
    $texte_retourner = implode(" ", $mots_inverses);      
    echo  $texte_retourner;
    echo "<br><br>";


    // Ajouter le nombre de caractères après chaque mot

    $mots_longueur = array_map(function($mots_inverses) {
        return $mots_inverses . " (" . strlen($mots_inverses) . ")";
    }, $mots_inverses);
    $nouvelle_phrase = implode(" ", $mots_longueur);
    echo  $nouvelle_phrase;
}

texte();

?>
