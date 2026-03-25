# DRIVE E6 - Documentation Utilisateur Complete (BTS SIO SLAM)

## 0. Contexte du projet

Drive E6 est une application web de type supermarche drive realisee dans le cadre d'un BTS SIO option SLAM.

Objectif metier:
- Permettre a un client de commander en ligne des produits alimentaires.
- Permettre au personnel du magasin de gerer le catalogue et le suivi des commandes.

Objectif pedagogique BTS:
- Mettre en oeuvre une application web multi-profils.
- Integrer authentification, autorisations, persistance des donnees, securite et qualite.

---

## 1. Public cible

### 1.1 Client final
- Consulte le catalogue.
- Ajoute des produits au panier.
- Passe commande avec creneau de retrait.
- Suit l'etat de sa commande.

### 1.2 Employe editeur
- Gere le catalogue produits.
- Met a jour les stocks et les informations produits.

### 1.3 Administrateur
- Dispose des droits d'administration.
- Accede au tableau de bord.
- Gere les produits en back-office.

---

## 2. Perimetre fonctionnel global

Fonctionnalites principales disponibles sur le site:
- Accueil vitrine avec mise en avant.
- Catalogue avec recherche, filtres et tri.
- Fiche produit detaillee.
- Panier dynamique avec calcul des remises.
- Tunnel de commande (authentification requise pour validation).
- Historique et detail des commandes.
- Espace compte (profil et securite).
- Espace administration (produits + statistiques).

---

## 3. Prerequis pour l'utilisateur

- Navigateur web moderne.
- JavaScript active.
- Connexion internet stable.
- Adresse email valide pour le compte et les notifications.

---

## 4. Cartographie complete des pages du site

## 4.1 Pages publiques (sans connexion)

| URL | Nom de page | Objectif | Actions principales |
|---|---|---|---|
| / | Accueil | Presenter le service Drive E6 | Aller au catalogue, consulter les promotions mises en avant |
| /produits | Catalogue | Lister les produits actifs | Rechercher, filtrer, trier, ouvrir une fiche, ajouter au panier |
| /promotions | Promotions | Afficher les produits avec promotions | Consulter les offres et ajouter au panier |
| /produits/{id} | Fiche produit | Montrer le detail d'un produit | Voir prix/stock/description, ajouter au panier |
| /panier | Panier | Afficher et modifier le panier | Modifier quantites, supprimer article, voir totaux et remises |
| /login | Connexion | Authentifier un utilisateur | Saisir email/mot de passe |
| /register | Inscription | Creer un compte | Saisir informations de compte |
| /forgot-password | Mot de passe oublie | Demarrer la reinitialisation | Demander lien email |
| /reset-password/{token} | Nouveau mot de passe | Finaliser reinitialisation | Definir nouveau mot de passe |

## 4.2 Pages accessibles apres connexion

| URL | Nom de page | Profil | Objectif |
|---|---|---|---|
| /commande/create | Finaliser commande | Client connecte | Choisir creneau et paiement puis confirmer |
| /commande | Mes commandes | Client connecte | Voir l'historique et les statuts |
| /commande/{id} | Detail commande | Client proprietaire ou cas invite autorise | Voir detail lignes, montants, statut |
| /commande/confirmation/{id} | Confirmation ticket | Proprietaire autorise | Visualiser ticket de confirmation |
| /profile | Mon compte | Utilisateur connecte | Modifier profil, mot de passe, suppression compte |
| /dashboard | Dashboard utilisateur | Utilisateur verifie | Ecran de synthese applicatif |
| /verify-email | Verification email | Utilisateur connecte non verifie | Verifier adresse email |
| /confirm-password | Confirmation mot de passe | Utilisateur connecte | Confirmer identite avant action sensible |

## 4.3 Pages administration (droits admin)

| URL | Nom de page | Objectif |
|---|---|---|
| /admin | Tableau de bord admin | Visualiser KPI (produits, commandes, clients, CA) |
| /admin/produits/create | Creer produit | Ajouter un nouveau produit |
| /admin/produits/{produit}/edit | Modifier produit | Mettre a jour fiche produit |

Actions admin associees:
- Creation produit (POST /admin/produits).
- Mise a jour produit (PUT /admin/produits/{produit}).
- Suppression produit (DELETE /admin/produits/{produit}).

---

## 5. Parcours utilisateur detaille

## 5.1 Parcours client de A a Z

1. Arrivee sur la page d'accueil.
2. Navigation vers le catalogue.
3. Recherche d'un produit, filtrage categorie, tri prix/nom.
4. Consultation de fiche produit.
5. Ajout au panier.
6. Verification des remises automatiques dans le panier.
7. Connexion ou inscription si necessaire.
8. Finalisation de commande:
	 - choix creneau,
	 - choix paiement (CB ou sur place),
	 - validation.
9. Consultation du detail commande.
10. Suivi du statut jusqu'au retrait.

## 5.2 Parcours employe/admin

1. Connexion avec compte autorise.
2. Acces a /admin.
3. Consultation des indicateurs.
4. Creation ou modification de produits.
5. Ajustement du stock pour eviter les ruptures.

---

