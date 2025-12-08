# 🛒 Drive E6 - Application de Drive Supermarché

Bienvenue sur le projet **Drive E6**, une application web complète de type "Drive" permettant aux clients de faire leurs courses en ligne, de gérer leur panier et de passer commande. Ce projet a été réalisé dans le cadre de l'épreuve E6.

## 🚀 Fonctionnalités

### 👤 Partie Client
- **Catalogue Produits** : Consultation des produits avec filtres (catégorie, prix, stock) et tri.
- **Recherche** : Barre de recherche pour trouver rapidement un produit.
- **Fiche Produit** : Détails complets, image, prix, stock et promotions.
- **Panier Dynamique** : 
  - Ajout rapide depuis la liste ou la fiche produit.
  - Gestion des quantités (boutons + / -).
  - Calcul automatique du total TTC et des remises.
- **Promotions** : Système de promotions (pourcentage, montant fixe, offre "2 achetés = 1 offert").
- **Commande** : Processus de validation de commande et historique des commandes passées.
- **Compte Client** : Gestion du profil et authentification sécurisée.

### 🛠 Partie Administration
- **Dashboard** : Vue d'ensemble de l'activité.
- **Gestion des Produits** : Ajout, modification et suppression de produits.
- **Gestion des Stocks** : Mise à jour des quantités disponibles.

## 💻 Stack Technique

Ce projet utilise des technologies modernes et robustes :

- **Backend** : [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Frontend** : 
  - [Blade](https://laravel.com/docs/blade) (Moteur de template)
  - [Tailwind CSS](https://tailwindcss.com) (Framework CSS utilitaire)
  - [Alpine.js](https://alpinejs.dev) (Interactivité légère côté client)
- **Base de données** : MySQL / MariaDB
- **Authentification** : Laravel Breeze
- **Gestion des Rôles** : [Silber/Bouncer](https://github.com/JosephSilber/bouncer)
- **Outils de dev** : Vite, Composer, NPM

## ⚙️ Prérequis

Avant de commencer, assurez-vous d'avoir installé :
- PHP >= 8.2
- Composer
- Node.js & NPM
- Un serveur de base de données (MySQL ou MariaDB)

## 📦 Installation

Suivez ces étapes pour installer le projet localement :

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/NoanBregeon/Epreuve_E6_Legere.git
   cd Epreuve_E6_Legere
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Configuration de l'environnement**
   Dupliquez le fichier d'exemple et configurez vos accès BDD :
   ```bash
   cp .env.example .env
   ```
   Ouvrez le fichier `.env` et modifiez les lignes suivantes selon votre configuration locale :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nom_de_votre_base
   DB_USERNAME=votre_utilisateur
   DB_PASSWORD=votre_mot_de_passe
   ```

5. **Générer la clé d'application**
   ```bash
   php artisan key:generate
   ```

6. **Base de données & Jeu de données**
   Lancez les migrations et les seeders pour créer les tables et remplir la base avec **1000 produits** de test, des utilisateurs et des promotions.
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Lancer le serveur de développement**
   Dans un premier terminal (pour compiler les assets en temps réel) :
   ```bash
   npm run dev
   ```
   Dans un second terminal (pour lancer le serveur Laravel) :
   ```bash
   php artisan serve
   ```

   L'application est maintenant accessible sur `http://localhost:8000`.

## 🔑 Comptes de Démonstration

Le `DatabaseSeeder` crée automatiquement les comptes suivants pour tester l'application :

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| **Administrateur** | `admin@drive.test` | `password` |
| **Éditeur** | `editeur@drive.test` | `password` |
| **Client** | `user@drive.test` | `password` |

## 📂 Structure du Projet

Voici un aperçu rapide de l'arborescence :

- `app/Models` : Modèles Eloquent (Produit, Commande, User, etc.)
- `app/Http/Controllers` : Logique métier (PanierController, ProduitsController...)
- `app/Services` : Services métier (ex: `PanierService` pour la logique du panier)
- `database/migrations` : Schéma de la base de données
- `database/seeders` : Jeux de données (incluant la génération de 1000 produits)
- `resources/views` : Vues Blade (Frontend)
- `routes/web.php` : Définition des routes de l'application

## 📝 Auteur

Projet réalisé par **Noan Bregeon**.

---
*Ce projet est destiné à des fins éducatives dans le cadre d'une épreuve scolaire.*
