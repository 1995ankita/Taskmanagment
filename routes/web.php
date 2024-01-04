<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomFieldController;
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


//Route::resource('categories.categoriesDetail',        CategoryController::class)->name('category.index');
// Route::resource('category',             [CategoryController::class, 'index'])->name('dashboard.index');
Route::resource('project',      ProjectController::class);

Route::get('/project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::delete('/project/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
Route::get('/customfield',        [CustomFieldController::class, 'index']);
//Route::get('/customfield',        [CustomFieldController::class, 'index']);

Route::resource('board', BoardController::class);
Route::get('/board/{board}/edit', [BoardController::class, 'edit'])->name('board.edit');
Route::delete('/board/{board}', [BoardController::class, 'destroy'])->name('board.destroy');


