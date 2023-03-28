<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::post('/', [CompanyController::class, 'create']);
    Route::post('/company/edit/{id}', [CompanyController::class, 'edit']);
    Route::delete('/company/delete/{id}', [CompanyController::class, 'delete']);
    Route::get('/company/{id}', [EmployeeController::class, 'index']);
    Route::post('/company/{id}', [EmployeeController::class, 'create']);
    Route::post('/company/employee/edit/{id}', [EmployeeController::class, 'edit']);
    Route::delete('/company/employee/delete/{id}', [EmployeeController::class, 'delete']);
});

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
