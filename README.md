# 🛒 Drive E6 - Application de Drive Supermarché

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.0-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)

Bienvenue sur le projet **Drive E6**, une application web complète simulant un service de "Drive" de supermarché. Ce projet a été conçu et développé dans le cadre de l'épreuve E6 du BTS SIO (SLAM).

Il met en œuvre une architecture MVC robuste, une gestion avancée du panier via des Services, et une interface utilisateur moderne et réactive.

---

## 📑 Table des Matières

- [Fonctionnalités](#-fonctionnalités)
- [Architecture & Conception](#-architecture--conception)
- [Modèle de Données](#-modèle-de-données)
- [Stack Technique](#-stack-technique)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Comptes de Démonstration](#-comptes-de-démonstration)
- [Tests](#-tests)
- [Structure du Projet](#-structure-du-projet)
- [Auteur](#-auteur)

---

## 🚀 Fonctionnalités

### 👤 Espace Client (Front-Office)

*   **Catalogue Interactif** :
    *   Affichage des produits sous forme de grille.
    *   **Filtres dynamiques** : par catégorie, par disponibilité (en stock).
    *   **Tri** : par nom (A-Z), prix croissant/décroissant.
    *   **Recherche** : Barre de recherche instantanée par nom de produit.
    *   **Indicateurs visuels** : Badges "Promo", "Rupture de stock", "Nouveau".

*   **Gestion du Panier Avancée** :
    *   Ajout rapide depuis la liste des produits (AJAX/Formulaire).
    *   **Ajustement des quantités** : Boutons `+` et `-` avec mise à jour automatique du total.
    *   Calcul en temps réel du total HT, TVA et TTC.
    *   **Gestion des Stocks** : Impossible d'ajouter plus que la quantité disponible.

*   **Système de Promotions** :
    *   Support de plusieurs types de remises :
        *   *% de réduction* (ex: -20%).
        *   *Montant fixe* (ex: -5€).
        *   *Offre conditionnelle* (ex: 2 achetés = 1 offert).
    *   Calcul automatique et affichage des économies réalisées dans le panier.

*   **Processus de Commande** :
    *   Validation du panier.
    *   Choix du créneau de retrait (simulé).
    *   Confirmation de commande et génération d'un numéro de commande unique.
    *   Historique des commandes passées accessible dans l'espace client.

*   **Espace Membre** :
    *   Inscription et Connexion sécurisée.
    *   Gestion du profil (Nom, Email, Mot de passe).

### 🛠 Espace Administration (Back-Office)

*   **Tableau de Bord** : Vue synthétique de l'activité (nombre de commandes, produits en rupture, etc.).
*   **Gestion des Produits (CRUD)** : Créer, Lire, Mettre à jour, Supprimer des produits.
*   **Gestion des Stocks** : Ajustement manuel des quantités.
*   **Gestion des Promotions** : Création et activation des campagnes promotionnelles.

---

## 🏗 Architecture & Conception

Le projet respecte scrupuleusement les standards de développement Laravel.

### Patron de Conception (Design Pattern)
*   **MVC (Modèle-Vue-Contrôleur)** : Séparation claire des responsabilités.
*   **Service Layer** : La logique métier complexe (notamment le calcul du panier et des promotions) est déportée dans `App\Services\PanierService.php` pour alléger les contrôleurs et faciliter la réutilisation.
*   **Dependency Injection** : Injection des services et repositories dans les contrôleurs.

### Sécurité
*   **Authentification** : Gérée par **Laravel Breeze**.
*   **Autorisation** : Gestion des rôles et permissions via le package **Silber/Bouncer**.
    *   Rôle `admin` : Accès total.
    *   Rôle `editeur` : Gestion du catalogue.
    *   Rôle `client` : Accès front-office uniquement.
*   **Protection CSRF** : Active sur tous les formulaires.
*   **Validation** : Validation stricte des données entrantes (FormRequests).

---

## 🗄 Modèle de Données

La base de données relationnelle (MySQL/MariaDB) s'articule autour des tables principales suivantes :

*   `users` : Comptes utilisateurs (Clients et Admins).
*   `clients` : Informations détaillées des clients (liés aux users).
*   `produits` : Catalogue (Reference, Libelle, Prix, Stock, Image...).
*   `commandes` : Entêtes de commandes (Date, Statut, Total).
*   `lignes_commandes` : Détail des produits par commande.
*   `promotions` : Règles de remises applicables.
*   `preparations` : Suivi de la préparation des commandes en magasin.

---

## 💻 Stack Technique

| Domaine | Technologie | Usage |
| :--- | :--- | :--- |
| **Backend** | **PHP 8.2** | Langage serveur |
| **Framework** | **Laravel 12** | Framework PHP robuste |
| **Base de données** | **MariaDB / MySQL** | Persistance des données |
| **Frontend** | **Blade** | Moteur de template |
| **Styling** | **Tailwind CSS 3** | Framework CSS utilitaire |
| **Interactivité** | **Alpine.js** | Javascript léger pour l'UI (Dropdowns, Modales) |
| **Build Tool** | **Vite** | Compilation des assets (HMR) |
| **Gestion de paquets** | **Composer** & **NPM** | Dépendances PHP et JS |

---

## ⚙️ Prérequis

Avant de démarrer, assurez-vous d'avoir l'environnement suivant :

*   [PHP](https://www.php.net/) >= 8.2
*   [Composer](https://getcomposer.org/)
*   [Node.js](https://nodejs.org/) (LTS) & NPM
*   Un serveur de base de données (MySQL, MariaDB ou SQLite)

---

## 📦 Installation

Suivez ces étapes pour déployer le projet en local :

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/NoanBregeon/Epreuve_E6_Legere.git
    cd Epreuve_E6_Legere
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Installer les dépendances JavaScript**
    ```bash
    npm install
    ```

4.  **Configuration de l'environnement**
    Copiez le fichier d'exemple `.env` :
    ```bash
    cp .env.example .env
    ```
    Ouvrez le fichier `.env` et configurez vos accès à la base de données :
    ```env
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```

5.  **Générer la clé d'application**
    ```bash
    php artisan key:generate
    ```

6.  **Migration et Jeu de Données (Seeding)**
    Cette commande va créer les tables et générer **1000 produits** aléatoires ainsi que les comptes de test.
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Lancer l'application**
    Vous aurez besoin de deux terminaux :

    *Terminal 1 (Compilation des assets)* :
    ```bash
    npm run dev
    ```

    *Terminal 2 (Serveur Web)* :
    ```bash
    php artisan serve
    ```

    Accédez à l'application via : `http://localhost:8000`

---

## 🔑 Comptes de Démonstration

Le `DatabaseSeeder` génère automatiquement ces comptes pour faciliter vos tests :

| Rôle | Email | Mot de passe | Accès |
| :--- | :--- | :--- | :--- |
| **Administrateur** | `admin@drive.test` | `password` | Back-Office complet |
| **Éditeur** | `editeur@drive.test` | `password` | Gestion produits |
| **Client** | `user@drive.test` | `password` | Front-Office (Achat) |

---

## 🧪 Tests

Le projet inclut des tests (Feature/Unit) pour garantir la stabilité.
Pour lancer la suite de tests PHPUnit :

```bash
php artisan test
```

---

## 📂 Structure du Projet

Aperçu de l'arborescence des fichiers clés :

```
Epreuve_E6_Legere/
├── app/
│   ├── Http/Controllers/   # Contrôleurs (Panier, Produits, Commande...)
│   ├── Models/             # Modèles Eloquent (Produit, User...)
│   ├── Services/           # Logique métier (PanierService.php)
│   └── View/Components/    # Composants Blade
├── database/
│   ├── factories/          # Usines à données (ProduitFactory)
│   ├── migrations/         # Schémas des tables
│   └── seeders/            # Remplissage de la BDD
├── resources/
│   ├── css/                # Styles Tailwind
│   ├── js/                 # Scripts Alpine.js
│   └── views/              # Vues Blade (layouts, produits, panier...)
├── routes/
│   └── web.php             # Définition des routes URL
└── tests/                  # Tests automatisés
```

---

## 📝 Auteur

Projet réalisé par **Noan Bregeon**.

*Ce projet est destiné à des fins éducatives et de démonstration de compétences techniques.*
