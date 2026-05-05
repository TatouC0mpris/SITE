<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['admin']);
$stmt = $pdo->prepare('INSERT INTO categories (nom, description) VALUES (?, ?)');
$stmt->execute([trim($_POST['nom']), trim($_POST['description'] ?? '')]);
$_SESSION['message']='Catégorie ajoutée.'; header('Location: admin.php');