## 6. Fonctionnement ecran par ecran

## 6.1 En-tete de navigation (global)

Elements disponibles:
- Liens connexion/inscription si visiteur.
- Liens mes commandes, mon compte, deconnexion si connecte.
- Barre de recherche produit.
- Bouton panier avec compteur quantite et total TTC courant.
- Raccourcis categories et promotions.

## 6.2 Catalogue produits

Fonctions:
- Recherche texte sur le libelle.
- Filtre categorie.
- Filtre produits en stock.
- Tri prix croissant/decroissant ou alphabetique.
- Pagination.

Resultat attendu:
- Afficher uniquement les produits actifs.

## 6.3 Fiche produit

Informations affichees:
- Reference et libelle.
- Description.
- Prix HT, TVA, prix TTC.
- Stock disponible.
- Image produit.

Action principale:
- Ajout au panier.

## 6.4 Panier

Informations affichees:
- Liste articles avec quantites.
- Total HT, TVA, TTC.
- Detail des remises par produit.

Actions:
- Modifier quantite.
- Supprimer article.
- Poursuivre vers validation commande.

## 6.5 Finalisation commande

Champs obligatoires:
- Creneau de retrait (date future).
- Moyen de paiement (SUR_PLACE ou CB).

Champs optionnels:
- Note interne.

Sortie attendue:
- Message de confirmation.
- Numero de commande genere automatiquement (format CMD-...)

## 6.6 Mes commandes

Fonctions:
- Lister commandes du client connecte.
- Trier par date recente.
- Ouvrir detail de chaque commande.

## 6.7 Mon compte

Fonctions:
- Modifier nom/email.
- Changer mot de passe.
- Supprimer compte utilisateur.

---

## 7. Regles metier visibles pour l'utilisateur

## 7.1 Regles de stock
- Produit avec stock 0: non commandable.
- Quantite panier plafonnee au stock disponible.

## 7.2 Regles promotions
- Application automatique au panier.
- Trois types utilises:
	- pourcentage,
	- montant,
	- offert.

## 7.3 Regles de commande
- Validation impossible si panier vide.
- Creneau obligatoire et date future.
- Paiement obligatoire.

## 7.4 Regles d'acces
- Espace admin reserve aux administrateurs.
- Consultation de commande limitee au proprietaire autorise.

---

## 8. Tableau des statuts et interpretation utilisateur

| Statut | Signification cote client |
|---|---|
| A_PREPARER | Commande enregistree et en attente de traitement |
| EN_PREPARATION | Equipe magasin en cours de preparation |
| PRET | Commande disponible au retrait |
| VALIDE (ticket) | Ticket comptable valide |

---

## 9. FAQ utilisateur complete

Question: Puis-je commander sans compte ?
Reponse: Le panier est accessible, mais la validation de commande demande une authentification.

Question: Pourquoi un article disparait du panier ?
Reponse: Si la quantite demandee depasse le stock, le systeme ajuste automatiquement au stock disponible.

Question: Je ne vois pas ma commande, que faire ?
Reponse: Verifier que vous etes connecte avec le bon compte email puis ouvrir Mes commandes.

Question: Le paiement CB est-il reel ?
Reponse: Dans ce projet, le paiement CB est simule pour l'exercice.

Question: Quand recois-je la confirmation ?
Reponse: Une confirmation est envoyee apres creation de la commande (si l'envoi email est disponible).

---

## 10. Depannage utilisateur

## 10.1 Impossible de se connecter
1. Verifier email/mot de passe.
2. Utiliser Mot de passe oublie.
3. Verifier reception email de reset.

## 10.2 Panier non mis a jour
1. Actualiser la page.
2. Vider cache navigateur.
3. Tester en navigation privee.

## 10.3 Erreur a la validation commande
1. Verifier panier non vide.
2. Verifier creneau valide.
3. Verifier choix du moyen de paiement.

## 10.4 Pas d'email de confirmation
1. Verifier spam.
2. Verifier email de compte.
3. Contacter support avec numero de commande.

---

## 11. Accessibilite et bonnes pratiques utilisateur

- Utiliser des mots de passe robustes.
- Se deconnecter sur poste partage.
- Verifier les montants avant validation.
- Conserver le numero de commande jusqu'au retrait.

---

## 12. Donnees personnelles (vue utilisateur)

Donnees manipulees:
- Identite de compte.
- Historique de commandes.
- Informations necessaires au retrait.

Principes appliques:
- Acces aux donnees selon authentification.
- Limitation des acces aux ressources personnelles.

---

## 13. Comptes de demonstration (environnement de test)

| Role | Email | Mot de passe |
|---|---|---|
| Admin | admin@drive.test | password |
| Editeur | editeur@drive.test | password |
| Client | user@drive.test | password |

---

## 14. Conclusion utilisateur

Cette documentation utilisateur couvre l'ensemble du site Drive E6:
- contexte,
- publics cibles,
- description de toutes les pages,
- procedures detaillees,
- regles metier visibles,
- depannage et FAQ.

Elle est exploitable telle quelle pour un dossier BTS SIO SLAM (partie utilisateur/recette fonctionnelle).
