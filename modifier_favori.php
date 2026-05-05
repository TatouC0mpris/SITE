<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$stmt = $pdo->prepare('UPDATE favoris SET commentaire=? WHERE utilisateur_id=? AND animal_id=?');
$stmt->execute([trim($_POST['commentaire'] ?? ''), utilisateur()['id'], (int)$_POST['animal_id']]);
$_SESSION['message'] = 'Commentaire modifié.';
header('Location: favoris.php');
