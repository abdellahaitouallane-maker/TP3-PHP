<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$prenom = isset($_GET['prenom']) ? htmlspecialchars($_GET['prenom']) : '';
$sexe = isset($_GET['sexe']) ? $_GET['sexe'] : '';

if ($sexe === 'M') {
    $civilite = "Monsieur";
} elseif ($sexe === 'F') {
    $civilite = "Madame";
} else {
    $civilite = "";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Affichage des informations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Résultat de la saisie</h2>

    <?php if (!empty($nom) && !empty($prenom)): ?>
        <p>Bonjour <?php echo $civilite; ?> <?php echo $prenom . ' ' . $nom; ?> !</p>
    <?php else: ?>
        <p>Veuillez renseigner tous les champs du formulaire.</p>
    <?php endif; ?>

    <p><a href="info.html">← Retour au formulaire</a></p>
</body>
</html>