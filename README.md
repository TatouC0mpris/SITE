# Site d’adoption d’animaux - Projet R209

## Lancer le projet dans VS Code

1. Installer XAMPP, WAMP, MAMP ou Laragon.
2. Mettre le dossier `adoption_animaux` dans le dossier web local :
   - XAMPP : `htdocs/adoption_animaux`
   - WAMP : `www/adoption_animaux`
   - Laragon : `www/adoption_animaux`
3. Démarrer Apache et MySQL.
4. Ouvrir phpMyAdmin.
5. Importer le fichier `sql/schema.sql`.
6. Vérifier dans `config/database.php` que l’utilisateur MySQL est correct.
   - Par défaut : `root` sans mot de passe.
7. Aller dans le navigateur : `http://localhost/adoption_animaux/`

## Comptes de test

- Admin : `admin@test.fr` / `admin`
- Gestionnaire : `gestion@test.fr` / `gestion`
- Utilisateur : `paul@test.fr` / `paul`

## Fonctionnalités incluses

- Liste des animaux disponibles
- Fiche détaillée d’un animal
- Inscription / connexion / déconnexion
- Rôles : anonyme, utilisateur, admin, gestionnaire
- Utilisateur : proposer un animal, consulter les offres, favoris, commentaires, demandes d’adoption
- Admin : ajouter/supprimer des catégories, supprimer des utilisateurs
- Gestionnaire : visualiser, valider ou refuser les demandes d’adoption
- Formulaires dynamiques avec catégories lues depuis la base
- CSS simple

## Remarque sécurité

Pour simplifier le projet étudiant, les mots de passe sont stockés en clair. Pour un vrai site, il faut utiliser `password_hash()` et `password_verify()`.
