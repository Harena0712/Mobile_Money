# Cote client

# 1. Connexion

## Base de données

- Creer une table Client
- Données de test

## Model

### ClientModel

Fonction à ajouter :
chercherClientParTelephone($telephone)

Pour :

* rechercher le téléphone
* retourner le client
* retourner `null` s'il n'existe pas


## Controller

Créer : ConnexionController


Pour:
- index()
=> Affiche le formulaire.

- login()

Pour :
* récupérer le téléphone
* verifier qu'il existe
* verifier que le client est actif
* créer la session
* rediriger vers le tableau de bord

Sinon :

* afficher un message d'erreur


- logout()
=> Détruit la session.

Redirection : Connexion


## Routes
- /client/login: GET
=> formulaire


- /client/login: POST
=> traitement


- /client/logout: GET
=> deconnexion


## View

Creer :


- client/login.php: 
  * champ telephone
  * bouton Connexion
  * message d'erreur


## Fonctions

### Verifier le téléphone

telephoneExiste()
telephonePrefixe()

### Verifier que le client est actif
clientActif()

### Créer la session
- id_client
- telephone
- connecte


### Détruire la session

Au logout.

---


# 2. Voir le solde

## Base de données

- Utiliser la table Client
- Utiliser la table MouvementCompte


## Model

### MouvementCompteModel

Fonction à ajouter :

calculerSolde($idClient)

Pour :

- récupérer tous les mouvements du client
- additionner les montants CREDIT
- additionner les montants DEBIT
- calculer le solde
- retourner le solde


## Controller

Créer : SoldeController

Pour :

- index()

=> Afficher le solde du client.

Pour :

- vérifier que le client est connecté
- récupérer l'id du client depuis la session
- appeler calculerSolde($idClient)
- envoyer le solde à la vue


## Routes

- /client/solde : GET

=> afficher le solde


## View

Créer :

- client/solde.php :
  - afficher le numéro de téléphone
  - afficher le solde
  - bouton Retour
  - bouton Déconnexion


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- vérifier que la session existe
- rediriger vers la page de connexion si nécessaire


### Calculer le solde

calculerSolde($idClient)

Pour :

- récupérer les mouvements du client
- calculer le total des CREDIT
- calculer le total des DEBIT
- retourner le solde



---
# 3. Faire un dépôt

## Base de données

- Utiliser la table Transaction
- Utiliser la table MouvementCompte
- Utiliser la table TypeOperation
- Utiliser la table Statut


## Model

### TransactionModel

Fonction à ajouter :

creerTransactionDepot($idClient, $montant)

Pour :

- créer une transaction de type DEPOT
- enregistrer le montant
- enregistrer les frais
- enregistrer le statut
- retourner l'id de la transaction


### MouvementCompteModel

Fonction à ajouter :

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- créer un mouvement CREDIT
- associer le mouvement à la transaction


## Controller

Créer : DepotController

Pour :

- index()

=> Afficher le formulaire de dépôt.


- enregistrer()

Pour :

- vérifier que le client est connecté
- récupérer l'id du client depuis la session
- récupérer le montant
- vérifier que le montant est valide
- créer la transaction
- créer le mouvement CREDIT
- afficher un message de succès

Sinon :

- afficher un message d'erreur


## Routes

- /client/depot : GET

=> formulaire


- /client/depot : POST

=> traitement


## View

Créer :

- client/depot.php :
  - champ montant
  - bouton Déposer
  - message de succès
  - message d'erreur
  - bouton Retour


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- vérifier que la session existe
- rediriger vers la page de connexion si nécessaire


### Vérifier le montant

montantValide($montant)

Pour :

- vérifier que le montant est supérieur à 0


### Créer la transaction

creerTransactionDepot($idClient, $montant)

Pour :

- créer une transaction de type DEPOT
- enregistrer le montant
- enregistrer les frais à 0
- enregistrer le statut SUCCES


### Créer le mouvement

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- créer un mouvement CREDIT
- enregistrer le montant


---


# 4. Faire un retrait

## Base de données

- Utiliser la table Transaction
- Utiliser la table MouvementCompte
- Utiliser la table TypeOperation
- Utiliser la table BaremeFrais
- Utiliser la table Statut


## Model

### BaremeFraisModel

Fonction à ajouter :

chercherFraisRetrait($montant)

Pour :

- rechercher le barème correspondant au montant
- retourner le montant des frais


### TransactionModel

Fonction à ajouter :

creerTransactionRetrait($idClient, $montant, $frais)

Pour :

- créer une transaction de type RETRAIT
- enregistrer le montant
- enregistrer les frais
- enregistrer le statut
- retourner l'id de la transaction


### MouvementCompteModel

Fonction à ajouter :

creerMouvementDebit($idTransaction, $idClient, $montant)

Pour :

- créer un mouvement DEBIT
- associer le mouvement à la transaction


## Controller

Créer : RetraitController

Pour :

- index()

=> Afficher le formulaire de retrait.


- enregistrer()

Pour :

- vérifier que le client est connecté
- récupérer l'id du client depuis la session
- récupérer le montant
- vérifier que le montant est valide
- récupérer les frais
- calculer le montant total à débiter
- vérifier que le solde est suffisant
- créer la transaction
- créer le mouvement DEBIT
- afficher un message de succès

