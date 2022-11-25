<?php

use App\Http\Controllers\masterKampusController;
use Illuminate\Support\Facades\Route;
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


Route::get('/kampus', [masterKampusController::class, 'index'])->name('masterKampus.index');
Route::get('/tambah-kampus', [masterKampusController::class, 'showinsert'])->name('masterKampus.showinsert');
Route::post('/tambah-kampus', [masterKampusController::class, 'store'])->name('masterKampus.store');

// Route::get('/update-kampus', [masterKampusController::class, 'detail'])->name('masterKampus.detail');
Route::get('/update-kampus', [masterKampusController::class, 'edit'])->name('masterKampus.edit');
Route::post('/update-kampus', [masterKampusController::class, 'update'])->name('masterKampus.update');

Route::get('/delete-kampus{id}', [masterKampusController::class, 'destroy'])->name('masterKampus.delete');
