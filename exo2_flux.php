<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
require 'config.php';

function mention($note) {
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    } else {
        return "Ajourné";
    }
}


$notes_a_tester = [17, 15, 12.5, 10, 8, 19, 5];

echo "<h3>Résultats des mentions :</h3>";

foreach ($notes_a_tester as $n) {
    echo "Note : " . $n . " &rarr; Mention : <strong>" . mention($n) . "</strong><br>";
}
//EX2.2//

$mois = date("m");
$nom_mois = "";


switch ($mois) {
    case "01":
        $nom_mois = "Janvier";
        break;
    case "02":
        $nom_mois = "Février";
        break;
    case "03":
        $nom_mois = "Mars";
        break;
    case "04":
        $nom_mois = "Avril";
        break;
    case "05":
        $nom_mois = "Mai";
        break;
    case "06":
        $nom_mois = "Juin";
        break;
    case "07":
        $nom_mois = "Juillet";
        break;
    case "08":
        $nom_mois = "Août";
        break;
    case "09":
        $nom_mois = "Septembre";
        break;
    case "10":
        $nom_mois = "Octobre";
        break;
    case "11":
        $nom_mois = "Novembre";
        break;
    case "12":
        $nom_mois = "Décembre";
        break;
    default:
        $nom_mois = "Mois inconnu";
        break;
}

echo "Le mois courant est : <strong>" . $nom_mois . "</strong><br><hr>";

/* 
  Que se passe-t-il si vous oubliez un break dans un case ?
Si on oublie le break, PHP exécute le code du case correspondant, 
mais il **continue** d'exécuter le code des cases suivants (c'est ce qu'on appelle 
le "fall-through" ou effet de cascade) jusqu'à ce qu'il trouve un break ou 
la fin du switch. Cela fausse les résultats et affiche des informations incorrectes.
*/

//EX2.3//

echo "<h3>1. Triangle d'étoiles :</h3>";
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}
echo "<hr>";


echo "<h3>2. Nombres de 0 à 20 (while) :</h3>";
$i = 0;
while ($i <= 20) {
    if ($i == 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}
echo "<br><hr>";


echo "<h3>3. Nombres pairs de 0 à 10 (for + continue) :</h3>";
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        continue; 
    echo "$i ";
}
echo "<br><hr>";


echo "<h3>4. Test avec while, switch et break 2 :</h3>";
$k = 0;
while (true) {
    $k++;
    switch ($k) {
        case 5:
            echo "At 5<br>";
            break; 
        case 10:
            echo "At 10; quitting<br>";
            break 2; 
    }
}
echo "<hr>";


echo "<h3>5. Réécriture avec do-while :</h3>";
$m = 0;
do {
    if ($m == 10) {
        echo "<strong>$m</strong> ";
    } else {
        echo "$m ";
    }
    $m += 2; } while ($m <= 20);
echo "<br><hr>";

/* 
 Quelle est la différence essentielle entre while et do-while ?
 - `while` : Il évalue la condition **avant** d'exécuter le bloc de code. Si la condition est fausse 
    dès le départ, le code à l'intérieur ne s'exécutera **jamais**.
 `do-while` : Il exécute le bloc de code **au moins une fois**, puis évalue la condition à la fin.
*/

}
?>