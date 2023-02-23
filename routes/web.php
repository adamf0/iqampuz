<?php

            

/** @var \Laravel\Lumen\Routing\Router $router */
use \Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

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
    // Artisan::call('migrate');
    return "{$router->app->version()} <br>".Artisan::output();
});
$router->get('/clean', function () use ($router) {
    Artisan::call('optimize');
});

$router->post('/auth/login', ['middleware' => 'cors','uses' => 'AuthController@doLogin']);
$router->post('/auth/decode', ['middleware' => 'cors','uses' => 'AuthController@decode']);
$router->post('/auth/init', ['middleware' => 'cors','uses' => 'AuthController@init']);
$router->get('/load/panel', function(){});
$router->get('/load/modul', function(){});
$router->get('/load/config', function(){});

$router->post('/auth/create_user', ['middleware' => 'cors','uses' => 'AuthController@create_auth_user']);
$router->post('/auth/update_user', ['middleware' => 'cors','uses' => 'AuthController@update_auth_user']);
$router->post('/auth/create_admin', ['middleware' => 'cors','uses' => 'AuthController@create_auth_admin']);
$router->post('/upload_berkas', ['middleware' => 'cors','uses' => 'BerkasMahasiswaController@upload_berkas']);
// $router->post('/mahasiswa', 'AuthController@create_auth_user');

$router->get('/auth/to_panel', ['middleware' => 'cors','uses' => 'RoleController@to_panel']);
$router->post('/auth/to_menu', ['middleware' => 'cors','uses' => 'RoleController@to_menu']);
$router->get('/utility/{type}', ['middleware' => 'cors','uses' => 'UtilityController@get_data']);

$router->post('/tagihan', ['middleware' => 'cors','uses' => 'TagihanController@buat_tagihan']);
$router->post('/riwayat_tagihan', ['middleware' => 'cors','uses' => 'TagihanController@riwayat_tagihan']);
$router->get('/batal_tagihan/{id}', ['middleware' => 'cors','uses' => 'TagihanController@batal_tagihan']);