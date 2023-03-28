<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the products endpoint
$router->get('/products', 'ProductController@getAll');
$router->get('/products/(\d+)', 'ProductController@getOne');
$router->post('/products', 'ProductController@create');
$router->put('/products/(\d+)', 'ProductController@update');
$router->delete('/products/(\d+)', 'ProductController@delete');

// routes for the categories endpoint
$router->get('/categories', 'CategoryController@getAll');
$router->get('/categories/(\d+)', 'CategoryController@getOne');
$router->post('/categories', 'CategoryController@create');
$router->put('/categories/(\d+)', 'CategoryController@update');
$router->delete('/categories/(\d+)', 'CategoryController@delete');

// routes for the users endpoint
$router->post('/users/login', 'UserController@login');
$router->post('/users/register', 'UserController@register');
$router->get('/users', 'UserController@getAll');

// routes for the movies endpoint
$router->get('/movies', 'MovieController@getAll');
$router->get('/movies/(\d+)', 'MovieController@getMovie');
$router->post('/movies', 'MovieController@addMovie');
$router->put('/movies/(\d+)', 'MovieController@updateMovie');
$router->delete('/movies/(\d+)', 'MovieController@deleteMovie');
$router->get('/genres/([a-zA-Z]+)', 'MovieController@getGenre');

// Run it!
$router->run();