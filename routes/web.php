<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LeadController;

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

// Home Page Route
Route::view('/', 'welcome');

// Dashbaord
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard.index');

// User CRUD
Route::resource('user',UserController::class);



// User Profile Routes by Default

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/lead', [LeadController::class, 'get']);

Route::get('/lead-create', [LeadController::class, 'create']);

Route::post('/lead-store', [LeadController::class, 'store'])->name('storeLead');



Route::get('/lead-edit/{id}', [LeadController::class, 'edit'])->name('editLead');

Route::post('/lead-update/{id}', [LeadController::class, 'update'])->name('updateLead');

Route::get('/lead-delete/{id}', [LeadController::class, 'delete'])->name('deleteLead');
