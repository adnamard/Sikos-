<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');

$routes->get('autentikasi/halamanlogin', 'Auth::halamanlogin');
$routes->get('autentikasi/halamanregister', 'Auth::halamanregister');
$routes->get('/auth/register', 'Auth::register');


$routes->get('/admin', 'Admin::index', ['filter' => 'role']);
$routes->get('admin/daftaruser', 'Admin::daftaruser', ['filter' => 'role']);
$routes->get('admin/daftarkamar', 'Admin::daftarkamar', ['filter' => 'role']);
$routes->get('admin/tambahkamar', 'Admin::tambahkamar', ['filter' => 'role']);
$routes->get('/admin/daftarkamar', 'Admin::daftarkamar', ['filter' => 'role']);

$routes->get('admin/(:segment)', 'Admin::detail/$1', ['filter' => 'role']);
$routes->get('admin/edit/(:segment)', 'Admin::edit/$1', ['filter' => 'role']);
$routes->post('admin/update/(:num)', 'Admin::update/$1', ['filter' => 'role']);
$routes->post('admin/save', 'Admin::save', ['filter' => 'role']);
$routes->get('sewa/delete/(:num)', 'Sewa::delete/$1', ['filter' => 'role']);


$routes->post('sewa/add/(:segment)', 'Sewa::add/$1');
$routes->post('sewa/', 'Sewa::index');
$routes->post('sewa/bayar', 'Sewa::bayar');


$routes->post('riwayat/', 'Riwayat::index');


$routes->get('Pembayaran/menunggu', 'Pembayaran::menunggu');
$routes->post('Pembayaran/update/(:segment)', 'Pembayaran::update/$1');
$routes->get('Pembayaran/diterima', 'Pembayaran::diterima');
$routes->get('Pembayaran/ditolak', 'Pembayaran::ditolak');
