<?php
require_once 'config/database.php'; require_once 'includes/functions.php'; exigerConnexion();
$categories = $pdo->query('SELECT * FROM categories ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO animaux (nom,categorie_id,propose_par,age,sexe,description,frais_adoption,photo,statut) VALUES (?,?,?,?,?,?,?, ?, "disponible")');
    $stmt->execute([$_POST['nom'], $_POST['categorie_id'], utilisateur()['id'], $_POST['age'], $_POST['sexe'], $_POST['description'], $_POST['frais_adoption'], $_POST['photo']]);
    $_SESSION['message'] = 'Animal proposé.'; header('Location: animaux.php'); exit;
}
require_once 'includes/header.php';
?>
<div class="card"><h2>Proposer un animal</h2><form method="post">
<label>Nom</label><input name="nom" required>
<label>Catégorie</label><select name="categorie_id"><?php foreach($categories as $c): ?><option value="<?= $c['id'] ?>"><?= e($c['nom']) ?></option><?php endforeach; ?></select>
<label>Âge</label><input type="number" name="age" min="0">
<label>Sexe</label><select name="sexe"><option>M</option><option>F</option><option>Inconnu</option></select>
<label>Description</label><textarea name="description" required></textarea>
<label>Frais d’adoption</label><input type="number" step="0.01" name="frais_adoption" value="0">
<label>URL photo</label><input name="photo">
<button>Ajouter</button>
</form></div>
<?php require_once 'includes/footer.php'; ?>
