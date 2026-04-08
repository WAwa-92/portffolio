# Portfolio — Wael Bakkay

Portfolio personnel développé en PHP avec une architecture MVC maison, sans framework.

## Présentation

Ce projet est un portfolio administrable qui permet de :

- présenter mon profil, mes compétences et mes projets
- gérer le contenu depuis un espace d'administration sécurisé
- filtrer les projets par catégorie côté client en JavaScript

**Accès public :** `http://localhost/portfolioVF/public/`  
**Accès admin :** `http://localhost/portfolioVF/public/login`  
Email : `admin@portfolio.local` — Mot de passe : `password`

---

## Architecture MVC

```
public/          → point d'entrée unique (index.php) + assets CSS/JS/images
app/
  Core/          → Router, Controller, Model, Session, Auth
  Controllers/   → logique des pages (Home, Project, Auth, Admin)
  Models/        → accès base de données via PDO
  Views/         → templates PHP
  Helpers/       → fonctions utilitaires (e(), rich())
database/
  schema.sql     → structure + données de départ
diagrammes/      → modèles Merise (MCD, MLD, MPD)
```

Chaque requête arrive dans `public/index.php`, le Router lit l'URL et appelle le bon Controller, qui interroge le Model et passe les données à la View.

---

## Base de données

6 tables reliées par des clés étrangères :

| Table | Rôle |
|---|---|
| `users` | compte administrateur + profil public |
| `categories` | catégories des projets (Frontend, Backend…) |
| `projects` | projets avec titre, résumé, contenu riche |
| `skills` | compétences avec niveau en % |
| `tags` | technologies liées à un projet |
| `images` | captures d'écran liées à un projet |

---

## Fonctionnalités

### Côté public
- Page d'accueil : présentation, photo, compétences avec jauges animées, projets avec filtres
- Page détail projet : images, description, technologies utilisées
- Boutons CV, GitHub, LinkedIn
- Page 404 personnalisée
- Responsive (mobile, tablette, desktop)

### Côté admin (accès protégé)
- Connexion / déconnexion sécurisée
- Dashboard avec statistiques
- Gestion des catégories (liste, création, modification, suppression)
- Édition du profil avec éditeur riche (Quill)

---

## Sécurité

- Mots de passe hashés avec `password_hash` / `password_verify`
- Sessions PHP pour l'authentification
- Token CSRF sur tous les formulaires sensibles
- Requêtes PDO préparées (protection injection SQL)
- Échappement XSS via la fonction `e()`

---

## Technologies utilisées

- PHP 8.5 (POO, namespaces, typage strict)
- MySQL / PDO
- HTML / CSS (dark theme responsive)
- JavaScript vanilla (filtre projets)
- Font Awesome (icônes)
- Git / GitHub

---

## Installation (MAMP)

1. Copier le projet dans `htdocs/portfolioVF/`
2. Importer `database/schema.sql` dans phpMyAdmin
3. Démarrer Apache et MySQL via MAMP
4. Ouvrir `http://localhost/portfolioVF/public/`
