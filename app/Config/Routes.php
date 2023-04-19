<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Custom Placeholder
$routes->addPlaceholder('nis', '[0-9]{8}');
$routes->addPlaceholder('username', '[0-9]{8}');
$routes->addPlaceholder('dotnis', '[0-9]{2}\.[0-9]{6}');

// Routes
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::index');
$routes->get('/nilai', 'Home::nilai', ['filter' => 'role:siswa']);

$routes->get('/application', 'Home::application', ['filter' => 'role:siswa,admin']);

$routes->get('/kehadiran', 'Home::daftarHadir', ['filter' => 'role:siswa']);
$routes->get('/kehadiran/(:num)', 'Home::daftarHadir/$1', ['filter' => 'role:siswa']);
$routes->post('/kehadiran/store', 'LogBook::store', ['filter' => 'role:siswa']);

$routes->get('/tempat', 'Home::tempat', ['filter' => 'role:siswa']);
$routes->post('/tempat/daftar', 'Application::daftar', ['filter' => 'role:siswa']);

$routes->get('/logbook/(:num)', 'Home::logbooks/$1', ['filter' => 'role:pembimbing']);
$routes->get('/logbook/(:num)/(:nis)', 'Home::logbook_siswa/$1/$2', ['filter' => 'role:pembimbing']);
$routes->post('/logbook/status/update', 'LogBook::status_update', ['filter' => 'role:pembimbing']);

$routes->get('/man/tempat', 'Home::man_tempat', ['filter' => 'role:admin']);
$routes->get('/man/user', 'Home::man_user', ['filter' => 'role:admin']);
$routes->get('/man/siswa', 'Home::man_siswa', ['filter' => 'role:admin']);
$routes->get('/settings', 'Home::settings', ['filter' => 'role:admin']);

$routes->group('pengumuman', function($p) {
    $p->get('/', 'Pengumuman::Index');
    $p->get('get/(:num)', 'Pengumuman::get/$1');
    $p->post('store', 'Pengumuman::store');
    $p->delete('destroy/(:num)', 'Pengumuman::destroy/$1');
});

// group routes
$routes->group('jurusan', function ($j) {
    $j->post('store', 'Jurusan::store');
    $j->post('update', 'Jurusan::update');
    $j->delete('destroy/(:num)', 'Jurusan::destroy/$1');
});

$routes->group('angkatan', function ($a) {
    $a->get('getangkatan', 'Angkatan::getAngkatan');
    $a->post('store', 'Angkatan::store');
    $a->delete('destroy/(:num)', 'Angkatan::destroy/$1');
});

$routes->group('siswa', function ($s) {
    $s->get('add', 'Siswa::index');
    $s->post('ceknis', 'Siswa::ceknis');
    $s->get('edit/(:nis)', 'Home::siswa_edit/$1');
    $s->post('store', 'Siswa::store');
    $s->post('update', 'Siswa::update');
    $s->delete('destroy/(:num)', 'Siswa::destroy/$1');
});

$routes->group('user', function ($u) {
    $u->post('store', 'User::store');
    $u->post('update', 'User::update');
    $u->delete('destroy/(:num)', 'User::destroy/$1');
});

$routes->group('tempat', function ($t) {
    $t->get('edit/(:num)', 'Home::tempat_edit/$1');
    $t->post('store', 'TempatMagang::store');
    $t->post('update', 'TempatMagang::update');
    $t->post('status/update', 'TempatMagang::status_update');
    $t->delete('destroy/(:num)', 'TempatMagang::destroy/$1');
});

$routes->group('application', ['filter' => 'role:admin'], function ($app) {
    $app->delete('destroy/(:num)', 'Application::destroy/$1');
    $app->post('status/update', 'Application::update');
});

// routes group for 


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
