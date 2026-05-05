<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['admin']);
try { $pdo->prepare('DELETE FROM categories WHERE id=?')->execute([(int)$_GET['id']]); $_SESSION['message']='Catégorie supprimée.'; }
catch(PDOException $e) { $_SESSION['message']='Impossible : des animaux utilisent cette catégorie.'; }
header('Location: admin.php');
