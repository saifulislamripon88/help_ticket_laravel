<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// login router

Route::get('/', [AuthController::class, 'login'])->name('view.login');
Route::view('/register', '/Auth.registration');
Route::post('/newregister', [AuthController::class, 'register'])->name('view.registration');
Route::post('/userLogin', [AuthController::class, 'loginUser'])->name('user.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');



// this is routing group system------------------------
Route::middleware('auth.user')->group(function () {
    Route::get('/ticket', [TicketController::class, 'showAllTicket'])->name('ticket');
    Route::view('/create', 'storeticket');
    Route::post('/store', [TicketController::class, 'storeTicket'])->name('ticket.store');
    Route::get('/updateTicket/{id}', [TicketController::class, 'ticketUpdateView'])->name('update.view');
    Route::post('/updateTicket/{id}', [TicketController::class, 'ticketUpdate'])->name('ticket.update');
    Route::get('/delete/{id}', [TicketController::class, 'deleteTicket'])->name('ticket.delete');
    Route::get('/tickets/{id}', [TicketController::class, 'ticketDetails'])->name('ticket.details');
    Route::get('/contents/{id}', [TicketController::class, 'readContents'])->name('ticket.contents');
});







