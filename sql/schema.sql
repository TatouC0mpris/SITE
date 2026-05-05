DROP DATABASE IF EXISTS adoption_animaux;
CREATE DATABASE adoption_animaux CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE adoption_animaux;

CREATE TABLE utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  mot_de_passe VARCHAR(255) NOT NULL,
  role ENUM('utilisateur','admin','gestionnaire') NOT NULL DEFAULT 'utilisateur',
  date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL UNIQUE,
  description TEXT NULL
);

CREATE TABLE animaux (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  categorie_id INT NOT NULL,
  propose_par INT NULL,
  age INT NULL,
  sexe ENUM('M','F','Inconnu') NOT NULL DEFAULT 'Inconnu',
  description TEXT NOT NULL,
  frais_adoption DECIMAL(8,2) NOT NULL DEFAULT 0,
  photo VARCHAR(255) NULL,
  statut ENUM('disponible','en_attente','adopte','refuse') NOT NULL DEFAULT 'disponible',
  date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE RESTRICT,
  FOREIGN KEY (propose_par) REFERENCES utilisateurs(id) ON DELETE SET NULL
);

CREATE TABLE favoris (
  utilisateur_id INT NOT NULL,
  animal_id INT NOT NULL,
  commentaire TEXT NULL,
  date_ajout DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (utilisateur_id, animal_id),
  FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
  FOREIGN KEY (animal_id) REFERENCES animaux(id) ON DELETE CASCADE
);

CREATE TABLE demandes_adoption (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  animal_id INT NOT NULL,
  message TEXT NULL,
  statut ENUM('en_attente','validee','refusee') NOT NULL DEFAULT 'en_attente',
  date_demande DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_traitement DATETIME NULL,
  FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
  FOREIGN KEY (animal_id) REFERENCES animaux(id) ON DELETE CASCADE
);

INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES
('Admin', 'admin@test.fr', 'admin', 'admin'),
('Gestionnaire', 'gestion@test.fr', 'gestion', 'gestionnaire'),
('Paul', 'paul@test.fr', 'paul', 'utilisateur');

INSERT INTO categories (nom, description) VALUES
('Chats', 'Chats à adopter'),
('Chiens', 'Chiens à adopter'),
('Chèvres', 'Chèvres domestiques'),
('Lapins', 'Lapins et petits animaux');

INSERT INTO animaux (nom, categorie_id, propose_par, age, sexe, description, frais_adoption, photo, statut) VALUES
('Milo', 1, 3, 2, 'M', 'Chat calme, joueur et habitué aux enfants.', 80.00, 'https://placekitten.com/500/350', 'disponible'),
('Nala', 2, 3, 4, 'F', 'Chienne affectueuse, aime les promenades.', 120.00, 'https://images.unsplash.com/photo-1552053831-71594a27632d?w=800', 'disponible'),
('Biscotte', 4, NULL, 1, 'F', 'Lapine douce et curieuse.', 30.00, 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=800', 'disponible'),
('Capucine', 3, NULL, 3, 'F', 'Petite chèvre sociable, idéale terrain clôturé.', 50.00, 'https://images.unsplash.com/photo-1524024973431-2ad916746881?w=800', 'disponible');
