DROP DATABASE IF EXISTS portfolio_vf;
CREATE DATABASE portfolio_vf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_vf;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    description TEXT NULL,
    github_url VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    summary VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_projects_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    CONSTRAINT fk_projects_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    level INT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_skills_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    project_id INT NOT NULL,
    CONSTRAINT fk_tags_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alt VARCHAR(100) NOT NULL,
    picture VARCHAR(255) NOT NULL,
    project_id INT NOT NULL,
    CONSTRAINT fk_images_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, description, github_url)
VALUES (
    'Wael Bakkay',
    'admin@portfolio.local',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9lliS6JwlnQf5xvV9GfD2.',
    '<p>Élève en première année de Bachelor en Développement Informatique à la 3W Academy.</p><p>Passionné par le développement web et la programmation, j\'ai créé plusieurs projets en PHP, JavaScript et MySQL.</p><p>Vous pouvez consulter mon profil <a href="https://github.com/WAwa-92" target="_blank" rel="noopener">GitHub</a>.</p>',
    'https://github.com/WAwa-92'
);

INSERT INTO categories (name) VALUES
('Frontend'),
('Backend'),
('Fullstack');

INSERT INTO skills (name, level, user_id) VALUES
('HTML/CSS', 85, 1),
('PHP', 80, 1),
('JavaScript', 75, 1),
('MySQL', 80, 1),
('SCSS', 75, 1),
('Git', 70, 1);

INSERT INTO projects (title, slug, summary, content, category_id, user_id) VALUES
(
    'Akinator en PHP',
    'akinator-php',
    'Jeu de devinettes de fruits avec authentification et historique des parties.',
    '<p>Projet PHP/MySQL inspiré d\'Akinator : l\'utilisateur se connecte, lance une partie et répond à des questions pour que l\'application devine le fruit. Le projet inclut inscription/connexion, sessions, historique des parties, et requêtes préparées PDO.</p>',
    2,
    1
),
(
    'Pacman en JavaScript',
    'pacman-javascript',
    'Mini jeu d\'arcade en JavaScript orienté logique de grille et déplacements.',
    '<p>Jeu Pacman réalisé en JavaScript vanilla sur canvas : labyrinthe par grille, déplacements au clavier (flèches + ZQSD), score, et fantômes en POO avec mouvement autonome. L\'objectif était de travailler la boucle de jeu, la logique de collisions et la structure modulaire du code.</p>',
    1,
    1
),
(
    'Jeu Memory',
    'jeu-memory',
    'Jeu de mémoire avec paires de cartes, verrouillage d\'actions et redémarrage.',
    '<p>Jeu Memory en JavaScript : les cartes sont mélangées aléatoirement, le joueur retourne 2 cartes, et le script vérifie la paire. La logique gère un verrou pendant la comparaison, une temporisation sur erreur et un bouton de redémarrage.</p>',
    1,
    1
),
(
    'Anonyme Tchat en MVC PHP',
    'anonyme-tchat-mvc-php',
    'Application de chat anonyme avec salons et messages, construite en MVC.',
    '<p>Application MVC en PHP orienté objet : création de salons, envoi de messages, affichage des messages par salon et possibilité d\'épingler un message. Le routeur interne redirige vers un contrôleur dédié et les managers gèrent les accès base de données.</p>',
    3,
    1
);

INSERT INTO tags (name, project_id) VALUES
('PHP', 1),
('MySQL', 1),
('Auth', 1),
('Session', 1),
('Quiz', 1),
('JavaScript', 2),
('Arcade', 2),
('Logique de jeu', 2),
('Événements clavier', 2),
('JavaScript', 3),
('DOM', 3),
('Algorithmie', 3),
('Game loop', 3),
('Canvas', 2),
('MVC', 4),
('PHP', 4),
('POO', 4),
('Router', 4),
('Messagerie', 4);

INSERT INTO images (alt, picture, project_id) VALUES
('Capture Akinator PHP', 'akinator-php.png', 1),
('Capture Pacman JavaScript', 'pacman-javascript.png', 2),
('Capture jeu Memory', 'jeu-memory.png', 3),
('Capture Anonyme Tchat MVC PHP', 'anonyme-tchat-mvc-php.png', 4);

-- Mot de passe de démonstration: password (à changer en production)
