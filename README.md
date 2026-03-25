<div align="center">

# 🛒 DRIVE E6
### L'expérience Drive Nouvelle Génération

![Banner](https://capsule-render.vercel.app/api?type=waving&color=0ea5e9&height=200&section=header&text=Drive%20E6&fontSize=80&animation=fadeIn&fontAlignY=35&desc=Projet%20BTS%20SIO%20SLAM%20•%20Epreuve%20E6&descAlignY=55&descAlign=50)

[![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.0-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![Vite](https://img.shields.io/badge/Vite-4.0-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

<br />

**Une application e-commerce complète simulant un Drive de supermarché.**  
*Architecture MVC • Service Layer • Sécurité Avancée*

[Fonctionnalités](#-fonctionnalités-détaillées) • [Architecture](#-architecture--points-techniques) • [Installation](#-installation--démarrage)

</div>

---

## 📝 Contexte du Projet

Ce projet a été réalisé dans le cadre de l'épreuve **E6 (Parcours de Professionnalisation)** du BTS SIO option SLAM.  
L'objectif est de proposer une solution web robuste répondant à un cahier des charges précis : permettre la commande en ligne de produits alimentaires avec une gestion complexe des stocks et des promotions.

---

## 🚀 Fonctionnalités Détaillées

### 🛒 Espace Client (Front-Office)

L'interface client a été pensée pour être fluide et réactive (Mobile First).

*   **Catalogue Interactif** :
    *   Filtres par catégorie (Fruits, Boucherie, etc.).
    *   Recherche instantanée.
    *   Tri dynamique (Prix croissant/décroissant, Alphabétique).
    *   Indicateurs de stock en temps réel.
*   **Panier Intelligent (AJAX)** :
    *   Ajout/Retrait de produits sans rechargement de page (via **Alpine.js**).
    *   Contrôle de cohérence : impossible d'ajouter plus que le stock disponible.
    *   Calcul automatique des totaux (HT, TVA, TTC).
*   **Moteur de Promotions** :
    *   Application automatique des remises.
    *   Support des règles complexes : *"-20%"*, *"-5€"*, *"2 achetés = 1 offert"*.
    *   Affichage des économies réalisées.
*   **Espace Personnel** :
    *   Historique des commandes avec statut (En préparation, Prêt, Livré).
    *   Gestion du profil et sécurité.

### 🛠 Espace Administration (Back-Office)

Réservé aux employés et administrateurs, sécurisé par des rôles.

*   **Dashboard Décisionnel** : Vue d'ensemble des ventes et alertes de stock.
*   **Gestion du Catalogue** : CRUD complet des produits (Création, Modification, Suppression).
*   **Gestion des Stocks** : Mise à jour rapide des quantités.
*   **Suivi des Commandes** : Changement d'état des commandes (Validation, Préparation).

---

## 🏗 Architecture & Points Techniques

Ce projet met en avant plusieurs compétences techniques avancées.

### 1. Service Pattern (`PanierService`)
Pour éviter de surcharger les contrôleurs, toute la logique métier du panier a été isolée dans un service dédié : `App\Services\PanierService`.
*   **Responsabilité** : Calculs financiers, application des règles de promotion, vérification des stocks.
*   **Avantage** : Code réutilisable, testable et maintenable.

### 2. Modèle de Données (Relationnel)
La base de données est structurée pour garantir l'intégrité des données :
*   `Clients` 1:N `Commandes`
*   `Commandes` 1:N `Lignes_Commande`
*   `Produits` 1:N `Lignes_Commande`
*   `Produits` 1:N `Promotions`

### 3. Sécurité & Rôles (Bouncer)
L'application utilise le package **Silber/Bouncer** pour une gestion fine des permissions :
*   **Admin** : Accès total (`manage-products`, `manage-orders`, `access-dashboard`).
*   **Editeur** : Gestion du catalogue uniquement.
*   **Client** : Accès limité au Front-Office.

---

## 💻 Stack Technique

<div align="center">

| **Backend** | **Frontend** | **Data & Tools** |
| :---: | :---: | :---: |
| **Laravel 12**<br>Framework PHP | **Blade**<br>Templating Engine | **MariaDB**<br>SGBDR |
| **Bouncer**<br>ACL & Rôles | **Tailwind CSS**<br>Styling Utility-First | **Vite**<br>Asset Bundler |
| **Service Layer**<br>Logique Métier | **Alpine.js**<br>Interactivité JS | **PHPUnit**<br>Tests Unitaires |

</div>

---

## 📦 Installation & Démarrage

<details>
<summary><b>🔽 Cliquer pour dérouler le guide d'installation</b></summary>

### 1. Prérequis
*   PHP ≥ 8.2
*   Composer
*   Node.js & NPM
*   MySQL / MariaDB

### 2. Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/NoanBregeon/Epreuve_E6_Legere.git
cd Epreuve_E6_Legere

# 2. Installer les dépendances
composer install
npm install

# 3. Configuration
cp .env.example .env
# ⚠️ Editez le fichier .env pour configurer votre base de données (DB_DATABASE, DB_USERNAME, etc.)

# 4. Initialisation
php artisan key:generate
php artisan migrate:fresh --seed
```

### 3. Lancement

Il est nécessaire de lancer deux terminaux :

**Terminal 1 : Compilation des assets (Vite)**
```bash
npm run dev
```

**Terminal 2 : Serveur Web (Laravel)**
```bash
php artisan serve
```

L'application est accessible sur : `http://localhost:8000`

</details>

---

## 🧪 Tests & Qualité

Le projet inclut une suite de tests pour valider le fonctionnement critique.

```bash
# Lancer les tests unitaires et fonctionnels
php artisan test
```

---

## 🔑 Comptes de Démonstration

Le `DatabaseSeeder` génère des données réalistes (20 produits) et les comptes suivants :

| Rôle | Email | Mot de passe | Périmètre |
| :--- | :--- | :--- | :--- |
| 👑 **Admin** | `admin@drive.test` | `password` | Accès complet (Back + Front) |
| ✏️ **Éditeur** | `editeur@drive.test` | `password` | Gestion catalogue uniquement |
| 👤 **Client** | `user@drive.test` | `password` | Parcours d'achat classique |

---

## 📂 Structure du Projet

Voici les dossiers clés pour naviguer dans le code :

```bash
Epreuve_E6_Legere/
├── app/
│   ├── Services/
│   │   └── PanierService.php   # 🧠 Cœur du réacteur (Calculs, Promos)
│   ├── Http/Controllers/       # 🎮 Orchestration des requêtes
│   └── Models/                 # 🗃️ Objets Métier (Produit, Commande...)
├── database/
│   ├── migrations/             # 📐 Schéma BDD
│   └── seeders/                # 🌱 Jeu de données de test
├── resources/
│   ├── views/                  # 🎨 Vues Blade
│   └── js/                     # ✨ Logique Front (Alpine.js)
└── tests/                      # ✅ Tests automatisés
```

---

<div align="center">

### 👨‍💻 Auteur

**Noan Bregeon**  
*Projet développé pour le BTS SIO SLAM - Session 2026*

</div>
