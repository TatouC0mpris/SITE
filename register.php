<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, "utilisateur")');
    try {
        $stmt->execute([trim($_POST['nom']), trim($_POST['email']), $_POST['mot_de_passe']]);
        $_SESSION['message'] = 'Compte créé. Vous pouvez vous connecter.';
        header('Location: login.php'); exit;
    } catch (PDOException $e) { $_SESSION['message'] = 'Email déjà utilisé.'; }
}
require_once 'includes/header.php';
?>
<div class="card"><h2>Inscription</h2>
<form method="post">
<label>Nom</label><input name="nom" required>
<label>Email</label><input type="email" name="email" required>
<label>Mot de passe</label><input type="password" name="mot_de_passe" required>
<button>Créer mon compte</button>
</form></div>
<?php require_once 'includes/footer.php'; ?>
