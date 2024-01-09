<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FormBuilderController;

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


// Step 1
// Route::get('form-builder', [FormBuilderController::class, 'index']);
// Step 2
// Route::view('formbuilder', 'FormBuilder.create');
Route::view('task', 'task.create');

// Step 3
// Route::post('save-task', [TaskController::class, 'store']);


// // Step 4
// Route::delete('form-delete/{id}', [FormBuilderController::class, 'destroy']);

// // Step 5
// Route::view('edit-form-builder/{id}', 'FormBuilder.edit');
// Route::view('edit-form-builder/{projectId}/{boardId}/{taskId}', 'project.board.task.edit');
Route::view('edit-form-builder/{projectId}/{boardId}/{taskId}', 'project.board.task.edit')->name('edit-form-builder');

Route::get('get-form-builder-edit', [TaskController::class, 'editData']);
Route::post('update-form-builder', [TaskController::class, 'update']);

// Step 6
Route::view('read-form-builder/{id}', 'FormBuilder.read');
Route::get('get-form-builder', [FormsController::class, 'read']);
Route::post('save-form-transaction', [FormsController::class, 'create']);



Route::resource('project',      ProjectController::class);
Route::resource('project.board', BoardController::class);
Route::resource('project.board.task', TaskController::class)->parameters([
    'project' => 'projectId',
    'board' => 'boardId',
    'task' => 'taskId',
]);


