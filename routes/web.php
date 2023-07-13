<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IsTakipController;

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
    if (Auth::user())
        return view('admin/index');
    return view('/welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [MainController::class, 'index'])->name('ana_sayfa');

    Route::get('/admin/musteriler', [MainController::class, 'musteriler'])->name('musteriler');
    Route::get('/admin/musteriler/{type}/{id}', [MainController::class, 'MusteriGetFunction'])->name('musteri_function');
    Route::post('/admin/musteriler', [MainController::class, 'MusteriKaydet'])->name('musteri_kaydet');    
    Route::post('/admin/musteriler/{id}', [MainController::class, 'MusteriGuncelle'])->name('musteri_duzenle');
    

    Route::get('/admin/users', [UserController::class, 'KullaniciListesi'])->name('kullanicilar');
    Route::get('/admin/users/{type}/{id}', [UserController::class, 'KullaniciGetFunction'])->name('kullanici_function');
    Route::post('/admin/users', [UserController::class, 'UserKaydet'])->name('user_kaydet');  
    Route::post('/admin/users/{id}', [UserController::class, 'UserGuncelle'])->name('user_guncelle');


    Route::resource('/admin/is_takip', IsTakipController::class);
});
