<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Adoption Animaux</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <h1>Adoption Animaux</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="animaux.php">Offres</a>
        <?php if (estConnecte()): ?>
            <a href="favoris.php">Mes favoris</a>
            <a href="proposer_animal.php">Proposer un animal</a>
            <?php if (role() === 'admin'): ?><a href="admin.php">Admin</a><?php endif; ?>
            <?php if (role() === 'gestionnaire'): ?><a href="gestion_demandes.php">Demandes</a><?php endif; ?>
            <a href="logout.php">Déconnexion (<?= e(utilisateur()['nom']) ?>)</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        <?php endif; ?>
    </nav>
</header>
<main>
<?php if (!empty($_SESSION['message'])): ?>
    <p class="message"><?= e($_SESSION['message']); unset($_SESSION['message']); ?></p>
<?php endif; ?>
