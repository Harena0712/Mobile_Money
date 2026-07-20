
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

- Utiliser la table Transaction
- Utiliser la table TransactionDestination
- Utiliser la table MouvementCompte
- Utiliser la table Client
- Utiliser la table BaremeFrais
- Utiliser la table CommissionOperateur

---

## Model

### ClientModel

Fonction à ajouter :

chercherClientsParTelephone($telephones)

Pour :

- rechercher tous les destinataires
- retourner la liste des clients

---

### TransactionDestinationModel

Fonction à ajouter :

ajouterDestination($idTransaction, $idClient, $montant)

Pour :

- enregistrer un destinataire
- enregistrer le montant envoyé

---

### TransactionModel

Fonction à ajouter :

creerTransactionMultiple($idClientSource, $montantTotal, $frais)

Pour :

- créer une transaction
- retourner l'id de la transaction

---

### MouvementCompteModel

Fonction à ajouter :

creerMouvementsDestinataires($idTransaction, $destinataires)

Pour :

- créer un mouvement CREDIT pour chaque destinataire

---

## Controller

Modifier : TransfertController

Pour :

- index()

Ajouter :

- possibilité d'ajouter plusieurs destinataires
- saisir un montant pour chaque destinataire

---

- enregistrer()

Ajouter :

- récupérer tous les destinataires
- vérifier que tous les destinataires existent
- vérifier que tous les destinataires sont actifs
- vérifier qu'il n'y a pas de doublons
- calculer le montant total
- calculer les frais
- vérifier le solde
- créer la transaction
- enregistrer les destinataires
- créer les mouvements DEBIT et CREDIT
- afficher un message de succès

Sinon :

- afficher un message d'erreur

---

## Routes

Aucune modification.

---

## View

Modifier :

- client/transfert.php

Ajouter :

- bouton "Ajouter un destinataire"
- plusieurs champs téléphone
- plusieurs champs montant
- bouton "Supprimer un destinataire" (optionnel)

---

## Fonctions

### Vérifier les destinataires

destinatairesValides($destinataires)

Pour :

- vérifier que tous les destinataires existent
- vérifier qu'ils sont actifs
- vérifier qu'il n'y a pas de doublons

---

### Calculer le montant total

calculerMontantTotal($destinataires)

Pour :

- additionner tous les montants
- retourner le total

---

### Enregistrer les destinataires

ajouterDestination($idTransaction, $idClient, $montant)

Pour :

- enregistrer chaque destinataire
- enregistrer le montant correspondant

