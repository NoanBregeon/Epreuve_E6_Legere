# DRIVE E6 - Documentation Technique Complete (BTS SIO SLAM)

## 0. Contexte professionnel et objectifs

Projet realise dans le cadre de l'epreuve E6 du BTS SIO SLAM.

Problematique metier:
- Digitaliser un service de type drive de supermarche.
- Assurer un parcours client fluide et un suivi interne des commandes.

Objectifs techniques:
- Application web MVC maintenable.
- Gestion de roles et securite d'acces.
- Persistance relationnelle fiable.
- Deploiement automatisable.

---

## 1. Perimetre technique du projet

## 1.1 Fonctionnalites couvrees
- Catalogue produits avec recherche/filtrage/tri.
- Panier session avec calcul de remises.
- Validation de commande avec creneau et paiement.
- Ecriture double commande et ticket comptable.
- Administration produits.
- Authentification et verification email.

## 1.2 Hors perimetre actuel
- Paiement CB reel (simulation).
- Gestion complete des promotions en back-office (partielle).
- Workflow complet de preparation avec ecrans dedies (partiel).

---

## 2. Stack technique et dependances

## 2.1 Backend
- PHP ^8.2 (composer).
- Laravel 12.
- Bouncer pour ACL (roles/abilities).

## 2.2 Frontend
- Blade.
- Tailwind CSS.
- Alpine.js.
- Vite.

## 2.3 Base de donnees
- MariaDB 10.11 (Docker).

## 2.4 Qualite et outillage
- PHPUnit.
- PHPStan + Larastan.
- Laravel Pint.

---

## 3. Architecture logicielle

Pattern principal:
- MVC Laravel + Service Layer.

Decoupage:
- Couche presentation: vues Blade.
- Couche controle: controllers HTTP.
- Couche metier: services (PanierService).
- Couche donnees: modeles Eloquent + migrations.

Flux standard:
1. Route web.
2. Middleware (auth, admin, csrf).
3. Controller.
4. Service metier.
5. Eloquent/DB.
6. Vue ou redirection.

---

## 4. Architecture infrastructure et execution

Docker Compose declare 3 services:
- app: image personnalisee PHP/Apache.
- nginx: reverse proxy HTTP (port 80).
- db: MariaDB avec volume persistant.

Points importants:
- Reseau dedie laravel_network.
- Healthcheck base de donnees.
- Montage du code source dans les conteneurs pour dev.

Observation technique:
- Dockerfile utilise php:8.4-apache alors que composer cible php ^8.2.
- Ce n'est pas bloquant, mais doit etre coherent avec la politique de version de l'equipe.

---

## 5. Configuration applicative

Variables critiques:
- APP_ENV, APP_DEBUG, APP_KEY, APP_URL.
- DB_*.
- MAIL_*.
- CACHE_DRIVER, SESSION_DRIVER, QUEUE_CONNECTION.

Bonnes pratiques:
- APP_DEBUG=false en production.
- Aucun secret en dur dans le code.
- Caches Laravel actifs en production.

---

## 6. Cartographie des routes et cas d'utilisation

## 6.1 Routes front-office
- GET / : accueil.
- GET /produits : listing produits.
- GET /promotions : listing promotions.
- GET /produits/{id} : detail produit.
- GET /panier : affichage panier.
- POST /panier/{id}/ajouter : ajout article.
- PATCH /panier/{id} : modification quantite.
- DELETE /panier/{id} : suppression ligne.

## 6.2 Routes commande
- GET /commande/create (auth): finalisation.
- POST /commande (auth): creation commande.
- GET /commande (auth): liste commandes utilisateur.
- GET /commande/{id}: detail commande avec controle d'acces.
- GET /commande/confirmation/{id}: confirmation ticket legacy.

## 6.3 Routes securite compte
- register, login, forgot-password, reset-password.
- verify-email, confirm-password, logout.
- profile (edit/update/delete).

## 6.4 Routes admin
- Prefixe /admin + auth + AdminMiddleware.
- GET /admin: dashboard.
- CRUD produits (create/store/edit/update/destroy).

---

## 7. Description des modules techniques

## 7.1 ProduitsController
- Catalogue public (filtres, tri, pagination).
- Chargement eager des promotions associees.
- CRUD produit reserve admin via StoreProduitRequest.

## 7.2 PanierController
- Interface HTTP du panier.
- Delegue la logique au PanierService.
- Gere feedback utilisateur via messages de session.

## 7.3 CommandeController
- Affichage commandes du client.
- Generation des creneaux de retrait.
- Validation et creation transactionnelle commande + ticket + lignes.
- Decrementation du stock a la validation.
- Envoi email de confirmation (non bloquant).

## 7.4 AdminController
- Calcul des statistiques de synthese:
  - nombre produits,
  - nombre tickets,
  - nombre clients,
  - chiffre d'affaires total.

## 7.5 AdminMiddleware
- Controle authentification.
- Controle role admin via User::isAdmin().

---

## 8. Service metier central: PanierService

Responsabilites:
- Stockage du panier en session.
- Gestion ajout/modification/suppression.
- Calcul des totaux HT/TVA/TTC.
- Application des promotions.

