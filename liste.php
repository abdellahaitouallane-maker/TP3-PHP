<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
$cheminFichier = 'data/notes.csv';
$lignes = [];
$sommeMoyennes = 0;
$nombreEtudiants = 0;

// 1. 
if (file_exists($cheminFichier)) {
    
    // 2.
    $ressource = fopen($cheminFichier, 'r');
    if ($ressource === false) {
        echo "<p style='color: red;'>Erreur : Impossible d'ouvrir le fichier des notes en lecture.</p>";
        exit;
    }

    // 3.
    // Le séparateur utilisé lors de l'écriture (Exercice 5.1) était le point-virgule (;)
    while (($ligne = fgetcsv($ressource, 1000, ';')) !== FALSE) {
        $lignes[] = $ligne;
        
        
        if (isset($ligne[3])) {
            $sommeMoyennes += floatval($ligne[3]);
            $nombreEtudiants++;
        }
    }

   
    fclose($ressource);
} else {
    $ressource = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants et des notes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .classe-moyenne {
            font-size: 1.1em;
            font-weight: bold;
            background-color: #eef;
            padding: 10px;
            border: 1px solid #ccd;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h2>Liste des notes des apprenants</h2>

    <?php if ($ressource === false && !file_exists($cheminFichier)): ?>
        <p style="color: red;">Aucun fichier de données trouvé (le fichier <code>data/notes.csv</code> n'existe pas encore). Veuillez d'abord enregistrer des notes via le formulaire.</p>
    <?php elseif (empty($lignes)): ?>
        <p>Le fichier des notes est actuellement vide.</p>
    <?php else: ?>
        <!-- 4. Affichage du tableau HTML -->
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Info</th>
                    <th>Math</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignes as $data): 
                    $nom = isset($data[0]) ? htmlspecialchars($data[0], ENT_QUOTES, 'UTF-8') : '';
                    $info = isset($data[1]) ? floatval($data[1]) : 0;
                    $math = isset($data[2]) ? floatval($data[2]) : 0;
                    $moyenne = isset($data[3]) ? floatval($data[3]) : ($info + $math) / 2;

                    // Attribution d'une mention selon la moyenne
                    if ($moyenne >= 16) {
                        $mention = "Très bien";
                    } elseif ($moyenne >= 14) {
                        $mention = "Bien";
                    } elseif ($moyenne >= 12) {
                        $mention = "Assez bien";
                    } elseif ($moyenne >= 10) {
                        $mention = "Passable";
                    } else {
                        $mention = "Insuffisant";
                    }
                ?>
                    <tr>
                        <td><?php echo $nom; ?></td>
                        <td><?php echo number_format($info, 2, '.', ''); ?></td>
                        <td><?php echo number_format($math, 2, '.', ''); ?></td>
                        <td><strong><?php echo number_format($moyenne, 2, '.', ''); ?></strong></td>
                        <td><?php echo $mention; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- 5. Affichage de la moyenne générale de la classe -->
        <?php if ($nombreEtudiants > 0): 
            $moyenneGenerale = $sommeMoyennes / $nombreEtudiants;
        ?>
            <div class="classe-moyenne">
                Moyenne générale de la classe : <?php echo number_format($moyenneGenerale, 2, '.', ''); ?> / 20
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <p style="margin-top: 20px;"><a href="saisie.html">← Saisir un nouvel étudiant</a></p>
</body>
</html>

<?php
$cheminFichier = 'data/notes.csv';
$lignes = [];

if (file_exists($cheminFichier)) {
    $ressource = fopen($cheminFichier, 'r');
    
    if ($ressource !== false) {
        // Parcourir le fichier jusqu'à la fin avec feof()
        while (!feof($ressource)) {
            // Lire une ligne complète avec fgets()
            $ligne = fgets($ressource);
            
            // Vérifier que la ligne n'est pas vide (pour éviter les lignes vides en fin de fichier)
            if ($ligne !== false && trim($ligne) !== '') {
                // Découper la chaîne de caractères avec explode() en utilisant ';' comme séparateur
                $donnees = explode(';', trim($ligne));
                $lignes[] = $donnees;
            }
        }
        
        // Fermer le fichier
        fclose($ressource);
    } else {
        echo "<p style='color: red;'>Erreur d'ouverture du fichier.</p>";
    }
}
?>