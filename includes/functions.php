<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function estConnecte(): bool {
    return isset($_SESSION['user']);
}

function utilisateur(): ?array {
    return $_SESSION['user'] ?? null;
}

function role(): string {
    return $_SESSION['user']['role'] ?? 'anonyme';
}

function exigerConnexion(): void {
    if (!estConnecte()) {
        header('Location: login.php');
        exit;
    }
}

function exigerRole(array $roles): void {
    exigerConnexion();
    if (!in_array(role(), $roles, true)) {
        http_response_code(403);
        echo 'Accès refusé';
        exit;
    }
}

function e(string $texte): string {
    return htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');
}
?>
