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

[Fonctionnalités](#-fonctionnalités-clés) • [Installation](#-installation--démarrage) • [Démo](#-comptes-de-démonstration)

</div>

---

## ⚡️ Aperçu Rapide

**Drive E6** n'est pas qu'un simple site e-commerce. C'est une solution complète intégrant :
> 🛍️ **Front-Office Client** : Catalogue, Panier AJAX, Promotions complexes.  
> ⚙️ **Back-Office Admin** : Gestion des stocks, CRUD produits, Suivi des commandes.

---

## 🚀 Fonctionnalités Clés

### 🛒 Expérience Client (Front-Office)

| Module | Description |
| :--- | :--- |
| **Catalogue Intelligent** | Filtres dynamiques, Recherche instantanée, Tri par prix/nom. |
| **Panier Live** | Ajout/Retrait sans rechargement (Alpine.js), Calculs TTC temps réel. |
| **Promotions Smart** | Gestion des règles : *"-20%"*, *"-5€"*, *"2 achetés = 1 offert"*. |
| **Espace Perso** | Historique de commandes, Profil, Authentification sécurisée. |

### 🛠 Administration (Back-Office)

| Module | Description |
| :--- | :--- |
| **Dashboard** | Vue d'ensemble des KPIs (Ventes, Ruptures). |
| **Gestion Produits** | CRUD complet, Upload d'images, Gestion des stocks. |
| **Commandes** | Suivi du statut, Préparation des commandes. |

---

## 🏗 Architecture & Tech Stack

Ce projet est construit sur des bases solides pour garantir maintenabilité et performance.

<div align="center">

| **Backend** | **Frontend** | **Data & Tools** |
| :---: | :---: | :---: |
| **Laravel 12**<br>Framework PHP | **Blade**<br>Templating | **MariaDB**<br>Base de données |
| **Bouncer**<br>Gestion des Rôles | **Tailwind CSS**<br>Styling Utility-First | **Vite**<br>Bundler Rapide |
| **Service Layer**<br>Logique Métier | **Alpine.js**<br>Interactivité Légère | **Composer / NPM**<br>Package Managers |

</div>

### 🔐 Sécurité
*   Authentification via **Laravel Breeze**.
*   Protection **CSRF** & Validation **FormRequest**.
*   Isolation des rôles (Admin vs Client).

---

## 📦 Installation & Démarrage

<details>
<summary><b>🔽 Cliquer pour voir les étapes d'installation</b></summary>

### 1. Prérequis
*   PHP ≥ 8.2
*   Composer
*   Node.js & NPM
*   MySQL / MariaDB

### 2. Installation

```bash
# Cloner le repo
git clone https://github.com/NoanBregeon/Epreuve_E6_Legere.git
cd Epreuve_E6_Legere

# Dépendances
composer install
npm install

# Environnement
cp .env.example .env
# (Configurer la BDD dans le fichier .env)

# Clé & BDD
php artisan key:generate
php artisan migrate:fresh --seed
```

### 3. Lancement

Ouvrez deux terminaux :

```bash
# Terminal 1 : Assets
npm run dev
```

```bash
# Terminal 2 : Serveur
php artisan serve
```

Accédez à : `http://localhost:8000` 🚀

</details>

---

## 🔑 Comptes de Démonstration

Pour tester l'application immédiatement :

| Rôle | Email | Mot de passe | Accès |
| :--- | :--- | :--- | :--- |
| 👑 **Admin** | `admin@drive.test` | `password` | Accès complet |
| ✏️ **Éditeur** | `editeur@drive.test` | `password` | Gestion catalogue |
| 👤 **Client** | `user@drive.test` | `password` | Achat & Panier |

---

## 📂 Structure du Projet

```bash
Epreuve_E6_Legere/
├── app/
│   ├── Services/PanierService.php  # 🧠 Cœur de la logique panier
│   ├── Http/Controllers/           # 🎮 Contrôleurs
│   └── Models/                     # 🗃️ Modèles Eloquent
├── database/                       # 💾 Migrations & Seeders
├── resources/
│   ├── views/                      # 🎨 Vues Blade
│   └── js/                         # ✨ Scripts Alpine.js
└── routes/web.php                  # 🛣️ Routes
```

---

<div align="center">

### 👨‍💻 Auteur

**Noan Bregeon**  
*Projet BTS SIO SLAM - Epreuve E6*

</div>
