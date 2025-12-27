<?php

use CodeIgniter\Router\RouteCollection;

// Beranda Pengguna
$routes->get('/', 'Pengguna\DashboardController::index');
$routes->get('/kontak', 'Pengguna\DashboardController::kontak');
$routes->get('/tentang', 'Pengguna\DashboardController::tentang');
$routes->get('event/search', 'HomeController::search');
// $routes->get('/', 'HomeController::index');
// $routes->get('/kontak', 'HomeController::kontak');
// $routes->get('/tentang', 'HomeController::tentang');
// $routes->get('event/search', 'HomeController::search');


$routes->get('login', 'AuthController::index');
$routes->post('auth/login/process', 'AuthController::loginProcess');

$routes->get('auth/register', 'AuthController::registerForm');
$routes->post('auth/register/process', 'AuthController::registerProcess');

$routes->get('auth/registerAdmin', 'AuthController::registerAdminForm');
$routes->post('auth/registerAdmin/process', 'AuthController::registerAdminProcess');

$routes->get('auth/logout', 'AuthController::logout');

$routes->group('superadmin', [
    'namespace' => 'App\Controllers\SuperAdmin',
    'filter'    => 'auth'
], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('admin', 'DashboardController::admin');
    $routes->get('pengguna', 'DashboardController::pengguna');
    $routes->get('event', 'DashboardController::event');
    $routes->get('kategori-event', 'DashboardController::kategoriEvent');
    $routes->get('pendaftar', 'DashboardController::peserta');
    $routes->get('template', 'DashboardController::template');
    $routes->get('sertifikat', 'DashboardController::sertifikat');
});

$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter'    => 'auth'
], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('pengguna', 'PenggunaController::index');

    // Event
    $routes->get('event', 'EventController::index');
    $routes->post('event/store', 'EventController::store');
    $routes->post('event/update/(:num)', 'EventController::update/$1');
    $routes->get('event/delete/(:num)', 'EventController::delete/$1');

    // Kategori Event
    $routes->get('kategori-event', 'KategoriEventController::index');
    $routes->post('kategori-event/store', 'KategoriEventController::store');
    $routes->post('kategori-event/update/(:num)', 'KategoriEventController::update/$1');
    $routes->get('kategori-event/delete/(:num)', 'KategoriEventController::delete/$1');

    // pendaftar
    $routes->get('pendaftar', 'PendaftarController::index');
    $routes->get('pendaftar/detail/(:num)', 'PendaftarController::detail/$1');
    $routes->post('pendaftar/ubahStatus/(:num)', 'PendaftarController::ubahStatus/$1');

    $routes->get('template', 'TemplateController::index');
    $routes->post('template/store', 'TemplateController::store');
    $routes->post('template/update/(:num)', 'TemplateController::update/$1');
    $routes->get('template/delete/(:num)', 'TemplateController::delete/$1');

    $routes->get('sertifikat', 'SertifikatController::index');
    $routes->post('sertifikat/store', 'SertifikatController::store');
    $routes->get('sertifikat/delete/(:num)', 'SertifikatController::delete/$1');

    $routes->get('sertifikat/preview/(:num)', 'SertifikatController::preview/$1');

    $routes->get('pendaftar/kirimEmail/(:num)', 'PendaftarController::kirimEmail/$1');

    //List Book Dates Event
    $routes->get('booked-events', 'DashboardController::bookedEvents');
});

$routes->group('pengguna', [
    'namespace' => 'App\Controllers\Pengguna',
    'filter'    => 'auth'
], function ($routes) {
    $routes->get('berandaLogin', 'DashboardController::index');
    $routes->get('tentang', 'DashboardController::tentang');
    $routes->get('kontak', 'DashboardController::kontak');

    $routes->get('pendaftaran/step1/(:num)', 'Pendaftaran::step1/$1');

    $routes->get('pendaftaran', 'Pendaftaran::index');
    $routes->post('pendaftaran/saveStep1', 'Pendaftaran::saveStep1');

    $routes->get('pendaftaran/getKategoriEvent/(:num)', 'Pendaftaran::getKategoriEvent/$1');
    $routes->get('pendaftaran/step2/(:num)', 'Pendaftaran::step2/$1');
    $routes->post('pendaftaran/saveStep2/(:num)', 'Pendaftaran::saveStep2/$1');

    $routes->get('pendaftaran/step3/(:num)', 'Pendaftaran::step3/$1');
    $routes->post('pendaftaran/saveStep3/(:num)', 'Pendaftaran::saveStep3/$1');

    $routes->get('pendaftaran/success/(:num)', 'Pendaftaran::success/$1');
    $routes->get('riwayat', 'RiwayatController::index');
    $routes->get('riwayat/detail/(:num)', 'RiwayatController::detail/$1');

    $routes->get('daftarpeserta', 'DaftarPesertaController::index');
    $routes->get('daftarpeserta/preview/(:num)', 'DaftarPesertaController::previewSertifikat/$1');
});
