<?php

use Illuminate\Support\Facades\Route;
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
Route::get('form-builder', [FormBuilderController::class, 'index']);
// Step 2
Route::view('formbuilder', 'FormBuilder.create');
// Step 3
Route::post('save-form-builder', [FormBuilderController::class, 'create']);
// Step 4
Route::delete('form-delete/{id}', [FormBuilderController::class, 'destroy']);

// Step 5
Route::view('edit-form-builder/{id}', 'FormBuilder.edit');
Route::get('get-form-builder-edit', [FormBuilderController::class, 'editData']);
Route::post('update-form-builder', [FormBuilderController::class, 'update']);

// Step 6
Route::view('read-form-builder/{id}', 'FormBuilder.read');
Route::get('get-form-builder', [FormsController::class, 'read']);
Route::post('save-form-transaction', [FormsController::class, 'create']);



Route::resource('project',      ProjectController::class);
Route::resource('project.board', BoardController::class);
Route::resource('project.board.task', FormBuilderController::class)->parameters([
    'project' => 'projectId',
    'board' => 'boardId',
]);


