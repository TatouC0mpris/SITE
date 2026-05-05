<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mdp = $_POST['mot_de_passe'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?');
    $stmt->execute([$email, $mdp]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    }
    $_SESSION['message'] = 'Identifiants incorrects.';
}
require_once 'includes/header.php';
?>
<div class="card">
<h2>Connexion</h2>
<form method="post">
    <label>Email</label><input type="email" name="email" required>
    <label>Mot de passe</label><input type="password" name="mot_de_passe" required>
    <button>Se connecter</button>
</form>
<p>Tests : admin@test.fr/admin, gestion@test.fr/gestion, paul@test.fr/paul</p>
</div>
<?php require_once 'includes/footer.php'; ?>
