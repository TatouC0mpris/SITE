<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$stmt = $pdo->prepare('INSERT INTO demandes_adoption (utilisateur_id, animal_id, message) VALUES (?, ?, ?)');
$stmt->execute([utilisateur()['id'], (int)$_POST['animal_id'], trim($_POST['message'] ?? '')]);
$pdo->prepare('UPDATE animaux SET statut="en_attente" WHERE id=?')->execute([(int)$_POST['animal_id']]);
$_SESSION['message'] = 'Demande envoyée.';
header('Location: animaux.php');
