<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/task', [App\Http\Controllers\TaskController::class, 'index']);



Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index']);
Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store_employee'])->name('store_employee');
Route::get('/fetch-employees', [App\Http\Controllers\EmployeeController::class, 'fetchEmployees'])->name('fetch_employees');
Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'editEmployee']);
Route::post('/employee/update/{id}', [App\Http\Controllers\EmployeeController::class, 'updateEmployee'])->name('updateEmployee');
Route::get('/employee/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'delete']);
