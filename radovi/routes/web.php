<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NastavnikController;

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

Route::post('/login/custom', [
    'uses' => [LoginController::class,'login'],
    'as' => 'login.custom'
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [StudentController::class,'showTasks'])->name('home');
    Route::get('/admin', [UserController::class,'showUsers'])->name('admin');
    Route::get('/nastavnik', [NastavnikController::class,'index'])->name('nastavnik');
});


Route::get('/edit/{id}', [UserController::class,'edit'])->name('edit');
Route::post('/update', [UserController::class,'update'])->name('update');

Route::post('/nastavnik/task', [NastavnikController::class,'saveTask'])->name('nastavnik.task');
Route::get('/nastavnik/task/{id}/students', [NastavnikController::class,'showStudents'])->name('nastavnik.task.students');
Route::post('/nastavnik/task/{id}/student', [NastavnikController::class,'assignStudentTask'])->name('nastavnik.task.student');


Route::post('/student/task', [StudentController::class,'updateTasks'])->name('student.task');



Route::get('/home', [HomeController::class, 'index'])->name('home');
