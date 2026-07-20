# Cote client

# 1. Connexion

## Base de données

- [x] Creer une table Client
- [x] Données de test

## Model

### ClientModel

Fonction à ajouter :
chercherClientParTelephone($telephone)

Pour :

* [x] rechercher le téléphone
* [x] retourner le client
* [x] retourner `null` s'il n'existe pas


## Controller

Créer : ConnexionController


Pour:
- [x] index()
=> Affiche le formulaire.

- [x] login()

Pour :
* [x] récupérer le téléphone
* [x] verifier qu'il existe
* [x] verifier que le client est actif
* [x] créer la session
* [x] rediriger vers le tableau de bord

Sinon :

* [x] afficher un message d'erreur


- [x] logout()
=> Détruit la session.

Redirection : Connexion


## Routes
- [x] /client/login: GET
=> formulaire


- [x] /client/login: POST
=> traitement


- [x] /client/logout: GET
=> deconnexion


## View

Creer :


- [x] client/login.php: 
  * [x] champ telephone
  * [x] bouton Connexion
  * [x] message d'erreur


## Fonctions

### Verifier le téléphone

telephoneExiste()
telephonePrefixe()

### Verifier que le client est actif
clientActif()

### Créer la session
- [x] id_client
- [x] telephone
- [x] connecte


### Détruire la session

Au logout.

---


# 2. Voir le solde

## Base de données

- [x] Utiliser la table Client
- [x] Utiliser la table MouvementCompte


## Model

### MouvementCompteModel

Fonction à ajouter :

calculerSolde($idClient)

Pour :

- [x] récupérer tous les mouvements du client
- [x] additionner les montants CREDIT
- [x] additionner les montants DEBIT
- [x] calculer le solde
- [x] retourner le solde


## Controller

Créer : SoldeController

Pour :

- [x] index()

=> Afficher le solde du client.

Pour :

- [x] vérifier que le client est connecté
- [x] récupérer l'id du client depuis la session
- [x] appeler calculerSolde($idClient)
- [x] envoyer le solde à la vue


## Routes

- [x] /client/solde : GET

=> afficher le solde


## View

Créer :

- [x] client/solde.php :
  - [x] afficher le numéro de téléphone
  - [x] afficher le solde
  - [x] bouton Retour
  - [x] bouton Déconnexion


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- [x] vérifier que la session existe
- [x] rediriger vers la page de connexion si nécessaire


### Calculer le solde

calculerSolde($idClient)

Pour :

- [x] récupérer les mouvements du client
- [x] calculer le total des CREDIT
- [x] calculer le total des DEBIT
- [x] retourner le solde



---
# 3. Faire un dépôt

## Base de données

- [x] Utiliser la table Transaction
- [x] Utiliser la table MouvementCompte
- [x] Utiliser la table TypeOperation
- [x] Utiliser la table Statut


## Model

### TransactionModel

Fonction à ajouter :

creerTransactionDepot($idClient, $montant)

Pour :

- [x] créer une transaction de type DEPOT
- [x] enregistrer le montant
- [x] enregistrer les frais
- [x] enregistrer le statut
- [x] retourner l'id de la transaction


### MouvementCompteModel

Fonction à ajouter :

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- [x] créer un mouvement CREDIT
- [x] associer le mouvement à la transaction


## Controller

Créer : DepotController

Pour :

- [x] index()

=> Afficher le formulaire de dépôt.


- [x] enregistrer()

Pour :

- [x] vérifier que le client est connecté
- [x] récupérer l'id du client depuis la session
- [x] récupérer le montant
- [x] vérifier que le montant est valide
- [x] créer la transaction
- [x] créer le mouvement CREDIT
- [x] afficher un message de succès

Sinon :

- [x] afficher un message d'erreur


## Routes

- [x] /client/depot : GET

=> formulaire


- [x] /client/depot : POST

=> traitement


## View

Créer :

- [x] client/depot.php :
  - [x] champ montant
  - [x] bouton Déposer
  - [x] message de succès
  - [x] message d'erreur
  - [x] bouton Retour


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- [x] vérifier que la session existe
- [x] rediriger vers la page de connexion si nécessaire


### Vérifier le montant

montantValide($montant)

Pour :

- [x] vérifier que le montant est supérieur à 0


### Créer la transaction

creerTransactionDepot($idClient, $montant)

Pour :

- [x] créer une transaction de type DEPOT
- [x] enregistrer le montant
- [x] enregistrer les frais à 0
- [x] enregistrer le statut SUCCES


