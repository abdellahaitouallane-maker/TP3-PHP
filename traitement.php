<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
define('NOTE_MIN', 0);
define('NOTE_MAX', 20);

$messageErreur = "";
$donneesValides = false;

// 1. 
if (isset($_POST['nom'], $_POST['note_info'], $_POST['note_math']) && 
    !empty(trim($_POST['nom'])) && $_POST['note_info'] !== '' && $_POST['note_math'] !== '') {
    
    $nom = trim($_POST['nom']);
    $note_info = floatval($_POST['note_info']);
    $note_math = floatval($_POST['note_math']);

    // 2. 
    if ($note_info >= NOTE_MIN && $note_info <= NOTE_MAX && $note_math >= NOTE_MIN && $note_math <= NOTE_MAX) {
        $donneesValides = true;
        $moyenne = ($note_info + $note_math) / 2;
    } else {
        $messageErreur = "Erreur : Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
    }
} else {
    $messageErreur = "Erreur : Tous les champs du formulaire doivent être remplis.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement des notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Résultat du traitement</h2>

    <?php if ($donneesValides): ?>
        <!-- 4. Affichage du récapitulatif avec protection htmlspecialchars() -->
        <div style="background-color: #eff; padding: 15px; border: 1px solid #ccd;">
            <h3>Récapitulatif des notes</h3>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($nom, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Note d'Informatique :</strong> <?php echo htmlspecialchars($note_info, ENT_QUOTES, 'UTF-8'); ?> / 20</p>
            <p><strong>Note de Mathématiques :</strong> <?php echo htmlspecialchars($note_math, ENT_QUOTES, 'UTF-8'); ?> / 20</p>
            <p><strong>Moyenne :</strong> <?php echo htmlspecialchars(number_format($moyenne, 2), ENT_QUOTES, 'UTF-8'); ?> / 20</p>
        </div>
    <?php else: ?>
        <!-- Affichage du message d'erreur sécurisé -->
        <div style="background-color: #fee; padding: 15px; border: 1px solid #dcc;">
            <p style="color: red;"><?php echo htmlspecialchars($messageErreur, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <p><a href="saisie.html">← Retour au formulaire</a></p>
</body>
</html>

3. 
/*Pourquoi préférer POST à GET pour un mot de passe ?

Avec la méthode GET, les données sont transmises directement dans l'URL 
(visibles dans la barre d'adresse, enregistrées dans l'historique du navigateur et
dans les fichiers journaux/logs du serveur).
Avec la méthode POST, les données sont envoyées de manière masquée dans le corps (body) 
de la requête HTTP, ce qui garantit la confidentialité indispensable pour des informations sensibles comme un mot de passe
*/

<?php
// Définition des constantes de notes minimales et maximales
define('NOTE_MIN', 0);
define('NOTE_MAX', 20);

$messageErreur = "";
$donneesValides = false;

// 1. 
if (isset($_POST['nom'], $_POST['note_info'],$_POST['note_math']) && 
    !empty(trim($_POST['nom'])) && $_POST['note_info'] !== '' &&$_POST['note_math'] !== '') {
    
    $nom = trim($_POST['nom']);
    $note_info = floatval($_POST['note_info']);
    $note_math = floatval($_POST['note_math']);

    // 2. 
    if ($note_info >= NOTE_MIN && $note_info <= NOTE_MAX && $note_math >= NOTE_MIN && $note_math <= NOTE_MAX) {
        $donneesValides = true;
        $moyenne = ($note_info + $note_math) / 2;

        // 3.
        $cheminFichier = 'data/notes.csv';
        $ressourceFichier = fopen($cheminFichier, 'a'); // Mode "a" pour ajouter à la fin
        
        if ($ressourceFichier !== false) {
            $ligneDonnees = array($nom, $note_info, $note_math, number_format($moyenne, 2, '.', ''));
            
            fputcsv($ressourceFichier,$ligneDonnees, ';');
            
            fclose($ressourceFichier);
        } else {
            $messageErreur = "Erreur : Impossible d'ouvrir le fichier de sauvegarde.";
            $donneesValides = false;
        }

    } else {
        $messageErreur = "Erreur : Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
    }
} else {
    $messageErreur = "Erreur : Tous les champs du formulaire doivent être remplis.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement et Enregistrement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Résultat du traitement</h2>

    <?php if ($donneesValides): ?>
        <div style="background-color: #eff; padding: 15px; border: 1px solid #ccd;">
            <h3>Récapitulatif et enregistrement réussi</h3>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($nom, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Note d'Informatique :</strong> <?php echo htmlspecialchars($note_info, ENT_QUOTES, 'UTF-8'); ?> / 20</p>
            <p><strong>Note de Mathématiques :</strong> <?php echo htmlspecialchars($note_math, ENT_QUOTES, 'UTF-8'); ?> / 20</p>
            <p><strong>Moyenne :</strong> <?php echo htmlspecialchars(number_format($moyenne, 2), ENT_QUOTES, 'UTF-8'); ?> / 20</p>
            <p style="color: green;"><em>Données enregistrées avec succès dans `data/notes.csv` !</em></p>
        </div>
    <?php else: ?>
        <div style="background-color: #fee; padding: 15px; border: 1px solid #dcc;">
            <p style="color: red;"><?php echo htmlspecialchars($messageErreur, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <p><a href="saisie.html">← Retour au formulaire</a></p>
</body>
</html>

/*Que se passerait-il avec le mode "w" au lieu de "a" ?

Le mode "w" (write) ouvre le fichier en écriture seule et efface immédiatement
 tout le contenu existant du fichier (il le réinitialise à une longueur de 0 octet).

Par conséquent, si vous utilisiez "w" au lieu de "a" (append), 
à chaque fois qu'un nouvel apprenant soumettrait le formulaire, 
l'ancien contenu de notes.csv serait totalement écrasé.
 Le fichier ne contiendrait donc toujours que le tout dernier étudiant saisi, 
 au lieu d'accumuler les lignes des quatre apprenants.
 */