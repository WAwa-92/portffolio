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
    'Wawa',
    'admin@portfolio.local',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9lliS6JwlnQf5xvV9GfD2.',
    '<p>Développeur web en formation à la 3W Academy.</p><p>Vous pouvez consulter mon profil <a href="https://github.com/WAwa-92" target="_blank" rel="noopener">GitHub</a>.</p>',
    'https://github.com/WAwa-92'
);

INSERT INTO categories (name) VALUES
('Frontend'),
('Backend'),
('Fullstack'),
('CMS');

INSERT INTO skills (name, level, user_id) VALUES
('HTML/CSS', 80, 1),
('PHP', 70, 1),
('JavaScript', 65, 1),
('MySQL', 70, 1),
('SCSS', 60, 1),
('Git', 60, 1);

INSERT INTO projects (title, slug, summary, content, category_id, user_id) VALUES
(
    'Maquette 3W Academy',
    'maquette-3w-academy',
    'Intégration d\'une maquette responsive mobile-first.',
    '<p>Projet d\'intégration HTML / SCSS avec une approche mobile-first et un découpage des composants.</p>',
    1,
    1
),
(
    'Mini API PHP',
    'mini-api-php',
    'API simple en PHP orienté objet avec PDO.',
    '<p>API en PHP orienté objet avec architecture MVC, routes et sécurisation des entrées utilisateur.</p>',
    2,
    1
),
(
    'React UI Showcase',
    'react-ui-showcase',
    'Interface frontend réalisée avec React.',
    '<p>Création d\'une interface avec composants réutilisables, état local et affichage conditionnel.</p>',
    1,
    1
),
(
    'Portfolio Fullstack',
    'portfolio-fullstack',
    'Portfolio complet avec dashboard administrateur.',
    '<p>Projet fullstack PHP/MySQL avec une administration des projets, catégories, compétences, tags et images.</p>',
    3,
    1
),
(
    'Veille Git & Workflow',
    'veille-git-workflow',
    'Projet de veille sur les bonnes pratiques Git.',
    '<p>Organisation du travail avec branches, pull requests et conventions de commit.</p>',
    2,
    1
),
(
    'Site vitrine LDLC (inspiration)',
    'site-vitrine-ldlc',
    'Reproduction d\'une partie de l\'ergonomie d\'un site e-commerce.',
    '<p>Travail sur la hiérarchie visuelle, les composants de cartes produits et l\'adaptation responsive.</p>',
    4,
    1
);

INSERT INTO tags (name, project_id) VALUES
('HTML', 1),
('SCSS', 1),
('Responsive', 1),
('PHP', 2),
('PDO', 2),
('MVC', 2),
('React', 3),
('Components', 3),
('State', 3),
('PHP', 4),
('MySQL', 4),
('Admin', 4),
('Git', 5),
('Branching', 5),
('Workflow', 5),
('UX', 6),
('E-commerce', 6),
('Responsive', 6);

INSERT INTO images (alt, picture, project_id) VALUES
('Capture maquette 3W Academy', 'maquette-3w-academy.jpg', 1),
('Capture mini API PHP', 'mini-api-php.jpg', 2),
('Capture React UI Showcase', 'react-ui-showcase.jpg', 3),
('Capture dashboard portfolio', 'portfolio-fullstack.jpg', 4),
('Capture veille Git', 'veille-git-workflow.jpg', 5),
('Capture site vitrine LDLC', 'site-vitrine-ldlc.jpg', 6);

-- Mot de passe de démonstration: password (à changer en production)
