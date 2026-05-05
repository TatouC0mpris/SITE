<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$stmt = $pdo->prepare('DELETE FROM favoris WHERE utilisateur_id=? AND animal_id=?');
$stmt->execute([utilisateur()['id'], (int)$_GET['id']]);
$_SESSION['message'] = 'Favori supprimé.';
header('Location: favoris.php');
