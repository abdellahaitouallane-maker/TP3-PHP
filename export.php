<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
$cheminCsv = 'data/notes.csv';
$tableauResultats = [];

// 1. 
if (file_exists($cheminCsv)) {
    $ressource = fopen($cheminCsv, 'r');
    if ($ressource !== false) {
        while (($ligne = fgetcsv($ressource, 1000, ';')) !== FALSE) {
            if (!empty($ligne) && count($ligne) >= 4) {
                $tableauResultats[] = [
                    "nom" => $ligne[0],
                    "notes" => [
                        "info" => floatval($ligne[1]),
                        "math" => floatval($ligne[2])
                    ],
                    "moyenne" => floatval($ligne[3])
                ];
            }
        }
        fclose($ressource);
    }
} else {
   
    $tableauResultats = [
        [
            "nom" => "Exemple Étudiant",
            "notes" => ["info" => 14.0, "math" => 15.0],
            "moyenne" => 14.5
        ]
    ];
}

// 2.
$cheminJson = 'data/notes.json';
// JSON_PRETTY_PRINT et JSON_UNESCAPED_UNICODE rendent le fichier lisible et gèrent les accents
$jsonContenu = json_encode($tableauResultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($cheminJson, $jsonContenu);

// 3. 
$jsonLu = file_get_contents($cheminJson);
$tableauDecode = json_decode($jsonLu, true); // true pour obtenir un tableau associatif
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exportation et Sérialisation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ddd;
            overflow-x: auto;
        }
        .box {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            background: #fafafa;
        }
    </style>
</head>
<body>
    <h2>Exercice 5.4 : Sérialisation et Export JSON</h2>

   
    <div class="box">
        <h3>3. Relecture et affichage du tableau décodé (print_r) :</h3>
        <pre><?php print_r($tableauDecode); ?></pre>
    </div>

    <!-- 4.
    <div class="box">
        <h3>4. Comparaison des formats de sérialisation :</h3>
        
        <p><strong>Format avec <code>serialize()</code> (spécifique à PHP) :</strong></p>
        <pre><?php echo htmlspecialchars(serialize($tableauResultats)); ?></pre>

        <p><strong>Format avec <code>json_encode()</code> (standard universel) :</strong></p>
        <pre><?php echo htmlspecialchars(json_encode($tableauResultats)); ?></pre>
    </div>

    <p><a href="liste.php">← Retour à la liste des notes</a></p>
</body>
</html>

/*Lequel de ces formats est directement exploitable par une application JavaScript ?

C'est le format JSON (json_encode) qui est directement exploitable par JavaScript.

Pourquoi ? JSON (JavaScript Object Notation) est un standard d'échange de données universel.
JavaScript peut le transformer instantanément en objets natifs grâce à la méthode JSON.
parse(). En revanche, serialize() produit une chaîne de caractères au format
 propriétaire de PHP (contenant des informations sur les types et la taille des données,
  ex: a:1:{...}), qui ne peut pas être comprise nativement par JavaScript
   sans l'utilisation de bibliothèques tierces complexes */
