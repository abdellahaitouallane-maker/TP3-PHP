<?php
/**
 * Auteur : Abdellah Aitouallane
 * Objectif :Mini-application web en PHP de suivi, de gestion et d'analyse des notes d'une classe 
 * Date : 22/10/2026
 */
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && !empty(trim($_POST['login']))) {

    $_SESSION['login'] = trim($_POST['login']);
    
    header("Location: profil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Page de Connexion</h2>
    
    <form action="login.php" method="POST">
        <div>
            <label for="login">Identifiant (Login) :</label>
            <input type="text" id="login" name="login" required>
        </div>
        <br>
        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
</body>
</html>

<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && !empty(trim($_POST['login']))) {
    $login = trim($_POST['login']);
    $_SESSION['login'] = $login;

    // 3. 
    $infosConnexion = [
        'login' => $login,
        'date' => date('Y-m-d H:i:s')
    ];
    setcookie("dernier_login_info", json_encode($infosConnexion), time() + 86400, "/");


    header("Location: profil.php");
    exit;
}

// 2.
$loginPredefini = "";
$dateDerniereConnexion = "";

if (isset($_COOKIE['dernier_login_info'])) {
   
    $infos = json_decode($_COOKIE['dernier_login_info'], true);
    if (isset($infos['login'])) {
        $loginPredefini = $infos['login'];
        $dateDerniereConnexion = $infos['date'];
    }
} elseif (isset($_COOKIE['dernier_login'])) {
  
    $loginPredefini = $_COOKIE['dernier_login'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Page de Connexion</h2>
    
    <?php if (!empty($dateDerniereConnexion)): ?>
        <p style="color: #666; font-style: italic;">
            Dernière connexion le : <?php echo htmlspecialchars($dateDerniereConnexion, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div>
            <label for="login">Identifiant (Login) :</label>
            <!-- Le champ est pré-rempli grâce à la valeur du cookie -->
            <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($loginPredefini, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <br>
        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
</body>
</html>
/*• Où est stockée une session ? Où est stocké un cookie ?
Une session : Elle est stockée côté serveur. PHP enregistre les données de la session dans un fichier temporaire sur le disque dur du serveur web. Seul un identifiant unique de session (généralement stocké dans un cookie de session nommé PHPSESSID) est envoyé au navigateur du client pour faire le lien.

Un cookie : Il est stocké entièrement côté client (directement sur le disque dur de l'utilisateur, géré par son navigateur web) sous la forme d'un petit fichier texte. Il est renvoyé automatiquement au serveur à chaque requête HTTP ultérieure.

• Pourquoi setcookie() et header() doivent-ils être appelés avant tout affichage ?
En HTTP, le serveur envoie d'abord les en-têtes (headers) de la réponse (qui contiennent les instructions de cookies, les redirections, le type de contenu, etc.) avant d'envoyer le corps (body) (le code HTML et l'affichage visuel).

Les fonctions setcookie() et header() modifient directement ces en-têtes HTTP. Si du texte, des espaces ou du code HTML ont déjà été affichés (via un echo ou une balise <html>), PHP considère que les en-têtes ont déjà été envoyés au navigateur. Cela provoque une erreur fatale bien connue ("Headers already sent").*
 C'est pourquoi ces instructions doivent impérativement se situer tout au début du script PHP, avant la moindre production de texte.*/

