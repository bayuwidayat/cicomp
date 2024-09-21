<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index');
$routes->post('/do_login', 'Auth::login_do');
$routes->get('/logout', 'Auth::logout_do');

$routes->get('/about', 'About::index');
$routes->get('/layanan', 'Layanan::index');
$routes->get('/layanan/(:any)', 'Layanan::detail/$1');
$routes->get('/blog', 'Blog::index');
$routes->get('/blog/(:any)', 'Blog::detail/$1');
$routes->get('/kategori/(:any)', 'Blog::kategori/$1');
$routes->get('/kontak', 'Home::kontak');
$routes->post('/kontak', 'Home::kontak_save');

// --- Route Dashboard ---
$routes->get('/ladmin', 'Ladmin\Dashboard::index');
$routes->get('/ladmin/dashboard', 'Ladmin\Dashboard::index');

// Upload/delete image for summernote
$routes->post('/ladmin/upload_image', 'Ladmin\Dashboard::upload_image');
$routes->post('/ladmin/delete_image', 'Ladmin\Dashboard::delete_image');

$routes->get('/ladmin/profile', 'Ladmin\Users::profile');
$routes->post('/ladmin/update_profile', 'Ladmin\Users::update_profile');

$routes->get('/ladmin/setting', 'Ladmin\Setting::index');
$routes->post('/ladmin/setting/update', 'Ladmin\Setting::update_setting');
$routes->post('/ladmin/setting/delete_gambar/(:any)/(:any)', 'Ladmin\Setting::ajax_delete_gambar/$1/$2');

$routes->get('/ladmin/hero', 'Ladmin\Hero::index');
$routes->get('/ladmin/hero/tambah', 'Ladmin\Hero::tambah');
$routes->post('/ladmin/hero/simpan', 'Ladmin\Hero::simpan');
$routes->get('/ladmin/hero/edit/(:num)', 'Ladmin\Hero::edit/$1');
$routes->post('/ladmin/hero/update', 'Ladmin\Hero::update');
$routes->post('/ladmin/hero/delete/(:any)', 'Ladmin\Hero::ajax_delete/$1');
$routes->post('/ladmin/hero/delete_banner/(:any)', 'Ladmin\Hero::ajax_delete_banner/$1');

$routes->get('/ladmin/klien', 'Ladmin\Klien::index');
$routes->get('/ladmin/klien/tambah', 'Ladmin\Klien::tambah');
$routes->post('/ladmin/klien/simpan', 'Ladmin\Klien::simpan');
$routes->get('/ladmin/klien/edit/(:num)', 'Ladmin\Klien::edit/$1');
$routes->post('/ladmin/klien/update', 'Ladmin\Klien::update');
$routes->post('/ladmin/klien/delete/(:any)', 'Ladmin\Klien::ajax_delete/$1');
$routes->post('/ladmin/klien/delete_gambar/(:any)/(:any)', 'Ladmin\Klien::ajax_delete_gambar/$1/$2');

$routes->get('/ladmin/testimoni', 'Ladmin\Testimoni::index');
$routes->get('/ladmin/testimoni/tambah', 'Ladmin\Testimoni::tambah');
$routes->post('/ladmin/testimoni/simpan', 'Ladmin\Testimoni::simpan');
$routes->get('/ladmin/testimoni/edit/(:num)', 'Ladmin\Testimoni::edit/$1');
$routes->post('/ladmin/testimoni/update', 'Ladmin\Testimoni::update');
$routes->post('/ladmin/testimoni/delete/(:any)', 'Ladmin\Testimoni::ajax_delete/$1');
$routes->post('/ladmin/testimoni/delete_thumbnail/(:any)', 'Ladmin\Testimoni::ajax_delete_thumbnail/$1');

