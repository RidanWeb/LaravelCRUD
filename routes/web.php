<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



Route::get('/x', function () {
    return view('welcome');
});


Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/create', [StudentController::class, 'create'])->name('student.create');//student folder create file
          //route                               //controller page create method
Route::post('/student', [StudentController::class, 'store'])->name('student.store');//route
Route::get('{student}/edit', [StudentController::class, 'edit'])->name('student.edit');//route
Route::put('{student}', [StudentController::class, 'update'])->name('student.update');//route
Route::delete('{student}', [StudentController::class, 'destroy'])->name('student.destroy');//route
