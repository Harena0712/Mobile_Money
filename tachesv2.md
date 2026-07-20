
# Côté client

# 1. Inclure les frais de retrait lors du transfert

## Base de données

- Utiliser la table Transaction
- Ajouter le champ inclure_frais_retrait
- Utiliser la table BaremeFrais
- Utiliser la table CommissionOperateur

---

## Model

### BaremeFraisModel

Fonction à ajouter :

chercherFraisRetrait($montant)

Pour :

- rechercher le barème correspondant
- retourner les frais de retrait

---

### TransactionModel

Fonction à ajouter :

mettreAJourFraisRetrait($idTransaction, $inclureFraisRetrait)

Pour :

- enregistrer le choix du client

---

## Controller

Modifier : TransfertController

Pour :

- index()

Ajouter :

- une option "Inclure les frais de retrait"

---

- enregistrer()

Ajouter :

- récupérer le choix du client
- calculer les frais de retrait
- ajouter les frais au montant débité si l'option est cochée
- enregistrer le choix dans la transaction

---

## Routes

Aucune modification.

---

## View

Modifier :

- client/transfert.php

Ajouter :

- case à cocher "Inclure les frais de retrait"
- affichage du montant total à débiter (optionnel)

---

## Fonctions

### Calculer les frais de retrait

chercherFraisRetrait($montant)

Pour :

- rechercher le barème correspondant
- retourner les frais

---

### Calculer le montant total

calculerMontantTotal($montant, $fraisTransfert, $fraisRetrait, $inclure)

Pour :

- calculer le montant total à débiter
- retourner le montant total

----

