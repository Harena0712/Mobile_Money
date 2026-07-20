# VERSION 1
----


# Mobile Money
## Coté Operateur
### Configuration des préfixes valable de l’opérateur
- [X] Route `operateur/prefixes::liste` : permet de récupérer la liste des préfixes valables pour l’opérateur
- [x] Route `operateur/prefixes/inserer::inserer` : permet d’insérer un nouveau préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/create::create` : permet de créer un nouveau préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/modif/id::modif(id)` : permet de modifier un préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/update::update` : permet de mettre à jour un préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/delete/id::delete(id)` : permet de supprimer un préfixe valable pour l’opérateur
- [x] Controller : `OperatorController` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/liste` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/create` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/modif` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Charger la liste des opérateurs dans les formulaires de création et de modification
- [x] Enregistrer et modifier `id_operateur` avec le préfixe
- [x] Corriger l'erreur `$operateurs` non défini dans `operateur/prefixes/modif.php`
- [x] Afficher le libellé de l'opérateur dans la liste déroulante

### Création de types d'opérations (dépôt, retrait, transfert) avec des barèmes de frais par tranche de montant 
- [x] Route `operateur/operationTypes::liste` : permet de récupérer la liste des types d'opérations
- [x] Route `operateur/operationTypes/voir/(:num)::voir($1)` : permet de voir les détails d'un type d'opération
- [x] Route `operateur/operationTypes/create::create()` : permet de créer un nouveau type d'opération
- [x] Route `operateur/operationTypes/inserer::inserer()` : permet d’insérer un nouveau type d'opération
- [x] Route `operateur/operationTypes/modif/id::modif(id)` : permet de modifier un type d'opération
- [x] Route `operateur/operationTypes/update::update()` : permet de mettre à jour un type d'opération
- [x] Route `operateur/operationTypes/delete/id::delete(id)` : permet de supprimer un type d'opérationde montant pour un type d'opération 
- [x] Controller : `OperatorController` avec tout les fonctions de gestion des types d'opérations et de leurs barèmes
- [x] Page : `operateur/operationTypes/liste` avec tout les fonctions de gestion des types d'opérations et de leurs barèmes
- [x] Page : `operateur/operationTypes/create` avec tout les fonctions de gestion des types d'opérations et de leurs barèmes
- [x] Page : `operateur/operationTypes/modif` avec tout les fonctions de gestion des types d'opérations et de leurs barèmes

### Situation gain via les différents frais
- [x] Route `operateur/situationFrais::liste` : permet de récupérer la liste des situations de gain via les différents frais
- [x] Controller : `OperatorController` avec tout les fonctions de gestion des situations de gain via les différents frais
- [x] Page : `operateur/situationFrais/liste` affiche la liste des situations de gain via les différents frais et le total des gains par type d'opération et le total des gains de l'opérateur
  
### Situation des comptes clients
- [x] Route `operateur/situationComptes::liste` : permet de récupérer la liste des situations des comptes clients
- [x] Controller : `OperatorController` avec tout les fonctions de gestion des situations des comptes clients
- [x] Page : `operateur/situationComptes/liste` affiche la liste des situations des comptes clients



# Côté opérateur V2

# 1. Gestion des opérateurs

## Base de données

- Utiliser la table Operateur

---

## Model

### OperateurModel

Fonctions à ajouter :

listerOperateurs()

Pour :

- récupérer tous les opérateurs

---

chercherOperateur($id)

Pour :

- récupérer un opérateur

---

ajouterOperateur($nom)

Pour :

- enregistrer un nouvel opérateur

---

modifierOperateur($id, $nom)

Pour :

- modifier un opérateur

---

activerOperateur($id)

Pour :

- activer un opérateur

---

desactiverOperateur($id)

Pour :

- désactiver un opérateur

---

## Controller

Créer : OperateurController

Pour :

- index()

=> afficher la liste des opérateurs

---

- ajouter()

=> afficher le formulaire

---

- enregistrer()

=> enregistrer un opérateur

---

- modifier()

=> modifier un opérateur

---

- activer()

=> activer un opérateur

---

- desactiver()

=> désactiver un opérateur

---

## Routes

- /operateur : GET

=> liste

---

- /operateur/ajouter : GET

=> formulaire

---

- /operateur/ajouter : POST

=> enregistrement

---

- /operateur/modifier : POST

=> modification

---

- /operateur/activer : POST

=> activation

---

- /operateur/desactiver : POST

=> désactivation

---

## View

Créer :

- Dnas operateur/operateurs/liste.php
  - liste des opérateurs
  - bouton Ajouter
  - bouton Modifier
  - bouton Activer
  - bouton Désactiver


----

# Côté opérateur

# 2. Configuration des commissions inter-opérateurs

## Base de données

- [x] Utiliser la table CommissionOperateur

---

## Model

### CommissionOperateurModel

Fonctions à ajouter :

- [x] listerCommissions()

---

- [x] chercherCommission($id)

---

- [x] ajouterCommission()

---

- [x] modifierCommission()

---

## Controller

Créer : CommissionOperateurController

Pour :

- [x] index()

=> afficher les commissions

---

- [x] ajouter() 

=> formulaire

---

- [x] enregistrer()

=> enregistrer une commission

---

- [x] modifier()

=> modifier une commission

---

## Routes

- [x] /commission : GET

=> liste

---

- [x] /commission/ajouter : GET

=> formulaire

---

- [x] /commission/ajouter : POST

=> enregistrement

---

- [x] /commission/modifier : POST

=> modification

---

## View

Créer :

- [x] commission/index.php
  - [x] liste des commissions

- [x] commission/form.php
  - [x] opérateur source
  - [x] opérateur destination
  - [x] pourcentage


----


# Côté opérateur

# 3. Situation des gains

## Base de données

  - [x] Utiliser la table Transaction
  - [x] Utiliser la table Client
  - [x] Utiliser la table Prefixe
  - [x] Utiliser la table Operateur
  - [x] Utiliser la table CommissionOperateur

---

## Model

### TransactionModel

Fonction à ajouter :

calculerGains()

Pour :

  - [x] calculer les frais des transactions internes
  - [x] calculer les commissions inter-opérateurs
  - [x] retourner les totaux

---

## Controller

Créer : GainController

Pour :

  - [x] index()

=> afficher la situation des gains

---

## Routes

  - [x] /gain : GET

=> afficher les gains

---

## View

Créer :

  - [x] gain/index.php

Afficher :

  - [x] gains internes
  - [x] gains inter-opérateurs
  - [x] gains par opérateur
  - [x] total général


----

# Côté opérateur

# 4. Situation des montants à envoyer aux autres opérateurs

## Base de données

  - [x] Utiliser la table Transaction
  - [x] Utiliser la table Client
  - [x] Utiliser la table Prefixe
  - [x] Utiliser la table Operateur
  - [x] Utiliser la table CommissionOperateur
  - [x] Corriger les `id_prefixe` des clients de test pour relier chaque client à son préfixe
  - [x] Ajouter la commission Airtel → Yas (3 %)

---

## Model

### TransactionModel

Fonctions ajoutées :

- [x] `listerCompensationsSortantes($idOperateurSource)`
  - récupérer les transactions dont l'opérateur source est Airtel
  - exclure les transactions dont l'opérateur destination est Airtel
  - récupérer l'opérateur, la date et le type d'opération
  - calculer le montant : `montant + (montant × pourcentage / 100)`
  - regrouper les totaux par opérateur destination

- [x] `listerCompensationsOperateurCourant()`
  - lire l'opérateur courant depuis la session
  - appeler la fonction de calcul pour garder le contrôleur propre

### OperateurModel

- [x] `chercherOperateurParLibelle($libelle)`
- [x] `initialiserOperateurSession($libelle)`
  - enregistrer Airtel dans `operateur_courant` et `id_operateur`

---

## Controller

Créer : CompensationController

Pour :

  - [x] index()

=> appeler le modèle et afficher les montants à envoyer

---

## Routes

  - [x] /compensation : GET

=> afficher les montants

---

## View

Créer :

  - [x] compensation/index.php

Afficher :

  - [x] opérateur
  - [x] date
  - [x] type d'opération
  - [x] montant incluant la commission
  - [x] total à envoyer pour chaque opérateur

### Initialisation de l'opérateur

- [x] À l'ouverture de `/`, Airtel est enregistré en session.

### Vérifications et point restant

- [x] Les données SQLite contiennent des transactions Airtel → Yas et la requête de compensation retourne bien des résultats (`30 900 Ar` pour une transaction de `30 000 Ar` avec 3 %).
- [ ] Prévoir un repli sur Airtel lorsque `/compensation` est ouvert sans passer par `/`, car une session sans `operateur_courant` donne un résultat vide.
- [ ] Empêcher les doublons dans `CommissionOperateur` lors de l'exécution répétée du seeder.




---
## Cote client

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


----









---
# VERSION 2


# Côté client

# 1. Inclure les frais de retrait lors du transfert

## Base de données

- [x] Utiliser la table Transaction
- [x] Ajouter le champ inclure_frais_retrait
- [x] Utiliser la table BaremeFrais
- Utiliser la table CommissionOperateur

---

## Model

### BaremeFraisModel

Fonction à ajouter :

chercherFraisRetrait($montant)

Pour :

- [x] rechercher le barème correspondant
- [x] retourner les frais de retrait

---

### TransactionModel

Fonction à ajouter :

mettreAJourFraisRetrait($idTransaction, $inclureFraisRetrait)

Pour :

- [x] enregistrer le choix du client

---

## Controller

Modifier : TransfertController

Pour :

- [x] index()

Ajouter :

- [x] une option "Inclure les frais de retrait"

---

- [x] enregistrer()

Ajouter :

- [x] récupérer le choix du client
- [x] calculer les frais de retrait
- [x] ajouter les frais au montant débité si l'option est cochée
- [x] enregistrer le choix dans la transaction

---

## Routes

Aucune modification.

---

## View

Modifier :

- [x] client/transfert.php

Ajouter :

- [x] case à cocher "Inclure les frais de retrait"
- affichage du montant total à débiter (optionnel)

---

## Fonctions

### Calculer les frais de retrait

chercherFraisRetrait($montant)

Pour :

- [x] rechercher le barème correspondant
- [x] retourner les frais

---

### Calculer le montant total

calculerMontantTotal($montant, $fraisTransfert, $fraisRetrait, $inclure)

Pour :

- [x] calculer le montant total à débiter
- [x] retourner le montant total

----



# 2. Envoyer vers plusieurs destinataires

## Base de données

- [x] Utiliser la table Transaction
- [x] Utiliser la table TransactionDestination
- [x] Utiliser la table MouvementCompte
- [x] Utiliser la table Client
- [x] Utiliser la table BaremeFrais
- Utiliser la table CommissionOperateur
- [X]Utiliser la table Transaction
- [X]Utiliser la table TransactionDestination
- [X]Utiliser la table MouvementCompte
- [X]Utiliser la table Client
- [X]Utiliser la table BaremeFrais
- [X]Utiliser la table CommissionOperateur

---

## Model

### ClientModel

Fonction à ajouter :

chercherClientsParTelephone($telephones)

Pour :

- [x] rechercher tous les destinataires
- [x] retourner la liste des clients
- [X]rechercher tous les destinataires
- [X]retourner la liste des clients

---

### TransactionDestinationModel

Fonction à ajouter :

ajouterDestination($idTransaction, $idClient, $montant)

Pour :

- [x] enregistrer un destinataire
- [x] enregistrer le montant envoyé
- [X]enregistrer un destinataire
- [X]enregistrer le montant envoyé

---

### TransactionModel

Fonction à ajouter :

creerTransactionMultiple($idClientSource, $montantTotal, $frais)

Pour :

- [x] créer une transaction
- [x] retourner l'id de la transaction
- [X]créer une transaction
- [X]retourner l'id de la transaction

---

### MouvementCompteModel

Fonction à ajouter :

creerMouvementsDestinataires($idTransaction, $destinataires)

Pour :

- [x] créer un mouvement CREDIT pour chaque destinataire
- [X]créer un mouvement CREDIT pour chaque destinataire

---

## Controller

Modifier : TransfertController

Pour :

- [x] index()

Ajouter :

- [x] possibilité d'ajouter plusieurs destinataires
- [x] saisir un montant pour chaque destinataire

---

- [x] enregistrer()

Ajouter :

- [x] récupérer tous les destinataires
- [x] vérifier que tous les destinataires Airtel existent
- [x] vérifier que tous les destinataires Airtel sont actifs
- [x] vérifier qu'il n'y a pas de doublons
- [x] calculer le montant total
- [x] calculer les frais
- [x] vérifier le solde
- [x] créer la transaction
- [x] enregistrer les destinataires Airtel
- [x] créer les mouvements DEBIT et CREDIT
- [x] afficher un message de succès

Sinon :

- [x] afficher un message d'erreur
- [X]index()

Ajouter :

- [X]possibilité d'ajouter plusieurs destinataires
- [X]saisir un montant pour chaque destinataire

---

- [X]enregistrer()

Ajouter :

- [X]récupérer tous les destinataires
- [X]vérifier que tous les destinataires existent
- [X]vérifier que tous les destinataires sont actifs
- [X]vérifier qu'il n'y a pas de doublons
- [X]calculer le montant total
- [X]calculer les frais
- [X]vérifier le solde
- [X]créer la transaction
- [X]enregistrer les destinataires
- [X]créer les mouvements DEBIT et CREDIT
- [X]afficher un message de succès

Sinon :

- [X]afficher un message d'erreur

---

## Routes

Aucune modification.

---

## View

Modifier :

- [X]client/transfert.php

Ajouter :

- [X]bouton "Ajouter un destinataire"
- [X]plusieurs champs téléphone
- [X]plusieurs champs montant
- [X]bouton "Supprimer un destinataire" (optionnel)

---

## Fonctions

### Vérifier les destinataires

destinatairesValides($destinataires)

Pour :

- [X]vérifier que tous les destinataires existent
- [X]vérifier qu'ils sont actifs
- [X]vérifier qu'il n'y a pas de doublons

---

### Calculer le montant total

calculerMontantTotal($destinataires)

Pour :

- [X]additionner tous les montants
- [X]retourner le total

---

### Enregistrer les destinataires

ajouterDestination($idTransaction, $idClient, $montant)

Pour :

- [X]enregistrer chaque destinataire
- [X]enregistrer le montant correspondant




---


# Côté opérateur V2

# 1. Gestion des opérateurs

## Base de données

- [X]Utiliser la table Operateur

---

## Model

### OperateurModel

Fonctions à ajouter :

listerOperateurs()

Pour :

- [X]récupérer tous les opérateurs

---

chercherOperateur($id)

Pour :

- [X]récupérer un opérateur

---

ajouterOperateur($nom)

Pour :

- [X]enregistrer un nouvel opérateur

---

modifierOperateur($id, $nom)

Pour :

- [X]modifier un opérateur

---

activerOperateur($id)

Pour :

- [X]activer un opérateur

---

desactiverOperateur($id)

Pour :

- [X]désactiver un opérateur

---

## Controller

Créer : OperateurController

Pour :

- [X]index()

=> afficher la liste des opérateurs

---

- [X]ajouter()

=> afficher le formulaire

---

- [X]enregistrer()

=> enregistrer un opérateur

---

- [X]modifier()

=> modifier un opérateur

---

- [X]activer()

=> activer un opérateur

---

- [X]desactiver()

=> désactiver un opérateur

---

## Routes

- [X]/operateur : GET

=> liste

---

- [X]/operateur/ajouter : GET

=> formulaire

---

- [X]/operateur/ajouter : POST

=> enregistrement

---

- [X]/operateur/modifier : POST

=> modification

---

- [X]/operateur/activer : POST

=> activation

---

- [X]/operateur/desactiver : POST

=> désactivation

---

## View

Créer :

- [X]operateur/index.php
  - [X]liste des opérateurs
  - [X]bouton Ajouter
  - [X]bouton Modifier
  - [X]bouton Activer
  - [X]bouton Désactiver


----

# Côté opérateur

# 2. Configuration des commissions inter-opérateurs

## Base de données

- [X]Utiliser la table CommissionOperateur

---

## Model

### CommissionOperateurModel

Fonctions à ajouter :

listerCommissions()

---

chercherCommission($id)

---

ajouterCommission()

---

modifierCommission()

---

## Controller

Créer : CommissionOperateurController

Pour :

- [X]index()

=> afficher les commissions

---

- [X]ajouter()

=> formulaire

---

- [X]enregistrer()

=> enregistrer une commission

---

- [X]modifier()

=> modifier une commission

---

## Routes

- [X]/commission : GET

=> liste

---

- [X]/commission/ajouter : GET

=> formulaire

---

- [X]/commission/ajouter : POST

=> enregistrement

---

- [X]/commission/modifier : POST

=> modification

---

## View

Créer :

- [X]commission/index.php
  - [X]liste des commissions

- [X]commission/form.php
  - [X]opérateur source
  - [X]opérateur destination
  - [X]pourcentage


----


# Côté opérateur

# 3. Situation des gains

## Base de données

- [X]Utiliser la table Transaction
- [X]Utiliser la table Client
- [X]Utiliser la table Prefixe
- [X]Utiliser la table Operateur
- [X]Utiliser la table CommissionOperateur

---

## Model

### TransactionModel

Fonction à ajouter :

calculerGains()

Pour :

- [X]calculer les frais des transactions internes
- [X]calculer les commissions inter-opérateurs
- [X]retourner les totaux

---

## Controller

Créer : GainController

Pour :

- [X]index()

=> afficher la situation des gains

---

## Routes

- [X]/gain : GET

=> afficher les gains

---

## View

Créer :

- [X]gain/index.php

Afficher :

- [X]gains internes
- [X]gains inter-opérateurs
- [X]total général


----

# Côté opérateur

# 4. Situation des montants à envoyer aux autres opérateurs

## Base de données

- [X]Utiliser la table Transaction
- [X]Utiliser la table TransactionDestination
- [X]Utiliser la table Client
- [X]Utiliser la table Prefixe
- [X]Utiliser la table Operateur

---

## Model

### TransactionModel

Fonction à ajouter :

calculerMontantsParOperateur()

Pour :

- [X]calculer les montants envoyés vers chaque opérateur
- [X]regrouper les résultats par opérateur

---

## Controller

Créer : CompensationController

Pour :

- [X]index()

=> afficher les montants à envoyer

---

## Routes

- [X]/compensation : GET

=> afficher les montants

---

## View

Créer :

- [X]compensation/index.php

Afficher :

- [X]opérateur
- [X]montant total à envoyer
