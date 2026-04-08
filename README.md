# Portfolio VF (TP MVC PHP)

## Objectif du projet

Créer un portfolio avec :

- une page publique unique (présentation + compétences + projets)
- une page détail d'un projet
- une interface d'administration pour gérer les données
- une architecture MVC orientée objet
- les bases de sécurité web (auth, CSRF, SQL préparé, échappement XSS)

## Avancement global

- Partie 1 : terminée
- Partie 2 : démarrée (module CRUD catégories terminé)
- Partie 3 : à faire

## État actuel (code)

Ce dépôt contient la **partie 1** du TP :

- architecture MVC en PHP orienté objet
- routage (dont route dynamique) + page 404
- authentification admin (session + CSRF + hash de mot de passe)
- affichage public sur une seule page + détail projet
- filtre JavaScript par catégorie sur l'accueil
- structure SCSS mobile-first (base)
- schéma SQL basé sur les diagrammes Merise

### Partie 2 déjà faite

- CRUD **admin catégories** complet
   - liste
   - création
   - édition
   - suppression (bloquée si projets liés)
- validation serveur simple
- try/catch sur opérations SQL
- CSRF sur formulaires admin du module catégories
- messages flash succès/erreur

## Structure

- public/ : point d'entrée web + assets
- app/ : Core, Controllers, Models, Views
- database/schema.sql : création + seed de la BDD
- diagrammes/ : vos modèles Merise

## Installation rapide (MAMP)

3. Ouvrir dans le navigateur :
   - http://localhost:8888/portfolioVF/public/
4. Connexion admin :
   - email: `admin@portfolio.local`
   - mot de passe: `password`

## Routes principales

### Public

- `/` accueil
- `/project/{id}` détail projet
- `/login` connexion admin
- `/logout` déconnexion admin

### Admin

- `/admin` dashboard
- `/admin/categories` liste catégories
- `/admin/categories/create` formulaire création
- `/admin/categories/{id}/edit` formulaire édition

## Plan de la partie 2 (prochaines tâches)

1. CRUD compétences
2. CRUD projets (avec catégorie)
3. CRUD tags
4. CRUD images (upload sécurisé)
5. CRUD profil utilisateur (avec éditeur riche Quill)

## Support de révision pour le diaporama

Tu peux reprendre ces blocs quasiment slide par slide.

### 1) Présentation du projet / contexte

- Projet de portfolio personnel administrable
- Public : recruteur / formateur
- Objectif : démontrer MVC, POO, sécurité et responsive

### 2) Merise

- Entités principales : user, project, category, skill, tag, image
- Relations :
  - un projet appartient à une catégorie
  - une catégorie possède plusieurs projets
  - un projet possède plusieurs tags et images
  - un utilisateur possède plusieurs compétences et projets

### 3) Architecture MVC

- `public/` : front controller
- `app/Core` : Router, Controller, Model, Session, Auth
- `app/Controllers` : logique HTTP
- `app/Models` : accès données PDO + relations métier
- `app/Views` : affichage

### 4) Extrait POO à présenter

- classes avec namespaces
- typage strict (`declare(strict_types=1)`)
- héritage (`Category extends Model`)
- encapsulation (propriétés protégées / privées)
- autoload via `spl_autoload_register`

### 5) Authentification

- login avec `password_verify`
- session utilisateur (`auth_user_id`)
- protection des routes admin

### 6) 404

- route non trouvée -> `ErrorController::notFound()`

### 7) Gestion d'erreurs try/catch

- utilisé sur les actions CRUD catégories (création / édition / suppression)

### 8) Sécurité

- requêtes préparées PDO
- protection XSS avec `e()`
- token CSRF sur formulaires sensibles
- contrôle d'accès sur routes admin

### 9) Éditeur riche

- à intégrer en partie 2 (Quill) sur description utilisateur

### 10) Démo à montrer

- accueil + filtre JS
- détail projet
- login / logout
- 404
- CRUD admin catégories (déjà prêt)

### 11) Version mobile

- styles mobile-first (base en place)
- montrer l'adaptation sur smartphone dans la démo

### 12) Conclusion

- points acquis : MVC, POO, sécurité de base
- reste à finaliser : CRUD restants + Quill + polish UI

## Découpage en 3 parties

1. **Partie 1 (faite)** : socle technique MVC + sécurité de base + pages publiques.
2. **Partie 2 (en cours)** : CRUD admin complet (compétences, projets, catégories, tags, images, profil + éditeur riche Quill).
3. **Partie 3** : finitions (SCSS complet, responsive final, validations avancées, polish, préparation soutenance).
