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

Route::get('/', [App\Http\Controllers\ProjectController::class, 'create_project'])->name('create_project')->middleware('auth');

// create route to show the create project form
Route::get('/project', [App\Http\Controllers\ProjectController::class, 'create_project'])->name('create_project')->middleware('auth');
Route::get('/store', [App\Http\Controllers\ProjectController::class, 'add_project'])->name('add_project')->middleware('auth');
Route::get('/show', [App\Http\Controllers\ProjectController::class, 'show_projects'])->name('show_projects')->middleware('auth');
Route::get('/delete_project/{id}', [App\Http\Controllers\ProjectController::class, 'delete_project'])->name('delete_project')->middleware('auth');
Route::get('/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update')->middleware('auth');
Route::get('/updated_data/{id}', [App\Http\Controllers\ProjectController::class, 'updated_data'])->name('updated_data')->middleware('auth');

//create route to add new user
Route::get('/create_user', [App\Http\Controllers\UserController::class, 'create_user'])->name('create_user')->middleware('auth');
Route::post('/add_user', [App\Http\Controllers\UserController::class, 'add_user'])->name('add_user')->middleware('auth');
Route::get('/show_users', [App\Http\Controllers\UserController::class, 'show_users'])->name('show_users');
Route::get('/delete_user/{id}', [App\Http\Controllers\UserController::class, 'delete_user'])->name('delete_user');
Route::post('/update_user', [App\Http\Controllers\UserController::class, 'update_user'])->name('update_user');
Route::post('/new_update_user', [App\Http\Controllers\UserController::class, 'new_update_user'])->name('new_update_user');



// create route to show the create task form
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'create_task'])->name('create_task')->middleware('auth');
Route::get('/create', [App\Http\Controllers\TaskController::class, 'add_task'])->name('add_task')->middleware('auth');
Route::get('/showtask', [App\Http\Controllers\TaskController::class, 'show_task'])->name('show_task')->middleware('auth');
Route::get('/all_tasks', [App\Http\Controllers\TaskController::class, 'all_tasks'])->name('all_tasks')->middleware('auth');

Route::get('/submit_task/{id}', [App\Http\Controllers\TaskController::class, 'submit_task'])->name('submit_task')->middleware('auth');
Route::get('/delete_task/{id}', [App\Http\Controllers\TaskController::class, 'delete_task'])->name('delete_task');
Route::post('/update_task', [App\Http\Controllers\TaskController::class, 'update_task'])->name('update_task');
Route::post('/new_update_task', [App\Http\Controllers\TaskController::class, 'new_update_task'])->name('new_update_task');



require __DIR__ . '/auth.php';
