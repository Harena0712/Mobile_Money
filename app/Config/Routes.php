<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Prefixe::liste');
$routes->get('operateur/prefixes/create', 'Prefixe::create');
$routes->post('operateur/prefixes/inserer', 'Prefixe::inserer');
$routes->get('operateur/prefixes/modif/(:num)', 'Prefixe::modif/$1');
$routes->post('operateur/prefixes/update', 'Prefixe::update');
$routes->get('operateur/prefixes/delete/(:num)', 'Prefixe::delete/$1');

$routes->get('operateur', 'OperateurController::index');
$routes->get('operateur/ajouter', 'OperateurController::ajouter');
$routes->post('operateur/ajouter', 'OperateurController::enregistrer');
$routes->post('operateur/modifier', 'OperateurController::modifier');
$routes->post('operateur/activer', 'OperateurController::activer');
$routes->post('operateur/desactiver', 'OperateurController::desactiver');

$routes->get('operateur/typesOperation', 'TypeOperation::liste');
$routes->get('operateur/typesOperation/voir/(:num)', 'TypeOperation::voir/$1');
$routes->get('operateur/typesOperation/create', 'TypeOperation::create');
$routes->post('operateur/typesOperation/inserer', 'TypeOperation::inserer');
$routes->get('operateur/typesOperation/modif/(:num)', 'TypeOperation::modif/$1');
$routes->post('operateur/typesOperation/update', 'TypeOperation::update');
$routes->get('operateur/typesOperation/delete/(:num)', 'TypeOperation::delete/$1');

$routes->get('operateur/situationFrais', 'SituationFrais::liste');

$routes->get('commission', 'CommissionOperateurController::index');
$routes->get('commission/ajouter', 'CommissionOperateurController::ajouter');
$routes->post('commission/ajouter', 'CommissionOperateurController::enregistrer');
$routes->post('commission/modifier', 'CommissionOperateurController::modifier');

$routes->get('operateur/situationComptes', 'SituationComptes::liste');
$routes->get('/login', 'ConnexionController::index');
$routes->post('/login', 'ConnexionController::login');
$routes->get('/logout', 'ConnexionController::logout');
$routes->get('/solde', 'SoldeController::index');
$routes->get('/depot', 'DepotController::index');
$routes->post('/depot', 'DepotController::enregistrer');
$routes->get('/retrait', 'RetraitController::index');
$routes->post('/retrait', 'RetraitController::enregistrer');
$routes->get('/transfert', 'TransfertController::index');
$routes->post('/transfert', 'TransfertController::enregistrer');
$routes->get('/historique', 'HistoriqueController::index');
$routes->get('/produits', 'Produit::index');
$routes->get('/produit/(:num)', 'Produit::show/$1');
$routes->get('/etudiants', 'Etudiant::index');

$routes->get('/client/login', 'ConnexionController::index');
$routes->post('/client/login', 'ConnexionController::login');
$routes->get('/client/logout', 'ConnexionController::logout');
$routes->get('/client/solde', 'SoldeController::index');
$routes->get('/client/depot', 'DepotController::index');
$routes->post('/client/depot', 'DepotController::enregistrer');
$routes->get('/client/retrait', 'RetraitController::index');
$routes->post('/client/retrait', 'RetraitController::enregistrer');
$routes->get('/client/transfert', 'TransfertController::index');
$routes->post('/client/transfert', 'TransfertController::enregistrer');
$routes->get('/client/historique', 'HistoriqueController::index');
