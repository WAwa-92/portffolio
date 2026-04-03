# Portfolio VF (TP MVC PHP)

## État actuel

Ce dépôt contient la **partie 1** du TP :

- architecture MVC en PHP orienté objet
- routage (dont route dynamique) + page 404
- authentification admin (session + CSRF + hash de mot de passe)
- affichage public sur une seule page + détail projet
- filtre JavaScript par catégorie sur l'accueil
- structure SCSS mobile-first (base)
- schéma SQL basé sur les diagrammes Merise

## Structure

- public/ : point d'entrée web + assets
- app/ : Core, Controllers, Models, Views
- database/schema.sql : création + seed de la BDD
- diagrammes/ : vos modèles Merise

## Installation rapide (MAMP)

1. Créer la base via [database/schema.sql](database/schema.sql).
2. Vérifier la config DB dans [app/Config/config.php](app/Config/config.php).
3. Ouvrir dans le navigateur :
   - http://localhost:8888/portfolioVF/public/
4. Connexion admin :
   - email: `admin@portfolio.local`
   - mot de passe: `password`

## Découpage en 3 parties

1. **Partie 1 (faite)** : socle technique MVC + sécurité de base + pages publiques.
2. **Partie 2** : CRUD admin complet (compétences, projets, catégories, tags, images, profil + éditeur riche Quill).
3. **Partie 3** : finitions (SCSS complet, responsive final, validations avancées, polish, préparation soutenance).