### Créer le mouvement

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- [x] créer un mouvement CREDIT
- [x] enregistrer le montant


---


# 4. Faire un retrait

## Base de données

- [x] Utiliser la table Transaction
- [x] Utiliser la table MouvementCompte
- [x] Utiliser la table TypeOperation
- [x] Utiliser la table BaremeFrais
- [x] Utiliser la table Statut


## Model

### BaremeFraisModel

Fonction à ajouter :

chercherFraisRetrait($montant)

Pour :

- [x] rechercher le barème correspondant au montant
- [x] retourner le montant des frais


### TransactionModel

Fonction à ajouter :

creerTransactionRetrait($idClient, $montant, $frais)

Pour :

- [x] créer une transaction de type RETRAIT
- [x] enregistrer le montant
- [x] enregistrer les frais
- [x] enregistrer le statut
- [x] retourner l'id de la transaction


### MouvementCompteModel

Fonction à ajouter :

creerMouvementDebit($idTransaction, $idClient, $montant)

Pour :

- [x] créer un mouvement DEBIT
- [x] associer le mouvement à la transaction


## Controller

Créer : RetraitController

Pour :

- [x] index()

=> Afficher le formulaire de retrait.


- [x] enregistrer()

Pour :

- [x] vérifier que le client est connecté
- [x] récupérer l'id du client depuis la session
- [x] récupérer le montant
- [x] vérifier que le montant est valide
- [x] récupérer les frais
- [x] calculer le montant total à débiter
- [x] vérifier que le solde est suffisant
- [x] créer la transaction
- [x] créer le mouvement DEBIT
- [x] afficher un message de succès

Sinon :

- [x] afficher un message d'erreur


## Routes

- [x] /client/retrait : GET

=> formulaire


- [x] /client/retrait : POST

=> traitement


## View

Créer :

- [x] client/retrait.php :
  - [x] champ montant
  - [x] affichage des frais (optionnel)
  - [x] bouton Retirer
  - [x] message de succès
  - [x] message d'erreur
  - [x] bouton Retour


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- [x] vérifier que la session existe
- [x] rediriger vers la page de connexion si nécessaire


### Vérifier le montant

montantValide($montant)

Pour :

- [x] vérifier que le montant est supérieur à 0


### Récupérer les frais

chercherFraisRetrait($montant)

Pour :

- [x] rechercher le barème correspondant
- [x] retourner les frais


### Vérifier le solde

soldeSuffisant($idClient, $montantTotal)

Pour :

- [x] calculer le solde du client
- [x] vérifier que le solde est supérieur ou égal au montant total


### Créer la transaction

creerTransactionRetrait($idClient, $montant, $frais)

Pour :

- [x] créer une transaction de type RETRAIT
- [x] enregistrer le montant
- [x] enregistrer les frais
- [x] enregistrer le statut VALIDEE


### Créer le mouvement

creerMouvementDebit($idTransaction, $idClient, $montantTotal)

Pour :

- [x] créer un mouvement DEBIT
- [x] enregistrer le montant total (montant + frais)


---

# 5. Faire un transfert

## Base de données

- [x] Utiliser la table Client
- [x] Utiliser la table Transaction
- [x] Utiliser la table MouvementCompte
- [x] Utiliser la table TypeOperation
- [x] Utiliser la table BaremeFrais
- [x] Utiliser la table Statut

---

## Model

### ClientModel

Fonction à ajouter :

chercherClientParTelephone($telephone)

Pour :

- [x] rechercher le destinataire
- [x] retourner le client
- [x] retourner `null` s'il n'existe pas

---

### BaremeFraisModel

Fonction à ajouter :

chercherFraisTransfert($montant)

Pour :

- [x] rechercher le barème correspondant au montant
- [x] retourner le montant des frais

---

### TransactionModel

Fonction à ajouter :

creerTransactionTransfert($idClientSource, $idClientDestination, $montant, $frais)

Pour :

- [x] créer une transaction de type TRANSFERT
- [x] enregistrer le montant
- [x] enregistrer les frais
- [x] enregistrer le statut
- [x] retourner l'id de la transaction

---

### MouvementCompteModel

Fonctions à ajouter :

creerMouvementDebit($idTransaction, $idClient, $montant)

Pour :

- [x] créer un mouvement DEBIT
- [x] associer le mouvement à la transaction

