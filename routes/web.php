<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

// index
Route::get('/', function () {
    return view('index');
})->name('index');


// empleados
Route::get('/employee',function(){
    $employees = Employee::orderBy('id', 'desc')->paginate(5); // Obtén todos los empleados ordenados por ID en orden descendente.
    return view('employeesindex',compact('employees')); 
})->name('employeesindex');


Route::resource('/employees', EmployeeController::class)->names('admin.employees')->middleware('auth');









/* -------------------------- */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
