<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
------------------------------------------------------
    rotte che portano a views con dati fake
------------------------------------------------------
*/

// Route::get('/pages', function () {
//     return view('admin.pages.index');
// })->name('admin.pages.index');

// Route::get('/pages/create', function () {
//     return view('admin.pages.create');
// })->name('admin.pages.create');

// Route::get('/photos', function () {
//     return view('admin.photos.index');
// })->name('admin.photos.index');

// Route::get('/photos/create', function () {
//     return view('admin.photos.create');
// })->name('admin.photos.create');

/*
======================================
    ROTTE VERSO I CONTROLLER
======================================
*/

//Guests
Route::resource('pages', 'PageController');

//Admin (CRUD)
Route::namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::resource('pages', 'PageController');
        Route::resource('photos', 'PhotoController');
    });
