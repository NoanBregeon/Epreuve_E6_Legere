# Documentation Utilisateur Complete - Application Web Drive E6

Version du document: 3.0
Date: 20/04/2026
Public: utilisateurs finaux, personnels magasin, jury non technique

---

## Comment lire ce document

Cette documentation est organisee en 3 niveaux:

1. Niveau 1 - Prise en main rapide
2. Niveau 2 - Utilisation detaillee par ecran
3. Niveau 3 - Aide, depannage et FAQ

Objectif: permettre a un utilisateur debutant de commander facilement, et a un lecteur jury de verifier les usages metier.

---

# Niveau 1 - Prise en main rapide

## 1. A quoi sert Drive E6 ?

Drive E6 est une application web de commande alimentaire en ligne.

Elle permet:

- de consulter les produits du magasin
- d'ajouter des produits au panier
- de passer commande avec un creneau de retrait
- de consulter ses commandes
- de gerer son compte utilisateur

---

## 2. Fonctions principales

### 2.1 Accueil

Page de presentation du service, avec mise en avant des promotions.

![Page accueil](Images_documentation/accueil_legere.png)

### 2.2 Catalogue

Page pour rechercher, filtrer, trier et ajouter des produits au panier.

![Catalogue produits](Images_documentation/produit_legere.png)

### 2.3 Panier

Page pour modifier les quantites et valider sa commande.

![Panier vide](Images_documentation/panier_legere.png)

![Panier avec article](Images_documentation/panier_legere_2.png)

### 2.4 Mon compte

Page pour modifier profil, mot de passe et options du compte.

![Gestion du compte](Images_documentation/gestion_compte.png)

---

## 3. Profils utilisateurs

| Profil | Ce que vous pouvez faire |
|---|---|
| Visiteur | Voir accueil, catalogue, promotions, panier |
| Utilisateur connecte | Passer commande, consulter ses commandes, gerer son profil |
| Administrateur | Acces utilisateur connecte + espace admin |

---

## 4. Demarrage en 5 minutes

1. Ouvrir la page d'accueil.
2. Aller dans Produits.
3. Ajouter un ou plusieurs articles au panier.
4. Ouvrir le panier puis cliquer sur validation.
5. Se connecter (ou creer un compte) pour finaliser la commande.

---

# Niveau 2 - Utilisation detaillee par ecran

## 5. Navigation generale

Dans le haut de page, vous trouvez:

- un champ de recherche
- un menu des rayons/categories
- un acces au panier
- les liens de connexion, compte et commandes

Bon a savoir:

- le total panier est visible dans l'entete
- le nombre d'articles est mis a jour automatiquement

---

## 6. Utiliser le catalogue produits

### 6.1 Rechercher un article

1. Saisir un mot-cle dans la barre de recherche.
2. La liste affiche les produits correspondants.

### 6.2 Filtrer les resultats

Options disponibles:

- filtre par categorie
- filtre "en stock"
- tri par nom ou prix

### 6.3 Ajouter au panier

1. Choisir une quantite.
2. Cliquer sur Ajouter.
3. Verifier le compteur du panier.

Regle appliquee:

- la quantite ne peut pas depasser le stock disponible.

---

## 7. Utiliser le panier

### 7.1 Consulter le panier

La page panier affiche:

- les produits selectionnes
- les quantites
- le prix unitaire
- le total global

### 7.2 Modifier les quantites

Utiliser les boutons - et + pour diminuer ou augmenter.

### 7.3 Supprimer un article

Cliquer sur l'icone de suppression sur la ligne concernee.

### 7.4 Valider le panier

Cliquer sur "Valider mon panier" pour passer a la finalisation de commande.

---

## 8. Passer une commande

### 8.1 Conditions

- etre connecte
- avoir un panier non vide

### 8.2 Etapes

1. Ouvrir la page de finalisation.
2. Choisir un creneau de retrait.
3. Choisir le moyen de paiement.
4. Ajouter une note si besoin.
5. Confirmer la commande.

### 8.3 Resultat attendu

