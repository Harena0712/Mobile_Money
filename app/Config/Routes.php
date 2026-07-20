<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('operateur/prefixes', 'Prefixe::liste');
$routes->get('operateur/prefixes/create', 'Prefixe::create');
$routes->post('operateur/prefixes/inserer', 'Prefixe::inserer');
$routes->get('operateur/prefixes/modif/(:num)', 'Prefixe::modif/$1');
$routes->post('operateur/prefixes/update', 'Prefixe::update');
$routes->get('operateur/prefixes/delete/(:num)', 'Prefixe::delete/$1');

$routes->get('operateur/typesOperation', 'TypeOperation::liste');
$routes->get('operateur/typesOperation/voir/(:num)', 'TypeOperation::voir/$1');
$routes->get('operateur/typesOperation/create', 'TypeOperation::create');
$routes->post('operateur/typesOperation/inserer', 'TypeOperation::inserer');
$routes->get('operateur/typesOperation/modif/(:num)', 'TypeOperation::modif/$1');
$routes->post('operateur/typesOperation/update', 'TypeOperation::update');
$routes->get('operateur/typesOperation/delete/(:num)', 'TypeOoperateur/situationFraisperation::delete/$1');

$routes->get('operateur/situationFrais', 'SituationFrais::liste');

$routes->get('operateur/situationComptes', 'SituationComptes::liste');