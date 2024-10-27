<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/Articles', 'Articles::index');
$routes->get('Articles/(:num)', 'Articles::show/$1');
$routes->get('Articles/new', 'Articles::new');
$routes->post("Articles/create", "Articles::create");
$routes->get("Articles/edit/(:num)", "Articles::edit/$1");
$routes->post("Articles/update/(:num)", "Articles::update/$1");
$routes->get("Articles/delete/(:num)", "Articles::delete/$1");
$routes->post("Articles/delete/(:num)", "Articles::delete/$1");