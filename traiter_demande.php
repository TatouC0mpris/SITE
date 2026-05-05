<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['gestionnaire']);
$id = (int)$_GET['id']; $action = $_GET['action'] ?? '';
$stmt = $pdo->prepare('SELECT * FROM demandes_adoption WHERE id=?'); $stmt->execute([$id]); $d = $stmt->fetch(PDO::FETCH_ASSOC);
if ($d) {
    if ($action === 'valider') {
        $pdo->prepare('UPDATE demandes_adoption SET statut="validee", date_traitement=NOW() WHERE id=?')->execute([$id]);
        $pdo->prepare('UPDATE animaux SET statut="adopte" WHERE id=?')->execute([$d['animal_id']]);
        $_SESSION['message']='Demande validée.';
    } elseif ($action === 'refuser') {
        $pdo->prepare('UPDATE demandes_adoption SET statut="refusee", date_traitement=NOW() WHERE id=?')->execute([$id]);
        $pdo->prepare('UPDATE animaux SET statut="disponible" WHERE id=?')->execute([$d['animal_id']]);
        $_SESSION['message']='Demande refusée.';
    }
}
header('Location: gestion_demandes.php');
