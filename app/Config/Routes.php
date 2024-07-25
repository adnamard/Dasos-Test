<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::halamanlogin');
$routes->get('autentikasi/halamanregister', 'Auth::halamanregister');
$routes->get('autentikasi/halamanlogin', 'Auth::halamanlogin');
$routes->post('autentikasi/register', 'Auth::register');
$routes->post('autentikasi/login', 'Auth::login');
