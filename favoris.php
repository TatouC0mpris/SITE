<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$stmt = $pdo->prepare('SELECT f.commentaire, a.*, c.nom AS categorie FROM favoris f JOIN animaux a ON a.id=f.animal_id JOIN categories c ON c.id=a.categorie_id WHERE f.utilisateur_id=?');
$stmt->execute([utilisateur()['id']]); $favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
require_once 'includes/header.php';
?>
<h2>Mes favoris</h2>
<?php foreach ($favoris as $f): ?>
<div class="card">
<h3><?= e($f['nom']) ?> — <?= e($f['categorie']) ?></h3>
<form method="post" action="modifier_favori.php">
<input type="hidden" name="animal_id" value="<?= $f['id'] ?>">
<label>Commentaire</label><textarea name="commentaire"><?= e($f['commentaire'] ?? '') ?></textarea>
<div class="actions"><button>Modifier</button><a class="btn secondary" href="animal.php?id=<?= $f['id'] ?>">Voir</a><a class="btn danger" href="supprimer_favori.php?id=<?= $f['id'] ?>">Supprimer</a></div>
</form>
</div>
<?php endforeach; ?>
<?php require_once 'includes/footer.php'; ?>
