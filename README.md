# 🚀 Drive E6 – Application de Drive Supermarché
*Projet complet réalisé dans le cadre de l’épreuve E6 – BTS SIO SLAM*

<div align="center">

### **Laravel 12 · PHP 8.2 · TailwindCSS · Alpine.js · Vite**

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.0-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)

</div>

---

# 🎯 Présentation

**Drive E6** est une application Laravel reproduisant l’expérience complète d’un Drive de supermarché :
- Catalogue dynamique
- Panier en temps réel
- Promotions avancées
- Espace client + espace administrateur
- Gestion des commandes & préparation
- Architecture Laravel propre (MVC + Services)

L’objectif : démontrer des compétences web professionnelles pour l’épreuve E6.

---

# 🧩 Table des Matières

- [Fonctionnalités](#-fonctionnalités)
- [Architecture](#-architecture)
- [Modèle de données](#-modèle-de-données)
- [Stack Technique](#-stack-technique)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Comptes de Démo](#-comptes-de-démo)
- [Tests](#-tests)
- [Structure du Projet](#-structure-du-projet)
- [Auteur](#-auteur)

---

# 🚀 Fonctionnalités

## 🛒 Front-Office (Espace Client)

### Catalogue moderne
- Grille responsive
- Recherche instantanée
- Filtres dynamiques (catégorie, stock)
- Tri : A-Z, prix, nouveauté
- Badges visuels : *Promo*, *Nouveau*, *Rupture*

### Panier intelligent
- Ajout / suppression fluide (Alpine.js)
- Totaux HT / TVA / TTC en direct
- Contrôle strict des stocks
- Feedback instantané

### Promotions automatiques
- Pourcentage (ex : -20%)
- Réduction fixe
- Offres conditionnelles (ex : “2 = 1 offert”)
- Calcul automatique des économies

### Commandes
- Validation du panier
- Créneau Drive simulé
- Génération numéro unique
- Historique complet côté client

### Espace membre
- Inscription / connexion sécurisée (Laravel Breeze)
- Gestion du profil utilisateur

---

## 🛠 Back-Office (Administration)

- Dashboard synthétique
- CRUD Produits complet
- Gestion des stocks
- Gestion des promotions
- Gestion et suivi des commandes
- Interface claire et optimisée pour la rapidité

---

# 🧱 Architecture

Le projet applique rigoureusement les bonnes pratiques Laravel.

## Design Patterns utilisés
- **MVC** : séparation nette des responsabilités
- **Service Layer** :  
  - `PanierService.php` gère toute la logique métier : totaux, promotions, limites de stock, etc.
- **Injection de dépendances**
- **Validation via FormRequests**

## Sécurité intégrée
- Authentification **Laravel Breeze**
- Rôles & permissions via **Silber/Bouncer**
  - `admin` → tout accès
  - `editeur` → gestion du catalogue
  - `client` → front-office
- Protection CSRF
- Validation stricte des données

---

# 🗄 Modèle de Données

### Structure principale (MariaDB/MySQL)

| Table | Description |
|-------|-------------|
| `users` | Informations d’authentification |
| `clients` | Profil client |
| `produits` | Catalogue Drive |
| `commandes` | En-têtes de commandes |
| `lignes_commandes` | Détails des commandes |
| `promotions` | Règles promotionnelles |
| `preparations` | Suivi du traitement des commandes |

---

# 💻 Stack Technique

| Domaine | Technologie |
|---------|-------------|
| Framework | Laravel 12 |
| Backend | PHP 8.2 |
| Frontend | Blade + Alpine.js |
| UI | TailwindCSS |
| Build | Vite |
| BDD | MariaDB / MySQL |
| Auth | Laravel Breeze |
| Permissions | Bouncer |
| Seeds | Jeu de données réaliste (20 produits) |

---

# ⚙️ Prérequis

- PHP ≥ 8.2  
- Composer  
- Node.js (LTS) + NPM  
- MySQL / MariaDB  

---

# 📦 Installation

## 1️⃣ Cloner le projet
```bash
git clone https://github.com/NoanBregeon/Epreuve_E6_Legere.git
cd Epreuve_E6_Legere
```

## 2️⃣ Installer les dépendances PHP

```bash
composer install
```

## 3️⃣ Installer les dépendances JS

```bash
npm install
```

## 4️⃣ Configurer l’environnement

```bash
cp .env.example .env
```

Configurer la BDD :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## 5️⃣ Générer la clé

```bash
php artisan key:generate
```

## 6️⃣ Migrations + Seeds

```bash
php artisan migrate:fresh --seed
```

## 7️⃣ Lancer l’application

### Terminal 1 – Vite

```bash
npm run dev
```

### Terminal 2 – Serveur Laravel

```bash
php artisan serve
```

📍 Accès : **[http://localhost:8000](http://localhost:8000)**

---

# 🔑 Comptes de Démo

| Rôle    | Email                | MDP        |
| ------- | -------------------- | ---------- |
| Admin   | `admin@drive.test`   | `password` |
| Éditeur | `editeur@drive.test` | `password` |
| Client  | `user@drive.test`    | `password` |

---

# 🧪 Tests

Lancer PHPUnit :

```bash
php artisan test
```

---

# 📂 Structure du Projet

```
app/
 ├── Http/Controllers/
 ├── Models/
 ├── Services/
 └── View/Components/

database/
 ├── migrations/
 ├── seeders/
 └── factories/

resources/
 ├── views/
 ├── js/
 └── css/

routes/
 └── web.php

tests/
```

---

# 🧑‍💻 Auteur

Projet développé par **Noan Bregeon** dans le cadre de l’épreuve **E6 – BTS SIO SLAM**.

*Application pédagogique reproduisant un Drive professionnel avec Laravel 12.*
