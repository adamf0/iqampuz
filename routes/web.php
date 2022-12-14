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
use App\Http\Controllers\biayaController;
use App\Http\Controllers\gelombangController;
use App\Http\Controllers\tahunAjarController;
use App\Http\Controllers\PanelMenuController;
use App\Http\Controllers\masterKampusController;
use App\Http\Controllers\ManajemenUserController;
use App\Models\Jurusan;
use App\Models\Wilayah;
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
Route::get('/wilayah/{type}/{kode}', [masterKampusController::class, 'wilayah'])->name('masterKampus.wilayah');

// komponen biaya
Route::get('/biaya/{id}', [biayaController::class, 'index'])->name('masterKampus.biaya.index');
Route::get('/delete-biaya/{id}/{id_kampus}', [biayaController::class, 'destroy'])->name('masterKampus.biaya.delete');
Route::post('/proses-biaya/{id}', [biayaController::class, 'store'])->name('masterKampus.biaya.store');
Route::post('/update-biaya/{id}', [biayaController::class, 'update'])->name('masterKampus.biaya.update');

// tahun ajar
Route::get('/tahun-ajar', [tahunAjarController::class, 'index'])->name('masterKampus.tahunajar.index');
Route::post('/tambah-tahun-ajar', [tahunAjarController::class, 'store'])->name('masterKampus.tahunajar.store');
Route::get('/tahun-ajar/{id}', [tahunAjarController::class, 'edit'])->name('masterKampus.tahunajar.edit');
Route::post('/edit-tahun-ajar/{id}', [tahunAjarController::class, 'update'])->name('masterKampus.tahunajar.update');
Route::get('/delete-tahun-ajar/{id}', [tahunAjarController::class, 'destroy'])->name('masterKampus.tahunajar.delete');


// gelombang
Route::get('/gelombang/{id_kampus}', [gelombangController::class, 'index'])->name('masterKampus.gelombang.index');
Route::post('/tambah-gelombang', [gelombangController::class, 'store'])->name('masterKampus.gelombang.store');
Route::get('/gelombang/edit/{id_gelombang}', [gelombangController::class, 'edit'])->name('masterKampus.gelombang.edit');
Route::post('/gelombang/update/{id_gelombang}', [gelombangController::class, 'update'])->name('masterKampus.gelombang.update');
Route::get('/gelombang/delete/{id_gelombang}', [gelombangController::class, 'destroy'])->name('masterKampus.gelombang.delete');







// debug
Route::post('/tes', [masterKampusController::class, 'tes'])->name('masterKampus.tes');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// kode adam
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');
Route::get('/panel/edit/{id}', [PanelController::class, 'edit'])->name('panel.edit');
Route::post('/panel/update/{id}', [PanelController::class, 'update'])->name('panel.update');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::get('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

Route::get('/panel_menu', [PanelMenuController::class, 'index'])->name('panel_menu.index');
Route::get('/panel_menu/create', [PanelMenuController::class, 'create'])->name('panel_menu.create');
Route::get('/panel_menu/edit/{id}', [PanelMenuController::class, 'edit'])->name('panel_menu.edit');
Route::post('/panel_menu/store', [PanelMenuController::class, 'store'])->name('panel_menu.store');
Route::post('/panel_menu/update/{id}', [PanelMenuController::class, 'update'])->name('panel_menu.update');
Route::get('/panel_menu/delete/{id}', [PanelMenuController::class, 'destroy'])->name('menu.destroy');
Route::post('/panel_menu/getAvailableMenus', [PanelMenuController::class, 'getAvailableMenus'])->name('panel_menu.available_menu');

Route::get('/hak_akses_menu', [HakAksesMenuController::class, 'index'])->name('hak_akses_menu.index');
Route::get('/hak_akses_menu/update', [HakAksesMenuController::class, 'create'])->name('hak_akses_menu.create');

Route::get('/management_user', [ManajemenUserController::class, 'index'])->name('ManajemenUser.index');
Route::get('/management_user/hakases/{id}', [ManajemenUserController::class, 'hakAkses'])->name('ManajemenUser.hakAkses');
