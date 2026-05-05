<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$animal_id = (int)$_POST['animal_id'];
$commentaire = trim($_POST['commentaire'] ?? '');
$stmt = $pdo->prepare('REPLACE INTO favoris (utilisateur_id, animal_id, commentaire) VALUES (?, ?, ?)');
$stmt->execute([utilisateur()['id'], $animal_id, $commentaire]);
$_SESSION['message'] = 'Favori enregistré.';
header('Location: favoris.php');
