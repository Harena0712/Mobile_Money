# Mobile Money
## Coté Operateur
### Configuration des préfixes valable de l’opérateur
- [x] Route `operateur/prefixes::liste` : permet de récupérer la liste des préfixes valables pour l’opérateur
- [x] Route `operateur/prefixes/inserer::inserer` : permet d’insérer un nouveau préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/create::create` : permet de créer un nouveau préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/modif/id::modif(id)` : permet de modifier un préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/update::update` : permet de mettre à jour un préfixe valable pour l’opérateur
- [x] Route `operateur/prefixes/delete/id::delete(id)` : permet de supprimer un préfixe valable pour l’opérateur
- [x] Controller : `OperatorController` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/liste` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/create` avec tout les fonctions de gestion des préfixes valables pour l’opérateur
- [x] Page : `operateur/prefixes/modif` avec tout les fonctions de gestion des préfixes valables pour l’opérateur

### Création de types d'opérations (dépôt, retrait, transfert) avec des barèmes de frais par tranche de montant 
- [x] Route `operateur/operationTypes::liste` : permet de récupérer la liste des types d'opérations
- [x] Route `operateur/operationTypes/voir/(:num)::voir($1)` : permet de voir les détails d'un type d'opération
- [x] Route `operateur/operationTypes/create::create()` : permet de créer un nouveau type d'opération
- [x] Route `operateur/operationTypes/inserer::inserer()` : permet d’insérer un nouveau type d'opération
- [x] Route `operateur/operationTypes/modif/id::modif(id)` : permet de modifier un type d'opération
- [x] Route `operateur/operationTypes/update::update()` : permet de mettre à jour un type d'opération
- [ ] Route `operateur/operationTypes/delete/id::delete(id)` : permet de supprimer un type d'opération
- [ ] Route `operateur/operationTypes/bareme/id::listeBareme(id)` : permet de liste les bareme de frais par tranche de montant pour un type d'opération 
- [ ] Controller : `OperatorController` avec tout les fonctions de gestion des types d'opérations et de leurs barèmes
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