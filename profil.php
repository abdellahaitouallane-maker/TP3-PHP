<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
session_start();


if (!isset($_SESSION['login'])) {

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Espace Personnel</h2>
    
    <!-- Affichage du message de bienvenue sécurisé -->
    <p>Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8'); ?></strong> !</p>
    
    <p>Ceci est votre page de profil sécurisée.</p>
    
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>

<?php
$dateActuelle = new DateTime();

$dateFinSemestre = new DateTime('2027-01-31');

$intervalle = $dateActuelle->diff($dateFinSemestre);


$joursRestants = $intervalle->format('%a');
$estPasse = $intervalle->invert; // 1 si la date est déjà passée, 0 sinon
?>

<div>
    <h3>Compte à rebours du semestre</h3>
    <?php if ($estPasse == 0): ?>
        <p>Il reste <strong><?php echo $joursRestants; ?></strong> jours avant la fin du semestre (31/01/2027).</p>
    <?php else: ?>
        <p>La date de fin de semestre est déjà passée.</p>
    <?php endif; ?>
</div>