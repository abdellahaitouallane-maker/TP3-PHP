<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */

// un commentaire sur une ligne//
#  un commentaire sur une ligne #
/* un commentaire sur plusieurs lignes */

echo 'Hello PHP';
//ex1.1 //
/*- $x     : Valide (commence par une lettre)
  - $_x    : Valide (commence par un underscore)
  - $2x    : Invalide (ne peut pas commencer par un chiffre)
  - $x-y   : Invalide (contient un tiret '-' interdit)
  - $Prix_HT: Valide (lettres et underscore)
  - $prix ht: Invalide (contient un espace)
  - $état  : Valide en PHP (caractères accentués acceptés)
*/
$x = 10;  
$_x = 20;   ; 
$Prix_HT = 100;
$état = "actif";
  

$a = "a miniscule";
$A = "A majuscule";
echo $a . "<br>";
echo $A . "<br>";

//ex 1.2//

require 'config.php';

echo 'etablissement: ' . ETABLISSEMENT . '<br>';
echo 'Note minimale: ' . NOTE_MIN . '<br>';
echo 'Note maximale: ' . NOTE_Max . '<br>';
echo 'Seuil: ' . seuil . '<br>';

if (defined('SEUIL')) {
    echo "La constante SEUIL est définie.<br>";
} else {
    echo "La constante SEUIL n'est pas définie.<br>";
}

if (defined('INCONNUE')) {
    echo "La constante INCONNUE est définie.<br>";
} else {
    echo "La constante INCONNUE n'est pas définie.<br><hr>";
}

/*- Que se passe-t-il si vous affichez une constante non définie ?
 PHP génère une erreur / un avertissement (Error fatale à partir de PHP 8, ou un Notice dans 
      les anciennes versions où PHP essayait de l'interpréter littéralement comme une chaîne de caractère).
- Quelle différence y a-t-il entre const et define() ? 
    1. const : Définie au moment de la compilation (compile-time). Elle doit être utilisée au niveau global 
       ou dans des classes, et ne peut pas être placée à l'intérieur d'un bloc conditionnel (if) ou d'une boucle.
   2. define() : Évaluée au moment de l'exécution (runtime). Elle peut être placée n'importe où, 
     notamment à l'intérieur de conditions `if` ou de boucles
*/


//EX1.3 ://
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "Le prix TTC du produit est de " . $prix_ttc . " €.<br>";

//EX1.4 //

echo "<h3>1. Cast en string :</h3>";
$test = 42;
$test = (string) $test; 
var_dump($test); 
echo "<br><hr>";



echo "<h3>2. Prédiction et test des casts en booléen :</h3>";

var_dump((bool) 0);      echo "<br>"; 
var_dump((bool) 0.0);    echo "<br>"; 
var_dump((bool) "0");    echo "<br>"; 
var_dump((bool) "");     echo "<br>"; 
var_dump((bool) "abc");  echo "<br>"; 
var_dump((bool) []);     echo "<br>"; 
var_dump((bool) null);   echo "<br>"; 
echo "<hr>";



echo "<h3>3. Prédiction et test de différents casts :</h3>";
echo "(int) 3.9 = ";
var_dump((int) 3.9);     
echo "<br>";

echo "(int) \"12abc\" = ";
var_dump((int) "12abc"); 
echo "<br>";

echo "(float) \"1.5e3\" = ";
var_dump((float) "1.5e3");
echo "<br>";

echo "(int) true = ";
var_dump((int) true);    
echo "<hr>";

echo "<h3>4. Le nombre 255 dans différentes bases :</h3>";
$dec = 255;         
$hex = 0xFF;         
$oct = 0377;         
$bin = 0b11111111;   

echo "Décimale (255) : " . $dec . "<br>";
echo "Hexadécimale (0xFF) : " . $hex . "<br>";
echo "Octale (0377) : " . $oct . "<br>";
echo "Binaire (0b11111111) : " . $bin . "<br>";
//EX1.5 //
$traitees = "égales à";
$ici = 2;

echo '1. Ahmed a dit : "J\'ai réussi"<br>';

echo "2. Voulez-vous supprimer C:\\*.*?<br>";

echo '3. Ceci n\'affichera pas \n de nouvelle ligne (le \n doit apparaître tel quel)<br>';

echo '4. Les variables ne seront pas $traitees $ici (variables non interprétées)<br>';

echo "5. Les variables seront $traitees $ici (variables interprétées)<br><hr>";


$chaine_initiale = "*Bonjour les développeurs*";

$chaine_propre = trim($chaine_initiale, "*");

$longueur = strlen($chaine_propre);
for ($i = 0; $i < $longueur; $i++) {
    echo $chaine_propre[$i] . "<br>";
    }
?>
