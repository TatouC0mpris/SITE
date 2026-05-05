<?php
require_once 'config/database.php'; require_once 'includes/functions.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT a.*, c.nom AS categorie FROM animaux a JOIN categories c ON c.id=a.categorie_id WHERE a.id=?');
$stmt->execute([$id]); $a = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$a) die('Animal introuvable');
require_once 'includes/header.php';
?>
<div class="card">
<img src="<?= e($a['photo'] ?: 'https://via.placeholder.com/800x350?text=Animal') ?>" alt="<?= e($a['nom']) ?>">
<h2><?= e($a['nom']) ?></h2>
<p><strong>Catégorie :</strong> <?= e($a['categorie']) ?></p>
<p><strong>Âge :</strong> <?= e((string)$a['age']) ?> an(s)</p>
<p><strong>Sexe :</strong> <?= e($a['sexe']) ?></p>
<p><strong>Frais :</strong> <?= e((string)$a['frais_adoption']) ?> €</p>
<p><?= nl2br(e($a['description'])) ?></p>
<?php if (estConnecte()): ?>
<form method="post" action="ajouter_favori.php">
<input type="hidden" name="animal_id" value="<?= $a['id'] ?>">
<label>Commentaire personnel</label><textarea name="commentaire"></textarea>
<button>Ajouter aux favoris</button>
</form>
<form method="post" action="demande_adoption.php">
<input type="hidden" name="animal_id" value="<?= $a['id'] ?>">
<label>Message pour la demande d’adoption</label><textarea name="message"></textarea>
<button>Faire une demande d’adoption</button>
</form>
<?php else: ?><p><a href="login.php">Connectez-vous</a> pour ajouter aux favoris ou faire une demande.</p><?php endif; ?>
</div>
<?php require_once 'includes/footer.php'; ?>
