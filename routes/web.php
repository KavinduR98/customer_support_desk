<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;


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
    return view('customer.view_customer_ticket');
});

Route::get('/view_agent_login', function () {
    return view('agent.login');
});

Route::post('/submitForm', [LoginController::class,'loginForm']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/agent_dashboard', function () {
    return view('agent.view_agent_dashboard');
});

//customer-ticket
Route::post('/submit_ticket', [CustomerController::class, 'save_data']);
Route::get('/check_ticket_info', [CustomerController::class, 'check_ticket_info']);