- un numero de commande est genere
- une page de confirmation s'affiche
- un email de confirmation peut etre envoye

---

## 9. Consulter ses commandes

Dans "Mes commandes", vous pouvez:

- voir la liste des commandes
- ouvrir le detail d'une commande
- verifier le statut de traitement

Statuts possibles (lecture utilisateur):

- A_PREPARER: commande enregistree
- EN_PREPARATION: equipe en cours de preparation
- PRET: commande disponible au retrait

---

## 10. Gerer son compte

Sur la page "Mon compte", vous pouvez:

- modifier votre nom
- modifier votre email
- changer votre mot de passe
- supprimer votre compte

Conseil securite:

- utilisez un mot de passe unique et robuste

---

## 11. Fonctionnalites administrateur

Un administrateur connecte peut:

- acceder au tableau de bord admin
- creer un produit
- modifier un produit
- supprimer un produit

Si vous n'etes pas administrateur, l'acces est refuse.

---

# Niveau 3 - Aide, depannage et FAQ

## 12. Messages frequents et interpretation

| Message ou situation | Signification |
|---|---|
| Panier vide | Aucun produit n'a ete ajoute |
| Quantite refusee | Quantite demandee superieure au stock |
| Acces refuse /admin | Compte sans droit administrateur |
| Validation impossible | Donnees manquantes (creneau, paiement, etc.) |

---

## 13. Depannage rapide

### 13.1 Je ne peux pas me connecter

1. Verifier email et mot de passe.
2. Utiliser "Mot de passe oublie" si besoin.
3. Verifier la reception de l'email de reinitialisation.

### 13.2 Le panier ne se met pas a jour

1. Rafraichir la page.
2. Reessayer avec une quantite plus faible.
3. Verifier que le produit est toujours en stock.

### 13.3 Je ne vois pas ma commande

1. Verifier que vous etes connecte avec le bon compte.
2. Ouvrir "Mes commandes".
3. Verifier si la commande vient d'etre creee (latence possible).

### 13.4 Je ne recois pas d'email de confirmation

1. Verifier le dossier spam/indesirable.
2. Verifier l'adresse email du compte.
3. Conserver le numero de commande affiche a l'ecran.

---

## 14. FAQ utilisateur

Question: Puis-je commander sans compte ?
Reponse: Le panier est accessible sans connexion, mais la validation de commande demande un compte.

Question: Les promotions sont-elles automatiques ?
Reponse: Oui, les remises applicables sont calculees automatiquement dans le panier.

Question: Puis-je modifier une commande deja validee ?
Reponse: La modification directe n'est pas prevue depuis l'interface utilisateur.

Question: Le paiement CB est-il reel ?
Reponse: Non, le mode CB est simule dans le cadre du projet.

---

## 15. Donnees personnelles (vue utilisateur)

Donnees utilisees:

- informations de compte (nom, email)
- historique des commandes
- informations necessaires au retrait

Principes appliques:

- acces a vos donnees apres authentification
- acces limite aux donnees de votre propre compte

---

## 16. Comptes de demonstration (environnement de test)

| Role | Email | Mot de passe |
|---|---|---|
| Admin | admin@drive.test | password |
| Editeur | editeur@drive.test | password |
| Client | user@drive.test | password |

---

## 17. Procedure de recette utilisateur (simple)

1. Ouvrir l'accueil.
2. Aller sur Produits.
3. Rechercher un produit puis l'ajouter au panier.
4. Ouvrir le panier et modifier la quantite.
5. Se connecter avec le compte client test.
6. Finaliser une commande.
7. Ouvrir Mon compte et modifier le nom.

Criteres de succes:

- navigation fluide
- panier coherent
- commande creee sans erreur
- profil modifie avec succes

---

## 18. Conclusion

Cette documentation utilisateur couvre:

- la prise en main de l'application
- les parcours fonctionnels essentiels
- les actions de compte et commande
- les cas d'erreur les plus frequents
- une procedure simple de verification

Elle est adaptee a une presentation BTS SIO SLAM pour la partie utilisateur.
