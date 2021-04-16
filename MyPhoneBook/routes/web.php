<?php

use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('company')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('company_index');
    Route::get('/create', [CompanyController::class, 'create'])->name('company_create');
    Route::post('/create', [CompanyController::class, 'store'])->name('company_store');
    Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('company_edit');
    Route::post('/update/{id}', [CompanyController::class, 'update'])->name('company_update');
    Route::delete('/delete/{id}', [CompanyController::class, 'destroy'])->name('company_destroy');
    Route::get('/search', [CompanyController::class, 'search'])->name('company_search');
    Route::get('/{id}', [CompanyController::class, 'show'])->name('company_show');
});

Route::prefix('collaborator')->group(function(){
    Route::get('/', [CollaboratorController::class, 'index'])->name('collaborator_index');
    Route::get('/create', [CollaboratorController::class, 'create'])->name('collaborator_create');
    Route::post('/create', [CollaboratorController::class, 'store'])->name('collaborator_store');
    Route::get('/edit/{id}', [CollaboratorController::class, 'edit'])->name('collaborator_edit');
    Route::post('/update/{id}', [CollaboratorController::class, 'update'])->name('collaborator_update');
    Route::delete('/delete/{id}', [CollaboratorController::class, 'destroy'])->name('collaborator_destroy');
    Route::get('/search', [CollaboratorController::class, 'search'])->name('collaborator_search');
});

require __DIR__ . '/auth.php';
