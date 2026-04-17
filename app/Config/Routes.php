<?php
$routes->get('/', 'Posts::index');

$routes->get('/register', 'Auth::register');
$routes->post('/save', 'Auth::save');

$routes->get('/login', 'Auth::login');
$routes->post('/check', 'Auth::check');

$routes->get('/logout', 'Auth::logout');

$routes->get('/posts', 'Posts::index');
$routes->get('/posts/create', 'Posts::create');
$routes->post('/posts/store', 'Posts::store');

$routes->get('/posts/(:num)/detail', 'Posts::detail/$1'); 

$routes->get('/posts/edit/(:num)', 'Posts::edit/$1');
$routes->post('/posts/update/(:num)', 'Posts::update/$1');

$routes->get('/posts/delete/(:num)', 'Posts::delete/$1');
$routes->group('api', function($routes) {
    $routes->get('posts', 'API\PostsAPI::index');
    $routes->get('posts/(:num)', 'API\PostsAPI::show/$1');
    $routes->post('posts', 'API\PostsAPI::create');
    $routes->put('posts/(:num)', 'API\PostsAPI::update/$1');
    $routes->delete('posts/(:num)', 'API\PostsAPI::delete/$1');
});
?>