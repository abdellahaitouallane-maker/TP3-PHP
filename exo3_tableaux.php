<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

$modules = ["Programmation Web (PHP)", "Algorithmique", "Recherche Opérationnelle"];

echo "<h3>Affichage des modules avec la boucle foreach :</h3>";
foreach ($modules as $m) {
    echo "- " . $m . "<br>";
}

echo "<hr>";

echo "<h3>Affichage des modules par indice direct :</h3>";
echo "Indice 0 : " . $modules[0] . "<br>";
echo "Indice 1 : " . $modules[1] . "<br>";
echo "Indice 2 : " . $modules[2] . "<br>";

//EX3.2//

// 1.
require_once 'config.php';
require_once 'exo2_flux.php';

echo "<hr><h3>Affichage du tableau des notes et mentions :</h3>";
?>

<style>
    .tableau-notes {
        border-collapse: collapse;
        width: 60%;
        margin-top: 15px;
        font-family: Arial, sans-serif;
    }
    .tableau-notes th, .tableau-notes td {
        border: 1px solid #ddd;
        padding: 8px 12px;
        text-align: center;
    }
    .tableau-notes th {
        background-color: #f2f2f2;
    }
    
    .ligne-ajourne {
        color: red;
        font-weight: bold;
    }
</style>

<table class="tableau-notes">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Note</th>
            <th>Mention</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notes as $nom => $note): ?>
            <?php 
                
                $classe_css = ($note < SEUIL) ? 'class="ligne-ajourne"' : '';
            ?>
            <tr <?php echo $classe_css; ?>>
                <td><?php echo $nom; ?></td>
                <td><?php echo $note; ?></td>
                <td><?php echo mention($note); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

//EX3.3

echo "<hr><h3>1. Calculs manuels des statistiques (avec boucles) :</h3>";


$somme = 0;
$nombre_notes = 0;
$note_max = null;
$note_min = null;

foreach ($notes as $nom => $note) {
    $somme += $note;
    $nombre_notes++;

    if ($note_max === null || $note > $note_max) {
        $note_max = $note;
    }
    if ($note_min === null || $note < $note_min) {
        $note_min = $note;
    }
}

$moyenne = $nombre_notes > 0 ? $somme / $nombre_notes : 0;

echo "Somme : " . $somme . "<br>";
echo "Moyenne : " . number_format($moyenne, 2) . " / 20<br>";
echo "Meilleure note : " . $note_max . "<br>";
echo "Plus faible note : " . $note_min . "<br>";


echo "<h3>2. Vérification avec les fonctions natives PHP :</h3>";

$somme_native = array_sum($notes);
$nombre_native = count($notes);
$moyenne_native = $somme_native / $nombre_native;
$max_native = max($notes);
$min_native = min($notes);

echo "Somme (array_sum) : " . $somme_native . "<br>";
echo "Moyenne (array_sum/count) : " . number_format($moyenne_native, 2) . " / 20<br>";
echo "Meilleure note (max) : " . $max_native . "<br>";
echo "Plus faible note (min) : " . $min_native . "<br>";


echo "<h3>3. Répartition des effectifs par mention :</h3>";

$effectifs = [
    "Très bien"  => 0,
    "Bien"       => 0,
    "Assez bien" => 0,
    "Passable"   => 0,
    "Ajourné"    => 0
];

foreach ($notes as $nom => $note) {
    $m = mention($note);
    if (isset($effectifs[$m])) {
        $effectifs[$m]++;
    }
}

echo "<ul>";
foreach ($effectifs as $mention_nom => $quantite) {
    echo "<li><strong>" . $mention_nom . "</strong> : " . $quantite . " apprenant(s)</li>";
}
echo "<ul>";
//EX3.4//
require_once 'config.php';
require_once 'exo2_flux.php';

// 2. Déclaration du tableau associatif $notes
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

function afficher($tab) {
    echo "<ul>";
    foreach ($tab as $cle =>$valeur) {
        if (is_numeric($cle)) {
            echo "<li>" . $valeur . "</li>";
        } else {
            echo "<li><strong>" . $cle . "</strong> : " . $valeur . " / 20</li>";
        }
    }
    echo "</ul>";
}

echo "<h3>Tri du tableau des notes :</h3>";

$notes_ksort = $notes;
ksort($notes_ksort);
echo "<h4>1. Tableau trié par noms croissants (ksort)</h4>";
afficher($notes_ksort);

$notes_arsort = $notes;
arsort($notes_arsort);
echo "<h4>2. Tableau trié par notes décroissantes (arsort)</h4>";
afficher($notes_arsort);

$notes_krsort = $notes;
krsort($notes_krsort);
echo "<h4>3. Tableau trié par noms décroissants (krsort)</h4>";
afficher($notes_krsort);

$notes_asort = $notes;
asort($notes_asort);
echo "<h4>4. Tableau trié par notes croissantes (asort)</h4>";
afficher($notes_asort);

/*
 * Question : Quelle fonction de tri utiliser sur un tableau indexé comme $modules ?
 Pour un tableau indexé (comme $modules), on utilise :
 - `sort($tableau)` : Pour un tri croissant (A -> Z ou numérique croissant).
- `rsort($tableau)` : Pour un tri décroissant (Z -> A ou numérique décroissant).
 
 Contrairement aux tableaux associatifs (où l'on garde l'association clé => valeur 
 avec asort/arsort), `sort()` et `rsort()` réindexent automatiquement le tableau à partir de 0.
 */
?>

}
//EX3.5//


$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

echo "<hr><h3>Exercice 3.5 : Opérateurs de tableaux</h3>";

echo "<strong>1. \$a + \$b : </strong>";
var_dump($a + $b); // Résultat : ["x" => 1, "y" => 2]
echo "<br>";

echo "<strong>2. \$a == \$b : </strong>";
var_dump($a == $b); // Résultat : true
echo "<br>";

echo "<strong>3. \$a === \$b : </strong>";
var_dump($a === $b); // Résultat : false
echo "<br>";
?>



<?php
if (!defined('ETABLISSEMENT')) {
    define('ETABLISSEMENT', 'Université Cadi Ayyad');
}

// 1. 
include('includes/entete_inc.php');

// 2. 
include('includes/menu_inc.php');
?>

<main>
    <h2>Exercice 3 : Manipulation des tableaux</h2>
    <?php
    // Votre code PHP existant pour l'exercice des tableaux
    $fruits = array("Pomme", "Banane", "Orange", "Fraise");
    
    echo "<ul>";
    foreach ($fruits as $fruit) {
        echo "<li>" . htmlspecialchars($fruit) . "</li>";
    }
    echo "</ul>";
    ?>
</main>

<?php
// 3. 
include('includes/pied_inc.php');
?>


