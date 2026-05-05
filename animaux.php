<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
$categorie = $_GET['categorie'] ?? '';
$categories = $pdo->query('SELECT * FROM categories ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
$sql = 'SELECT a.*, c.nom AS categorie FROM animaux a JOIN categories c ON c.id=a.categorie_id WHERE a.statut="disponible"';
$params = [];
if ($categorie !== '') { $sql .= ' AND c.id = ?'; $params[] = $categorie; }
$sql .= ' ORDER BY a.date_creation DESC';
$stmt = $pdo->prepare($sql); $stmt->execute($params);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
require_once 'includes/header.php';
?>
<div class="card"><h2>Offres d’adoption</h2>
<form method="get">
<label>Filtrer par catégorie</label>
<select name="categorie"><option value="">Toutes</option>
<?php foreach ($categories as $cat): ?><option value="<?= $cat['id'] ?>" <?= ($categorie == $cat['id'])?'selected':'' ?>><?= e($cat['nom']) ?></option><?php endforeach; ?>
</select><button>Filtrer</button>
</form></div>
<div class="grid">
<?php foreach ($animaux as $a): ?>
<div class="card">
<img src="<?= e($a['photo'] ?: 'https://via.placeholder.com/500x350?text=Animal') ?>" alt="<?= e($a['nom']) ?>">
<h3><?= e($a['nom']) ?></h3>
<p><?= e($a['categorie']) ?> - <?= e((string)$a['age']) ?> an(s) - <?= e($a['sexe']) ?></p>
<p><?= e(substr($a['description'], 0, 90)) ?>...</p>
<a class="btn" href="animal.php?id=<?= $a['id'] ?>">Voir la fiche</a>
</div>
<?php endforeach; ?>
</div>
<?php require_once 'includes/footer.php'; ?>
