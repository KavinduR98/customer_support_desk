<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AgentController;

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

Route::group(['middleware'=>'guest'],function(){

// Route::get('/', function () {
//     return view('customer.view_customer_ticket');
// });

Route::get('/view_agent_login', function () {
    return view('agent.login');
});
Route::get('/', [CustomerController::class, 'index'])->name('login');

//customer-ticket
Route::post('/submit_ticket', [CustomerController::class, 'save_data']);
Route::get('/check_ticket_info', [CustomerController::class, 'check_ticket_info']);

Route::post('/submitForm', [LoginController::class,'loginForm']);

});


Route::group(['middleware'=>'auth'],function(){

Route::get('/agent_dashboard', function () {
    return view('agent.view_agent_dashboard');
});

// Agent-ticket
Route::get('/get_all_tickets', [AgentController::class, 'get_all_tickets']);
Route::get('/view_ticket_details/{id}', [AgentController::class, 'view_ticket_details']);
Route::post('/save_reply/{id}', [AgentController::class, 'save_reply']);
Route::get('/get_reply/{id}', [AgentController::class, 'get_reply']);

Route::POST('/pending/save/{id}', [AgentController::class, 'pending']);
Route::POST('/inProgress/save/{id}', [AgentController::class, 'inProgress']);
Route::POST('/resolved/save/{id}', [AgentController::class, 'resolved']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});