Sinon :

- afficher un message d'erreur


## Routes

- /client/retrait : GET

=> formulaire


- /client/retrait : POST

=> traitement


## View

Créer :

- client/retrait.php :
  - champ montant
  - affichage des frais (optionnel)
  - bouton Retirer
  - message de succès
  - message d'erreur
  - bouton Retour


## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- vérifier que la session existe
- rediriger vers la page de connexion si nécessaire


### Vérifier le montant

montantValide($montant)

Pour :

- vérifier que le montant est supérieur à 0


### Récupérer les frais

chercherFraisRetrait($montant)

Pour :

- rechercher le barème correspondant
- retourner les frais


### Vérifier le solde

soldeSuffisant($idClient, $montantTotal)

Pour :

- calculer le solde du client
- vérifier que le solde est supérieur ou égal au montant total


### Créer la transaction

creerTransactionRetrait($idClient, $montant, $frais)

Pour :

- créer une transaction de type RETRAIT
- enregistrer le montant
- enregistrer les frais
- enregistrer le statut VALIDEE


### Créer le mouvement

creerMouvementDebit($idTransaction, $idClient, $montantTotal)

Pour :

- créer un mouvement DEBIT
- enregistrer le montant total (montant + frais)


---

# 5. Faire un transfert

## Base de données

- Utiliser la table Client
- Utiliser la table Transaction
- Utiliser la table MouvementCompte
- Utiliser la table TypeOperation
- Utiliser la table BaremeFrais
- Utiliser la table Statut

---

## Model

### ClientModel

Fonction à ajouter :

chercherClientParTelephone($telephone)

Pour :

- rechercher le destinataire
- retourner le client
- retourner `null` s'il n'existe pas

---

### BaremeFraisModel

Fonction à ajouter :

chercherFraisTransfert($montant)

Pour :

- rechercher le barème correspondant au montant
- retourner le montant des frais

---

### TransactionModel

Fonction à ajouter :

creerTransactionTransfert($idClientSource, $idClientDestination, $montant, $frais)

Pour :

- créer une transaction de type TRANSFERT
- enregistrer le montant
- enregistrer les frais
- enregistrer le statut
- retourner l'id de la transaction

---

### MouvementCompteModel

Fonctions à ajouter :

creerMouvementDebit($idTransaction, $idClient, $montant)

Pour :

- créer un mouvement DEBIT
- associer le mouvement à la transaction

---

creerMouvementCredit($idTransaction, $idClient, $montant)

Pour :

- créer un mouvement CREDIT
- associer le mouvement à la transaction

---

## Controller

Créer : TransfertController

Pour :

- index()

=> Afficher le formulaire de transfert.

---

- enregistrer()

Pour :

- vérifier que le client est connecté
- récupérer l'id du client depuis la session
- récupérer le téléphone du destinataire
- récupérer le montant
- vérifier que le montant est valide
- vérifier que le destinataire existe
- vérifier que le destinataire est actif
- vérifier que le client ne s'envoie pas de l'argent à lui-même
- récupérer les frais
- calculer le montant total à débiter
- vérifier que le solde est suffisant
- créer la transaction
- créer le mouvement DEBIT pour l'expéditeur
- créer le mouvement CREDIT pour le destinataire
- afficher un message de succès

Sinon :

- afficher un message d'erreur

---

## Routes

- /client/transfert : GET

=> formulaire

---

- /client/transfert : POST

=> traitement

---

## View

Créer :

- client/transfert.php :
  - champ téléphone du destinataire
  - champ montant
  - bouton Transférer
  - message de succès
  - message d'erreur
  - bouton Retour

---

## Fonctions

### Vérifier que le client est connecté

clientConnecte()

Pour :

- vérifier que la session existe
- rediriger vers la page de connexion si nécessaire

---

### Vérifier le montant

montantValide($montant)

Pour :

- vérifier que le montant est supérieur à 0

---

### Vérifier le destinataire

destinataireExiste($telephone)

Pour :

- rechercher le client
- retourner le client
- retourner `null` s'il n'existe pas

---

### Vérifier que le destinataire est actif

clientActif($client)

Pour :

- vérifier que le client est actif

---

### Vérifier le solde

soldeSuffisant($idClient, $montantTotal)

Pour :

- calculer le solde du client
- vérifier que le solde est supérieur ou égal au montant total

---

### Récupérer les frais

chercherFraisTransfert($montant)

Pour :

- rechercher le barème correspondant
- retourner les frais

---

### Créer la transaction

creerTransactionTransfert($idClientSource, $idClientDestination, $montant, $frais)

Pour :

- créer une transaction de type TRANSFERT
- enregistrer le montant
- enregistrer les frais
- enregistrer le statut VALIDEE

---

### Créer les mouvements

creerMouvementDebit($idTransaction, $idClientSource, $montantTotal)

Pour :

- créer un mouvement DEBIT
- enregistrer le montant total (montant + frais)

---

creerMouvementCredit($idTransaction, $idClientDestination, $montant)

Pour :

- créer un mouvement CREDIT
- enregistrer le montant reçu