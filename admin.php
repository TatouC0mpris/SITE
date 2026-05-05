<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerRole(['admin']);
$categories = $pdo->query('SELECT * FROM categories ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
$utilisateurs = $pdo->query('SELECT * FROM utilisateurs ORDER BY date_creation DESC')->fetchAll(PDO::FETCH_ASSOC);
require_once 'includes/header.php';
?>
<h2>Administration</h2>
<div class="card"><h3>Ajouter une catégorie</h3>
<form method="post" action="admin_categorie.php">
<label>Nom</label><input name="nom" required>
<label>Description</label><textarea name="description"></textarea>
<button>Ajouter</button>
</form></div>
<div class="card"><h3>Catégories</h3><table><tr><th>Nom</th><th>Action</th></tr>
<?php foreach($categories as $c): ?><tr><td><?= e($c['nom']) ?></td><td><a class="btn danger" href="admin_supprimer_categorie.php?id=<?= $c['id'] ?>">Supprimer</a></td></tr><?php endforeach; ?>
</table></div>
<div class="card"><h3>Utilisateurs</h3><table><tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Action</th></tr>
<?php foreach($utilisateurs as $u): ?><tr><td><?= e($u['nom']) ?></td><td><?= e($u['email']) ?></td><td><?= e($u['role']) ?></td><td><?php if($u['id'] != utilisateur()['id']): ?><a class="btn danger" href="admin_supprimer_utilisateur.php?id=<?= $u['id'] ?>">Supprimer</a><?php endif; ?></td></tr><?php endforeach; ?>
</table></div>
<?php require_once 'includes/footer.php'; ?>