$routes->get('/ladmin/tim', 'Ladmin\Tim::index');
$routes->get('/ladmin/tim/tambah', 'Ladmin\Tim::tambah');
$routes->post('/ladmin/tim/simpan', 'Ladmin\Tim::simpan');
$routes->get('/ladmin/tim/edit/(:num)', 'Ladmin\Tim::edit/$1');
$routes->post('/ladmin/tim/update', 'Ladmin\Tim::update');
$routes->post('/ladmin/tim/delete/(:any)', 'Ladmin\Tim::ajax_delete/$1');
$routes->post('/ladmin/tim/delete_avatar/(:any)', 'Ladmin\Tim::ajax_delete_avatar/$1');

$routes->get('/ladmin/statistik', 'Ladmin\Statistik::index');
$routes->get('/ladmin/statistik/tambah', 'Ladmin\Statistik::tambah');
$routes->post('/ladmin/statistik/simpan', 'Ladmin\Statistik::simpan');
$routes->get('/ladmin/statistik/edit/(:num)', 'Ladmin\Statistik::edit/$1');
$routes->post('/ladmin/statistik/update', 'Ladmin\Statistik::update');
$routes->post('/ladmin/statistik/delete/(:any)', 'Ladmin\Statistik::ajax_delete/$1');
$routes->post('/ladmin/statistik/delete_icon/(:any)', 'Ladmin\Statistik::ajax_delete_icon/$1');

$routes->get('/ladmin/layanan', 'Ladmin\Layanan::index');
$routes->get('/ladmin/layanan/tambah', 'Ladmin\Layanan::tambah');
$routes->post('/ladmin/layanan/simpan', 'Ladmin\Layanan::simpan');
$routes->get('/ladmin/layanan/edit/(:num)', 'Ladmin\Layanan::edit/$1');
$routes->post('/ladmin/layanan/update', 'Ladmin\Layanan::update');
$routes->post('/ladmin/layanan/delete/(:any)', 'Ladmin\Layanan::ajax_delete/$1');
$routes->post('/ladmin/layanan/delete_icon/(:any)', 'Ladmin\Layanan::ajax_delete_icon/$1');

$routes->get('/ladmin/about', 'Ladmin\About::index');
$routes->get('/ladmin/about/tambah', 'Ladmin\About::tambah');
$routes->post('/ladmin/about/simpan', 'Ladmin\About::simpan');
$routes->get('/ladmin/about/edit/(:num)', 'Ladmin\About::edit/$1');
$routes->post('/ladmin/about/update', 'Ladmin\About::update');
$routes->post('/ladmin/about/delete/(:any)', 'Ladmin\About::ajax_delete/$1');
$routes->post('/ladmin/about/delete_thumbnail/(:any)', 'Ladmin\About::ajax_delete_thumbnail/$1');

$routes->get('/ladmin/kategori', 'Ladmin\Kategori::index');
$routes->get('/ladmin/kategori/tambah', 'Ladmin\Kategori::tambah');
$routes->post('/ladmin/kategori/simpan', 'Ladmin\Kategori::simpan');
$routes->get('/ladmin/kategori/edit/(:num)', 'Ladmin\Kategori::edit/$1');
$routes->post('/ladmin/kategori/update', 'Ladmin\Kategori::update');
$routes->post('/ladmin/kategori/delete/(:any)', 'Ladmin\Kategori::ajax_delete/$1');

$routes->get('/ladmin/blog', 'Ladmin\Blog::index');
$routes->get('/ladmin/blog/tambah', 'Ladmin\Blog::tambah');
$routes->post('/ladmin/blog/simpan', 'Ladmin\Blog::simpan');
$routes->get('/ladmin/blog/edit/(:num)', 'Ladmin\Blog::edit/$1');
$routes->post('/ladmin/blog/update', 'Ladmin\Blog::update');
$routes->post('/ladmin/blog/delete/(:any)', 'Ladmin\Blog::ajax_delete/$1');
$routes->post('/ladmin/blog/delete_banner/(:any)', 'Ladmin\Blog::ajax_delete_banner/$1');

$routes->get('/ladmin/hubungi', 'Ladmin\Hubungi::index');
$routes->post('/ladmin/hubungi/delete/(:any)', 'Ladmin\Hubungi::ajax_delete/$1');
