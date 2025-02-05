<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('dashboard', [LoginController::class, 'dashboard']);
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');


Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('loginPage', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('reports/add', [ReportController::class, 'create'])->name('reports.create');
Route::post('reports/store', [ReportController::class, 'store'])->name('reports.store');
Route::get('reports/show/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('reports/edit/{report}', [ReportController::class, 'edit'])->name('reports.edit');
Route::put('reports/update/{report}', [ReportController::class, 'update'])->name('reports.update');
Route::delete('reports/destroy/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');


Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('companies/add', [CompanyController::class, 'create'])->name('companies.create');
Route::post('companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::get('companies/show/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('companies/edit/{company}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('companies/update/{company}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('companies/destroy/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
// Route::resource('companies', CompanyController::class);
