<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [MainController::class, 'index'])->name('ana_sayfa');
    Route::get('/admin/musteriler', [MainController::class, 'musteriler'])->name('musteriler');

    Route::post('/admin/musteriler', [MainController::class, 'MusteriKaydet'])->name('musteri_kaydet');
    Route::get('/admin/musteriler/{id}', [MainController::class, 'MusteriBilgileri'])->name('musteri_bilgileri');
    Route::post('/admin/musteriler/{id}', [MainController::class, 'MusteriGuncelle'])->name('musteri_duzenle');
});
