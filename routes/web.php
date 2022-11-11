<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserActionController;
use App\Http\Controllers\ClientActionController;

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

Route::match(['get', 'post'], '/newUser', function () {
    return view('users.registerUser');
});

Route::post('/addClient', function (){
    return view('userClients.addNewClient');
});

Route::post('/changeClient', [ClientActionController::class, 'findEditClient']);

Route::post('/confirmChange',[ClientActionController::class, 'editClient']);

Route::match(['get', 'post'], '/login', [UserActionController::class, 'login'])->name('login');

Route::post('/attemptRegister', [UserActionController::class, 'registerUser']);

Route::post('/submitNewClient', [ClientActionController::class, 'newClient']);

Route::post('/removeClient', [ClientActionController::class, 'findDeleteClient']);

Route::post('/clientDeleted', [ClientActionController::class, 'confirmDelete']);

