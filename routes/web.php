<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TicketController;


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


Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/client/users/', function () {
    return view('admin.register');
})->name('register.client');




Route::get('/support/users/', function () {
    return view('admin.register');
})->name('register.support');



Route::prefix('client')->middleware('auth')->group(function () {
    Route::get('home', [App\Http\Controllers\TicketController::class, 'dashboard'])->name('client.home');
    Route::resource('products', ProductController::class);
    Route::get('products', [App\Http\Controllers\ProductController::class, 'indexPublic'])->name('products.public');
    Route::get('tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('client.tickets');
    Route::get('tickets/{id}', [App\Http\Controllers\TicketController::class, 'show'])->name('client.tickets.show');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('home', [App\Http\Controllers\TicketController::class, 'dashboard'])->name('admin.home');
    Route::get('users/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.users.index');
    Route::get('users/create/{user}', [App\Http\Controllers\Admin\RegisterController::class, 'create'])->name('admin.users.create');
    Route::post('users', [App\Http\Controllers\Admin\RegisterController::class, 'register'])->name('admin.users.register');
    Route::get('users/edit/{user}/{id}/', [App\Http\Controllers\Admin\RegisterController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [App\Http\Controllers\Admin\RegisterController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}/{type}/', [App\Http\Controllers\Admin\RegisterController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('products', ProductController::class);
    Route::get('tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('admin.tickets');
    Route::get('tickets/{id}', [App\Http\Controllers\TicketController::class, 'show'])->name('admin.tickets.show');
});

Route::prefix('support')->middleware('auth')->group(function () {
    Route::get('home', [App\Http\Controllers\TicketController::class, 'dashboard'])->name('support.home');
    Route::get('products', [App\Http\Controllers\ProductController::class, 'indexPublic'])->name('products.public');
    Route::get('tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('support.tickets');
    Route::get('tickets/{id}', [App\Http\Controllers\TicketController::class, 'show'])->name('support.tickets.show');
    Route::get('tickets/commit/{id}/{state}', function () {
        return view('ticket.support');
    })->name('support.ticket.commit');
    Route::post('tickets/support', [App\Http\Controllers\TicketController::class, 'add_support'])->name('support.add_support');
});

Route::get('admin/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);
Route::get('client/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);
Route::get('support/prod', [App\Http\Controllers\ProductController::class, 'indexPublic']);


Route::resource('purchases', PurchaseController::class);
Route::resource('tickets', TicketController::class);
Route::resource('tickets/reaperute', TicketController::class);


Route::get('tickets/create/{purchase}', [App\Http\Controllers\ticketController::class, 'create'])->name('tickets.generate');
Route::post('tickets/support/', [App\Http\Controllers\ticketController::class, 'add_support'])->name('tickets.add_support');
Route::get('tickets/reaperture/{ticket}', [App\Http\Controllers\ticketController::class, 'reaperture'])->name('tickets.reaperture');

Route::get('tickets/support/commit/{id}/{state}', function () {
    return view('ticket.support');
})->name('tickets.support_commit');



Route::get('export/tickets', [App\Http\Controllers\UserController::class, 'export'])->name('tickets_export');


