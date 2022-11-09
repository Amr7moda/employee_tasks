<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/')->middleware('auth');

// create route to show the create project form
Route::get('/project', [App\Http\Controllers\ProjectController::class, 'create_project'])->name('create_project')->middleware('auth');
Route::get('/store', [App\Http\Controllers\ProjectController::class, 'add_project'])->name('add_project')->middleware('auth');
Route::get('/show', [App\Http\Controllers\ProjectController::class, 'show_projects'])->name('show_projects')->middleware('auth');
Route::get('/delete_project/{id}', [App\Http\Controllers\ProjectController::class, 'delete_project'])->name('delete_project')->middleware('auth');
Route::get('/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update')->middleware('auth');
Route::get('/updated_data/{id}', [App\Http\Controllers\ProjectController::class, 'updated_data'])->name('updated_data')->middleware('auth');


// create route to show the create project form
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'create_task'])->name('create_task')->middleware('auth');
Route::get('/create', [App\Http\Controllers\TaskController::class, 'add_task'])->name('add_task')->middleware('auth');
Route::get('/showtask', [App\Http\Controllers\TaskController::class, 'show_task'])->name('show_task')->middleware('auth');
Route::get('/submit_task', [App\Http\Controllers\TaskController::class, 'submit_task'])->name('submit_task')->middleware('auth');
Route::get('/delete_task/{id}', [App\Http\Controllers\TaskController::class, 'delete_task'])->name('delete_task')->middleware('auth');



require __DIR__ . '/auth.php';
