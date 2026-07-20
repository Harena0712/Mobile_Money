
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
