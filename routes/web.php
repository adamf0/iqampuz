<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use \Illuminate\Support\Facades\Artisan;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// use Laravel\Lumen\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    Artisan::call('migrate');
    return "{$router->app->version()} <br>".Artisan::output();
});

$router->post('/auth/login', 'AuthController@doLogin');
$router->get('/auth/decode', 'AuthController@decode');
$router->post('/auth/init', 'AuthController@init');
$router->get('/load/panel', function(){});
$router->get('/load/modul', function(){});
$router->get('/load/config', function(){});

$router->post('/auth/create_user', 'AuthController@create_auth_user');
$router->post('/auth/create_admin', 'AuthController@create_auth_admin');
// $router->post('/mahasiswa', 'AuthController@create_auth_user');