---

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- [x] créer un mouvement CREDIT
- [x] associer le mouvement à la transaction

---

## Controller

Créer : TransfertController

Pour :

- [x] index()

=> Afficher le formulaire de transfert.

---

- [x] enregistrer()

Pour :

- [x] vérifier que le client est connecté
- [x] récupérer l'id du client depuis la session
- [x] récupérer le téléphone du destinataire
- [x] récupérer le montant
- [x] vérifier que le montant est valide
- [x] vérifier que le destinataire existe
- [x] vérifier que le destinataire est actif
- [x] vérifier que le client ne s'envoie pas de l'argent à lui-même
- [x] récupérer les frais
- [x] calculer le montant total à débiter
- [x] vérifier que le solde est suffisant
- [x] créer la transaction
- [x] créer le mouvement DEBIT pour l'expéditeur
- [x] créer le mouvement CREDIT pour le destinataire
- [x] afficher un message de succès

Sinon :

- [x] afficher un message d'erreur

---

## Routes

- [x] /client/transfert : GET

=> formulaire

---

- [x] /client/transfert : POST

=> traitement

---

## View

Créer :

- [x] client/transfert.php :
  - [x] champ téléphone du destinataire
  - [x] champ montant
  - [x] bouton Transférer
  - [x] message de succès
  - [x] message d'erreur
  - [x] bouton Retour

---

## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- [x] vérifier que la session existe
- [x] rediriger vers la page de connexion si nécessaire

---

### Vérifier le montant

montantValide($montant)

Pour :

- [x] vérifier que le montant est supérieur à 0

---

### Vérifier le destinataire

destinataireExiste($telephone)

Pour :

- [x] rechercher le client
- [x] retourner le client
- [x] retourner `null` s'il n'existe pas

---

### Vérifier que le destinataire est actif

clientActif($client)

Pour :

- [x] vérifier que le client est actif

---

### Vérifier le solde

soldeSuffisant($idClient, $montantTotal)

Pour :

- [x] calculer le solde du client
- [x] vérifier que le solde est supérieur ou égal au montant total

---

### Récupérer les frais

chercherFraisTransfert($montant)

Pour :

- [x] rechercher le barème correspondant
- [x] retourner les frais

---

### Créer la transaction

creerTransactionTransfert($idClientSource, $idClientDestination, $montant, $frais)

Pour :

- [x] créer une transaction de type TRANSFERT
- [x] enregistrer le montant
- [x] enregistrer les frais
- [x] enregistrer le statut VALIDEE

---

### Créer les mouvements

creerMouvementDebit($idTransaction, $idClientSource, $montantTotal)

Pour :

- [x] créer un mouvement DEBIT
- [x] enregistrer le montant total (montant + frais)

---

creerMouvementCredit($idTransaction, $idClientDestination, $montant)

Pour :

- [x] créer un mouvement CREDIT
- [x] enregistrer le montant reçu


---


# 6. Voir l'historique

## Base de données

- [x] Utiliser la table Transaction
- [x] Utiliser la table TypeOperation
- [x] Utiliser la table Statut

---

## Model

### TransactionModel

Fonction à ajouter :

listerHistorique($idClient)

Pour :

- [x] récupérer toutes les transactions du client
- [x] récupérer le type d'opération
- [x] récupérer le statut
- [x] trier les transactions par date décroissante
- [x] retourner la liste des transactions

---

## Controller

Créer : HistoriqueController

Pour :

- [x] index()

=> Afficher l'historique des transactions.

Pour :

- [x] vérifier que le client est connecté
- [x] récupérer l'id du client depuis la session
- [x] appeler listerHistorique($idClient)
- [x] envoyer la liste à la vue

---

## Routes

- [x] /client/historique : GET

=> afficher l'historique

---

## View

Créer :

- [x] client/historique.php :
  - [x] afficher la liste des transactions
  - [x] afficher la date
  - [x] afficher le type d'opération
  - [x] afficher le montant
  - [x] afficher les frais
  - [x] afficher le statut
  - [x] bouton Retour
  - [x] bouton Déconnexion

---

## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- [x] vérifier que la session existe
- [x] rediriger vers la page de connexion si nécessaire

---

### Récupérer l'historique

listerHistorique($idClient)

Pour :

- [x] récupérer les transactions où le client est l'expéditeur
- [x] récupérer les transactions où le client est le destinataire
- [x] trier les transactions par date décroissante
- [x] retourner la liste des transactions
