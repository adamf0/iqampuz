<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HakAksesMenuController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PanelMenuController;
use App\Http\Controllers\masterKampusController;
use App\Http\Controllers\ManajemenUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/tes', function(){
//     $endpoint = "https://dev-api.ai.web.id/index.php/tes";
//     $client = new \GuzzleHttp\Client();

//     $response = $client->request('POST', $endpoint, ['verify'=>false,'formdata' => [
//         'email' => 'adamilkom00@gmail.com', 
//         'password' => '61qVhy',
//     ]]);

//     $content = json_decode($response->getBody()->getContents());
//     dd($content);
// });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// kode budi
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/kampus', [masterKampusController::class, 'index'])->name('masterKampus.index');
Route::get('/tambah-kampus', [masterKampusController::class, 'showinsert'])->name('masterKampus.showinsert');
Route::post('/tambah-kampus', [masterKampusController::class, 'store'])->name('masterKampus.store');
// Route::get('/update-kampus', [masterKampusController::class, 'detail'])->name('masterKampus.detail');
Route::get('/update-kampus', [masterKampusController::class, 'edit'])->name('masterKampus.edit');
Route::post('/update-kampus', [masterKampusController::class, 'update'])->name('masterKampus.update');
Route::get('/delete-kampus{id}', [masterKampusController::class, 'destroy'])->name('masterKampus.delete');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// kode adam
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/panel', [PanelController::class,'index'])->name('panel.index');
Route::get('/panel/edit/{id}', [PanelController::class,'edit'])->name('panel.edit');
Route::post('/panel/update/{id}', [PanelController::class,'update'])->name('panel.update');

Route::get('/menu', [MenuController::class,'index'])->name('menu.index');
Route::get('/menu/create', [MenuController::class,'create'])->name('menu.create');
Route::get('/menu/edit/{id}', [MenuController::class,'edit'])->name('menu.edit');
Route::post('/menu/store', [MenuController::class,'store'])->name('menu.store');
Route::post('/menu/update/{id}', [MenuController::class,'update'])->name('menu.update');
Route::get('/menu/delete/{id}', [MenuController::class,'destroy'])->name('menu.destroy');

Route::get('/panel_menu', [PanelMenuController::class,'index'])->name('panel_menu.index');
Route::get('/panel_menu/create', [PanelMenuController::class,'create'])->name('panel_menu.create');
Route::get('/panel_menu/edit/{id}', [PanelMenuController::class,'edit'])->name('panel_menu.edit');
Route::post('/panel_menu/store', [PanelMenuController::class,'store'])->name('panel_menu.store');
Route::post('/panel_menu/update/{id}', [PanelMenuController::class,'update'])->name('panel_menu.update');
Route::get('/panel_menu/delete/{id}', [PanelMenuController::class,'destroy'])->name('menu.destroy');
Route::post('/panel_menu/getAvailableMenus', [PanelMenuController::class,'getAvailableMenus'])->name('panel_menu.available_menu');

Route::get('/hak_akses_menu', [HakAksesMenuController::class,'index'])->name('hak_akses_menu.index');
Route::get('/hak_akses_menu/update', [HakAksesMenuController::class,'create'])->name('hak_akses_menu.create');

Route::get('/management_user', [ManajemenUserController::class,'index'])->name('ManajemenUser.index');
Route::get('/management_user/tambah', [ManajemenUserController::class,'tambah'])->name('ManajemenUser.tambah');
Route::post('/management_user/insert', [ManajemenUserController::class,'insert'])->name('ManajemenUser.insert');
Route::get('/management_user/hakases/{id}', [ManajemenUserController::class,'hakAkses'])->name('ManajemenUser.hakAkses');
