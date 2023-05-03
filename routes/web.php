<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostsController;



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
    return view('welcome');
});


Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/client/home', function(){
    return view('client.home');
})->middleware('auth');

Route::get('/support/home', function(){
    return view('support.home');
})->middleware('auth');


Route::get('/admin/home',function(){
    // $users=User::all();
    return view('admin.home');
})->name('admin.home');

Route::get('/client/users/', function(){
    return view('admin.register');
})->name('register.client');

Route::get('/admin/users/create/{type}', function(){
    return view('admin.register');
})->name('admin.create');

Route::get('/admin/users/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.users.index');
// Route::get('/admin/users/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.users.create');
Route::get('/support/users/', function(){
    return view('admin.register');
})->name('register.support');




Route::post('/admin/users/create/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'register'])->name('admin.users.create');




Route::resource('products', ProductController::class);