Algorithmes de remise:
- pourcentage: remise proportionnelle au montant de ligne TTC.
- montant: remise fixe par unite.
- offert: calcul par lots avec floor(quantite/min_quantite).

Optimisation:
- Cache des promotions (cle promotions_all, 1h).

Regles de controle:
- Refus ajout produit inexistant ou hors stock.
- Plafonnement quantite au stock reel.

---

## 9. Modele de donnees relationnel

## 9.1 Tables principales

users:
- id, name, email, password, is_admin, role, timestamps, etc.

clients:
- id, nom, prenom, email unique, telephone.

produits:
- id, reference unique, libelle, description, image, categorie, prix_ht, tva, stock, actif.

promotions:
- id, produit_id nullable, type_promo, valeur_promo, min_quantite + champs visuels (titre, badge, image, etc.).

commandes:
- id, client_id nullable, numero_commande unique, statut, creneau_retrait, total_ht, total_ttc, note_interne.

lignes_commandes:
- id, commande_id, produit_id, quantite_demandee, quantite_preparee, prix_unitaire_ht, statut_ligne, note.

tickets:
- id, client_id nullable, user_id nullable, total_ht, total_tva, total_ttc, moyen_paiement, statut.

lignes_tickets:
- id, ticket_id, produit_id, qte, prix_unitaire_ht, tva, total_ht, total_ttc.

preparations:
- id, commande_id, employe_id, statut, date_debut, date_fin.

ACL Bouncer:
- roles, abilities, permissions, assigned_roles.

## 9.2 Integrite referentielle
- FK avec cascade ou restriction selon logique metier.
- Index sur statut/creneau/statut_ligne dans les tables transactionnelles.

---

## 10. Securite applicative

## 10.1 Authentification
- Laravel auth standard + verification email active (User implement MustVerifyEmail).

## 10.2 Autorisation
- Role admin via Bouncer et champ legacy is_admin.
- Middleware admin pour isoler le back-office.

## 10.3 Validation des entrees
- FormRequest sur le CRUD produit.
- Validation sur creation commande (creneau, paiement).

## 10.4 Mesures complementaires
- CSRF Laravel.
- Password hash natif Laravel.
- Controle type/taille fichier image.

---

## 11. Flux metier critiques

## 11.1 Flux commande client
1. Constitution panier en session.
2. Finalisation (creneau, paiement, note).
3. Ouverture transaction DB.
4. Creation commande Drive.
5. Creation ticket comptable.
6. Creation lignes commande et lignes ticket.
7. Decrementation stock.
8. Commit transaction.
9. Vidage panier.
10. Tentative envoi email.

## 11.2 Flux administration catalogue
1. Admin authentifie accede a /admin.
2. Cree ou modifie un produit.
3. Validation serveur via StoreProduitRequest.
4. Upload image sur stockage public.

---

## 12. CI/CD et deploiement

Pipeline GitHub Actions:
- Declenchement: push sur main.
- Action SSH vers serveur Debian.
- git pull.
- docker compose down/up --build.
- composer install no-dev.
- php artisan migrate --force.
- caches config/route/view.
- correction permissions storage + bootstrap/cache.

---

## 13. Installation, exploitation, maintenance

## 13.1 Installation locale type
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
docker compose up -d
php artisan migrate:fresh --seed
npm run dev
```

## 13.2 Tests
```bash
php artisan test
php artisan test --coverage
```

## 13.3 Qualite statique
```bash
./vendor/bin/phpstan analyse
./vendor/bin/pint
```

## 13.4 Incident courant assets manquants
Symptome:
- manifest Vite introuvable.

Correction:
- npm run build.

---

## 14. Points de vigilance et dette technique

1. Cohabitation logique client/user dans la gestion des commandes.
2. Controle d'acces detail commande base sur client_id vs Auth::id, a verifier selon modele metier reel.
3. Promotions melangent champs marketing (bannieres) et logique tarifaire.
4. Paiement CB actuellement simule.
5. Peu de traces d'ecrans dedies au cycle de preparation (preparations).

Ces points sont exploitables pour la partie ameliorations/propositions a l'oral BTS.

---

## 15. Ameliorations techniques proposees (argumentaire BTS)

Priorite 1:
- Clarifier l'identite client (unifier user/client ou documenter la correspondance).
- Renforcer les tests de securite sur les acces commandes.
- Passer les envois email en queue asynchrone.

Priorite 2:
- Modeliser les statuts commande via enum/State Pattern.
- Ajouter audit trail des changements de statut.
- Industrialiser gestion back-office des promotions.

Priorite 3:
- Exposer des indicateurs operationnels avances.
- Ajouter strategie de sauvegarde/restauration documentee.

---

## 16. Annexes utiles

Comptes de demo seedes:
- admin@drive.test / password
- editeur@drive.test / password
- user@drive.test / password

Commandes d'administration:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan cache:clear
docker compose logs -f app
docker compose logs -f nginx
docker compose logs -f db
```

---

## 17. Conclusion technique

Cette documentation couvre:
- contexte professionnel,
- architecture,
- routes/modules,
- donnees,
- securite,
- exploitation,
- maintenance,
- points d'amelioration.

Elle est adaptee a un dossier de projet BTS SIO SLAM (partie technique complete).
