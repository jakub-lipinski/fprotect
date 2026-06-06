<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagesController;
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

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/usluga/{service:slug}', 'service')->name('service');
    Route::get('/realizacje', 'realizations')->name('realizations');
    Route::get('/realizacje/{realization:slug}', 'realization')->name('realization');
    Route::get('/polityka-prywatnosci', 'privacy')->name('privacy');
    Route::get('/kontakt', 'contact')->name('contact');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('/wyslij-wiadomosc', 'send')->name('contact.send');
});
