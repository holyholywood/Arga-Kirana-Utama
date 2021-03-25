<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AdminController::index');
$routes->get('/cek', 'AdminController::cek');


// ADMIN

// Dashboard  -> admin
$routes->get('/dashboard', 'AdminController::index');
// Insert  -> admin
$routes->get('/add', 'AdminController::addView');
// delete -> admin
$routes->delete('/admin/delete', 'AdminController::delete');
// edit -> admin
$routes->get('/admin/edit/(:segment)', 'AdminController::edit/$1');
// rekapitulasi Data
$routes->get('/rekap', 'AdminController::rekap');
// User Management
$routes->get('/kelolapengguna', 'Kelolapengguna::index', ['filter' => 'role:admin, superadmin']);

$routes->delete('/kelolapengguna/deleteuser/', 'Kelolapengguna::deleteuser', ['filter' => 'role:admin, superadmin']);

//Pegawai
//Dashboard -> pegawai
$routes->get('/pegawai', 'Home::pegawai');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
