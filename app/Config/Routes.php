<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ConnexionController::index');
$routes->get('/produits', 'Produit::index');
$routes->get('/produit/(:num)', 'Produit::show/$1');
$routes->get('/etudiants', 'Etudiant::index');

$routes->get('/client/login', 'ConnexionController::index');
$routes->post('/client/login', 'ConnexionController::login');
$routes->get('/client/logout', 'ConnexionController::logout');

$routes->get('/client/solde', 'SoldeController::index');

$routes->get('/client/depot', 'DepotController::index');
$routes->post('/client/depot', 'DepotController::enregistrer');
