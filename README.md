# Projet Laravel - BTS SIO SLAM E6
- Nom du projet : Epreuve_E6_Legere
- Base de données : MariaDB (drive_db)
- Tables principales :
  - clients (id, nom, prenom, email, telephone)
  - produits (id, reference, libelle, prix_ht, tva, stock)
  - tickets (id, client_id, total_ht, total_tva, total_ttc, moyen_paiement, created_at)
  - lignes_tickets (id, ticket_id, produit_id, qte, prix_unitaire_ht, tva, total_ht, total_tva, total_ttc)

- Relations Eloquent :
  - Un Client **a plusieurs** Tickets
  - Un Ticket **appartient à** un Client
  - Un Ticket **a plusieurs** LignesTicket
  - Une LigneTicket **appartient à** un Produit
  - Un Produit **peut apparaître** dans plusieurs LignesTicket

- Fonctionnalités attendues (cas d’utilisation) :
  - Client (côté site web) :
    - Consulter catalogue des produits
    - Ajouter produit au panier
    - Valider commande
    - Payer commande
    - Recevoir ticket (HTML/PDF)
  - Caissier (client lourd C# → pas Laravel)
  - Admin (dans Laravel) :
    - Gérer produits (CRUD)
    - Gérer clients (CRUD)
    - Consulter statistiques (ventes, stocks)

- Architecture : MVC Laravel
- Routes attendues :
  - /produits → liste des produits
  - /panier → gestion du panier
  - /commande → validation
  - /admin/produits → CRUD produits
  - /admin/clients → CRUD clients
  - /admin/stats → statistiques
