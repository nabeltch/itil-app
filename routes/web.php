<?php

use Akaunting\Apexcharts\Chart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Ticket;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PostsController;
use SebastianBergmann\LinesOfCode\Counter;

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

// Route::get('/client/home', function(){
//     return view('client.home');
// })->middleware('auth');

// Route::get('/support/home', function(){
//     return view('support.home');
// })->middleware('auth');


// Route::get('admin/home',function(){
//     // return Product::all();
//     return view('admin.home');
// })->name('admin.home');

Route::get('/client/users/', function () {
    return view('admin.register');
})->name('register.client');




Route::get('/support/users/', function () {
    return view('admin.register');
})->name('register.support');




// Route::post('/admin/users/create/{type}', [App\Http\Controllers\Admin\RegisterController::class, 'register'])->name('admin.users.create');


//Route::delete('users/{id}/{type}/', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
// Route::get('users/{id}/edit/', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
// Route::put('users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
// Route::resource('{user}/products', ProductController::class);


Route::get('/pruebas', [App\Http\Controllers\UserController::class, 'test']);

Route::get('tests', function () {
    $user = Auth::user();
    // Para obtener el ID:
    return $user->id;
});




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


// Route::get('admin/home',function(){
// // $total=count(Ticket::where('state',4)->get());
// // return $total;


// // $collection->push(['id' => 4, 'name' => 'screen']);

// // return $collection->all();

// //dd($collection);
// // $data=1;
// function tickets_client(){
// $collection = collect([
//     ['total' => count(Ticket::where('id_client',auth()->user()->id)->get())],
//     ['t_sol' => count(Ticket::where([['state',4],['id_client',auth()->user()->id]])->get())],
//     ['t_pen' => count(Ticket::where([['state',3],['id_client',auth()->user()->id]])->get())],
// ]);
// return view('admin.home',compact('collection'));
// }

// function tickets_all(){
// $collection = collect([
//     ['total' => count(Ticket::all())],
//     ['t_sol' => count(Ticket::where('state',4)->get())],
//     ['t_pen' => count(Ticket::where('state',3)->get())],
// ]);
// return view('admin.home',compact('collection'));
// }

// if (auth()->user()->type ==='client'){
//     return tickets_client();
// }else{
//     return tickets_all();
// }



// // function return_view(){
// //     $client=Ticket::all();

// // $collection = collect([
// //     ['total' => count($client)],
// //     ['t_sol' => count(Ticket::where('state',4)->get())],
// //     ['t_pen' => count(Ticket::where('state',3)->get())],
// // ]);
// //     return view('admin.home',compact('collection'));
// // }
// // return return_view();

// });

Route::get('date', function () {

    
    //     //convertimos la fecha 1 a objeto Carbon
    // $carbon1 = new \Carbon\Carbon("2023-06-24 04:38:36");
    // //convertimos la fecha 2 a objeto Carbon
    // $carbon2 = new \Carbon\Carbon(null);
    // //de esta manera sacamos la diferencia en minutos
    // $minutesDiff=$carbon1->diffInMinutes($carbon2);
    //     // return view('ticket.support');

    //     return $total/12*100;
    //  $counter=0;
    // foreach($tickets as $ticket){
    //     $carbon1 = new \Carbon\Carbon($ticket->created_at);
    //     $carbon2 = new \Carbon\Carbon($ticket->start_time_support);
    //     $total=$carbon1->diffInMinutes($carbon2);
    //     if ($total <=30) {
    //        $counter++;
    //     }
    // }
    // // return $counter/$total_tickets*100;
    return dd($tickets, $data_indicators);
});


Route::get('export/tickets', [App\Http\Controllers\UserController::class, 'export'])->name('tickets_export');

Route::get('chart', [App\Http\Controllers\TicketController::class, 'dashboard'])->name('support.home');
