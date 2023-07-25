<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\UserController;
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

Route::middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/employee', [EmployeeController::class, 'getEmployee'])->name('getEmployee');
    Route::get('/department', [DepartmentController::class, 'getDepartment'])->name('getDepartment');
    Route::get('/spending', [SpendingController::class, 'getSpending'])->name('getSpending');
    Route::get('/export-spending', [SpendingController::class, 'getExportSpending'])->name('getExportSpending');

    Route::delete('/delete-emp/{id}', [EmployeeController::class, 'doDeleteEmployee'])->name('doDeleteEmployee');
    Route::post('/update-emp/{id}', [EmployeeController::class, 'doUpdateEmpEmployee'])->name('doUpdateEmpEmployee');
});

Route::get('/login', [UserController::class, 'loginPage'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
Route::get('/register', [UserController::class, 'registerPage'])->name('register');
Route::post('/register', [UserController::class, 'doRegister'])->name('doRegister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
