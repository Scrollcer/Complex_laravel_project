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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/categories/edit/{id}',
        [App\Http\Controllers\CategoryController::class, 'editPage'])->name('category.editPage');
    Route::post('/categories/edit/{id}',
        [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categories/delete/{id}',
        [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/categories/add',
        [App\Http\Controllers\CategoryController::class, 'addPage'])->name('category.addPage');
    Route::post('/categories/add', [App\Http\Controllers\CategoryController::class, 'add'])->name('category.add');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/games/edit/{id}',
        [App\Http\Controllers\GameController::class, 'editPage'])->name('game.editPage');
    Route::post('/games/edit/{id}',
        [App\Http\Controllers\GameController::class, 'edit'])->name('game.edit');
    Route::post('/games/delete/{id}',
        [App\Http\Controllers\GameController::class, 'delete'])->name('game.delete');
    Route::get('/games/add',
        [App\Http\Controllers\GameController::class, 'addPage'])->name('game.addPage');
    Route::post('/games/add', [App\Http\Controllers\GameController::class, 'add'])->name('game.add');
});

Route::get('/categories/{name}/{id}',
    [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');

Route::get('/games/{id}', [App\Http\Controllers\GameController::class, 'index'])->name('game');
Route::get('/cart/{name}/{id}', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/buy/{id}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.buy');
Route::post('/cart/changeEmail',
    [App\Http\Controllers\CartController::class, 'changeEmail'])->name('cart.changeEmail');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

