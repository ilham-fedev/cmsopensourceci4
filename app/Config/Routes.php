<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('FrontEnd');
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

/** FrontEnd */
$routes->get('/', 'FrontEnd::index');
$routes->get('/page/(:any)', 'FrontEnd::page/$1');
$routes->get('/agenda', 'FrontEnd::agenda');
$routes->get('/agenda-detail/(:any)', 'FrontEnd::api_agenda/$1');
$routes->get('/berita', 'FrontEnd::news');
$routes->get('/baca/(:any)', 'FrontEnd::read/$1');
$routes->get('/kategori/(:any)', 'FrontEnd::category/$1');
$routes->get('/tags/(:any)', 'FrontEnd::tags/$1');
$routes->get('/hubungi', 'FrontEnd::contact');
$routes->get('/search', 'FrontEnd::search');
$routes->get('/galeri', 'FrontEnd::galeri');
$routes->get('/galeri-detail/(:any)', 'FrontEnd::galeri_detail/$1');
$routes->get('/download', 'FrontEnd::download');

/**
 * Login Pages
 */
$routes->get('/cms-login', 'Auth::index');
$routes->post('/auth-check', 'Auth::check');

/** Logout */
$routes->get("/cms-logout", function(){
	session()->destroy();

	return redirect("cms-login");
});

/**
 * Panel Page
 */
$routes->group("panel", ["namespace" => "App\Controllers\Panel"] ,function($routes){
	/** Dashboard */
	$routes->add("/", "Dashboard::index",['filter' => 'gate']);
	$routes->add("dashboard", "Dashboard::index");
	$routes->get("dashboard-api", "Dashboard::api");
	/** Identitas */
	$routes->get("identitas", "Identitas::index");
	$routes->post("identitas", "Identitas::update");
	/** Hubungi */
	$routes->get("hubungi", "Hubungi::index");
	$routes->post("hubungi", "Hubungi::update");
	/** Users */
	$routes->resource('user');
	/** Menu */
	$routes->resource('menu', ['controller' =>'MainMenu']);
	/** SubMeu */
	$routes->resource('submenu', ['controller' =>'SubMenu']);
	/** Halaman */
	$routes->resource('halaman');
	/** Tag */
	$routes->resource('tag');
	/** Kategori */
	$routes->resource('kategori');
	/** Berita */
	$routes->resource('berita');
	/** Album */
	$routes->resource('album');
	/** Photo */
	$routes->resource('photo');
	/** Banner */
	$routes->resource('banner');
	/** Banner */
	$routes->resource('agenda');
	/** Polls */
	$routes->resource('polls');
	/** Polls */
	$routes->resource('pinned');
	/** Download */
	$routes->resource('download');
	/** Template */
	$routes->resource('template', ['filter' => 'gate']);
	/** Template Custom Routes */
	$routes->post('template/activate/(:num)', 'Template::activate/$1', ['filter' => 'gate']);
	$routes->get('template/export/(:num)', 'Template::export/$1', ['filter' => 'gate']);
	$routes->get('template/import', 'Template::import', ['filter' => 'gate']);
	$routes->post('template/doImport', 'Template::doImport', ['filter' => 'gate']);
	$routes->get('template/preview/(:num)', 'Template::preview/$1', ['filter' => 'gate']);
	$routes->get('template/search', 'Template::search', ['filter' => 'gate']);

	/** Akun */
	$routes->get('akun/edit', "Account::edit");
	$routes->get('akun/ubah-password', "Account::ubah_password");
	$routes->post('akun/save', "Account::save");
	$routes->post('akun/save-password', "Account::save_password");

	/** Upload Image */
	$routes->post("upload-image", "Dashboard::upload");
});
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
