<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TicketController;
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


Route::get('/prod',function(){
    return Product::all();
    // return view('admin.home');
})->name('admin.home');

Route::get('/client/users/', function(){
    return view('admin.register');
})->name('register.client');




Route::get('/support/users/', function(){
    return view('admin.register');
})->name('register.support');




// Route::post('/admin/users/create/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'register'])->name('admin.users.create');


//Route::delete('users/{id}/{type}/', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
// Route::get('users/{id}/edit/', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
// Route::put('users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
// Route::resource('{user}/products', ProductController::class);


Route::get('/pruebas',[App\Http\Controllers\UserController::class, 'test']);

Route::get('tests',function(){
    $user = Auth::user();
// Para obtener el ID:
return $user->id;
});

Route::get('cliente/products', [App\Http\Controllers\ProductController::class, 'indexPublic']);


Route::prefix('client')->middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('products', [App\Http\Controllers\ProductController::class, 'indexPublic'])->name('products.public');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('home',function(){
        return view('admin.home');
    })->name('admin.home');
    Route::get('users/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.users.index');
    Route::get('users/create/{user}', [App\Http\Controllers\Admin\RegisterController::class, 'create'])->name('admin.users.create');
    Route::post('users', [App\Http\Controllers\Admin\RegisterController::class, 'register'])->name('admin.users.register');
    Route::get('users/edit/{user}/{id}/', [App\Http\Controllers\Admin\RegisterController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [App\Http\Controllers\Admin\RegisterController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}/{type}/', [App\Http\Controllers\Admin\RegisterController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('products', ProductController::class);

});

Route::prefix('support')->middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('products', [App\Http\Controllers\ProductController::class, 'indexPublic'])->name('products.public');
});

Route::get('admin/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);
Route::get('client/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);
Route::get('support/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);


Route::resource('purchases', PurchaseController::class);
Route::resource('tickets', TicketController::class);


Route::get('tickets/create/{purchase}', [App\Http\Controllers\ticketController::class, 'create'])->name('tickets.generate');
Route::post('tickets/support/{id}', [App\Http\Controllers\ticketController::class, 'add_support'])->name('tickets.add_support');

Route::get('tickets/support/commit/{id}/{state}',function(){
    return view('ticket.support');
})->name('tickets.support_commit');






