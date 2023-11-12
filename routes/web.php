<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\pendapatanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.landing',[
        'title'=>'Home'
    ]);
})->name('home');

// * Authenticate 
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'auth')->name('login.auth');
    // * logout
    Route::post('/logout','logout')->name('logout');
});

Route::prefix('/dashboard/')->middleware('auth')->group(function () {
    
    // * Admin
    Route::middleware('admin')->group(function(){
        Route::resource('user/management', UserController::class);
        Route::resource('kendaraan/parkir', ParkirController::class);
        Route::controller(pendapatanController::class)->prefix('/pendapatan')->group(function(){
            Route::get('/parkir','parkir')->name('pendapatan.parkir');
            Route::get('/parkir/print','print')->name('pendapatan.print');
        });
    });
    //  * Operator Masuk
    Route::resource('kendaraan/masuk', MasukController::class);
    // * Operator Keluar
    Route::resource('kendaraan/keluar',KeluarController::class);
});
