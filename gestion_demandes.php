<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['gestionnaire']);
$sql = 'SELECT d.*, u.nom AS client, u.email, a.nom AS animal FROM demandes_adoption d JOIN utilisateurs u ON u.id=d.utilisateur_id JOIN animaux a ON a.id=d.animal_id ORDER BY d.date_demande DESC';
$demandes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
require_once 'includes/header.php';
?>
<h2>Demandes d’adoption</h2>
<div class="card"><table><tr><th>Client</th><th>Animal</th><th>Message</th><th>Statut</th><th>Action</th></tr>
<?php foreach($demandes as $d): ?><tr>
<td><?= e($d['client']) ?><br><?= e($d['email']) ?></td><td><?= e($d['animal']) ?></td><td><?= e($d['message'] ?? '') ?></td><td><?= e($d['statut']) ?></td>
<td class="actions"><a class="btn" href="traiter_demande.php?id=<?= $d['id'] ?>&action=valider">Valider</a><a class="btn danger" href="traiter_demande.php?id=<?= $d['id'] ?>&action=refuser">Refuser</a></td>
</tr><?php endforeach; ?>
</table></div>
<?php require_once 'includes/footer.php'; ?>
