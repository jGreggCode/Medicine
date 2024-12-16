<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->post('auth/processRegister', 'Auth::processRegister');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('medicine', 'Medicine::index', ['filter' => 'auth']);
$routes->get('medicine/create', 'Medicine::create', ['filter' => 'auth']);
$routes->post('medicine/store', 'Medicine::store', ['filter' => 'auth']);
$routes->get('medicine/edit/(:num)', 'Medicine::edit/$1', ['filter' => 'auth']);
$routes->post('medicine/update/(:num)', 'Medicine::update/$1', ['filter' => 'auth']);
$routes->post('medicine/delete/(:num)', 'Medicine::delete/$1', ['filter' => 'auth']);
$routes->get('medicine/get/(:num)', 'Medicine::get/$1', ['filter' => 'auth']);
$routes->get('auth/test', 'Auth::testConnection');
$routes->post('consultation/store', 'Consultation::store', ['filter' => 'auth']);
$routes->get('consultation/get/(:num)', 'Consultation::get/$1', ['filter' => 'auth']);
$routes->post('consultation/update/(:num)', 'Consultation::update/$1', ['filter' => 'auth']);
$routes->post('consultation/delete/(:num)', 'Consultation::delete/$1', ['filter' => 'auth']);
