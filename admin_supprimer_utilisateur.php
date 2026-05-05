<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['admin']);
$id = (int)$_GET['id'];
if ($id !== (int)utilisateur()['id']) { $pdo->prepare('DELETE FROM utilisateurs WHERE id=?')->execute([$id]); }
$_SESSION['message']='Utilisateur supprimé.'; header('Location: admin.php');
