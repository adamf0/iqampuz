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
use App\Http\Controllers\KomponenBiayaController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PanelMenuController;
use App\Http\Controllers\masterKampusController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\MasterKomponenController;
use App\Models\HakAksesMenu;
use App\Models\Kampus;
use App\Models\MasterKomponen;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/master_komponen', [MasterKomponenController::class,'index'])->name('master_komponen.index');
Route::get('/master_komponen/create', [MasterKomponenController::class,'create'])->name('master_komponen.create');
Route::get('/master_komponen/edit/{id}', [MasterKomponenController::class,'edit'])->name('master_komponen.edit');
Route::post('/master_komponen/store', [MasterKomponenController::class,'store'])->name('master_komponen.store');
Route::post('/master_komponen/update/{id}', [MasterKomponenController::class,'update'])->name('master_komponen.update');
Route::get('/master_komponen/delete/{id}', [MasterKomponenController::class,'destroy'])->name('master_komponen.destroy');

Route::get('/komponen_biaya', [KomponenBiayaController::class,'index'])->name('komponen_biaya.index');
Route::get('/komponen_biaya/create', [KomponenBiayaController::class,'create'])->name('komponen_biaya.create');
Route::get('/komponen_biaya/edit/{id}', [KomponenBiayaController::class,'edit'])->name('komponen_biaya.edit');
Route::post('/komponen_biaya/store', [KomponenBiayaController::class,'store'])->name('komponen_biaya.store');
Route::post('/komponen_biaya/update/{id}', [KomponenBiayaController::class,'update'])->name('komponen_biaya.update');
Route::get('/komponen_biaya/delete/{id}', [KomponenBiayaController::class,'destroy'])->name('komponen_biaya.destroy');

Route::get('/hak_akses_menu', [HakAksesMenuController::class,'index'])->name('hak_akses_menu.index');
Route::get('/hak_akses_menu/create', [HakAksesMenuController::class,'create'])->name('hak_akses_menu.create');
Route::post('/hak_akses_menu/store', [HakAksesMenuController::class,'store'])->name('hak_akses_menu.store');
Route::get('/hak_akses_menu/delete/{id}', [HakAksesMenuController::class,'destroy'])->name('hak_akses_menu.destroy');

Route::get('/management_user', [ManajemenUserController::class,'index'])->name('ManajemenUser.index');
Route::get('/management_user/hakases/{id}', [ManajemenUserController::class,'hakAkses'])->name('ManajemenUser.hakAkses');

Route::get('/utility/{type}', function($type){
    if($type=="kampus"){
        $datas = Kampus::select('id','nama_kampus as text')->get();
        return response()->json($datas);
    }
    else if($type=="komponen"){
        $datas = MasterKomponen::select('id_komponen as id','nama_komponen as text')->get();
        return response()->json($datas);
    }
    else if($type=="role"){
        $datas = Role::select('id','nama as text')->get();
        return response()->json($datas);
    }
    else if($type=="db_ham"){
        $datas = DB::table('hak_akses_menu')
                    ->selectRaw('`hak_akses_menu`.`id_hak_akses_menu`, `kampus`.`nama_kampus` as kampus, `role`.`nama` as role, `m_panel`.`nama_panel` as panel, `m_menu`.`nama_menu` as menu')
                    ->join('kampus','kampus.id','=','hak_akses_menu.id_kampus')
                    ->join('role','role.id','=','hak_akses_menu.id_role')
                    ->join('m_panel_menu','m_panel_menu.id_menu_panel','=','hak_akses_menu.id_panel_menu')
                    ->join('m_panel','m_panel_menu.id_panel','=','m_panel.id_panel')
                    ->join('m_menu','m_panel_menu.id_menu','=','m_menu.id_menu')
                    ->get();
        
        return response()->json(["data"=>$datas]);
    }
    else{
        return response()->json(["status"=>"999","error"=>"error invaid"]);
    }
})->name('utility');

Route::get('/management_user/tambah', [ManajemenUserController::class,'tambah'])->name('ManajemenUser.tambah');
Route::post('/management_user/insert', [ManajemenUserController::class,'insert'])->name('ManajemenUser.insert');
Route::get('/management_user/hakases/{id}', [ManajemenUserController::class,'hakAkses'])->name('ManajemenUser.hakAkses');
Route::post('/management_user/hakases/{id}', [ManajemenUserController::class,'update'])->name('ManajemenUser.update');
Route::post('/testing', function(Request $request){
    dd($request->all());
})->name('testing');