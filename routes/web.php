<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\PermissionsController;

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

// Route::get('/', function () {
    Route::get('/',             [AuthController::class, 'index'])->name('login');
    Route::get('/login',        [AuthController::class, 'index'])->name('login');
    Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
    Route::post('logout',       [AuthController::class, 'logout'])->name('logout');
// });

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard',             [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('folders', [FolderController::class, 'index'])->name('folders.index');
    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    // Route::get('folders', [FolderController::class, 'index'])->middleware('auth');






    // Route::get('documents/create', [DocumentsController::class, 'create'])->name('documents.create');
    // Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::post('permissions/bulkDelete', [PermissionController::class, 'bulkDelete'])->name('permissions.bulkDelete');
    // Route::get('/documents', [DocumentsController::class, 'index'])->name('documents.index');
    // Route::get('/documents/{id}/edit', [DocumentsController::class, 'edit'])->name('documents.edit');
    // Route::delete('/documents/{id}', [DocumentsController::class, 'destroy'])->name('documents.destroy');
    // Route::post('/documents', [DocumentsController::class, 'store'])->name('documents.store');
    // Route::put('/documents/{id}', [DocumentsController::class, 'update'])->name('documents.update');




    // Route::get('dashboard',             [HomeController::class, 'index'])->name('dashboard.index');
});
// Step 1
// Route::get('form-builder', [FormBuilderController::class, 'index']);
// Step 2
// Route::view('formbuilder', 'FormBuilder.create');
// Route::view('task', 'task.create');

// Step 3
// Route::post('save-task', [TaskController::class, 'store']);


// // Step 4
// Route::delete('form-delete/{id}', [FormBuilderController::class, 'destroy']);

// // Step 5
// Route::view('edit-form-builder/{id}', 'FormBuilder.edit');
// Route::view('edit-form-builder/{projectId}/{boardId}/{taskId}', 'project.board.task.edit');
// Route::view('edit-form-builder/{projectId}/{boardId}/{taskId}', 'project.board.task.edit')->name('edit-form-builder');

// Route::get('get-form-builder-edit', [TaskController::class, 'editData']);
// Route::post('update-form-builder', [TaskController::class, 'update']);

// Step 6
// Route::view('read-form-builder/{id}', 'FormBuilder.read');
// Route::get('get-form-builder', [FormsController::class, 'read']);
// Route::post('save-form-transaction', [FormsController::class, 'create']);



// Route::resource('project',      ProjectController::class);
// Route::resource('project.board', BoardController::class);
// Route::resource('project.board.task', TaskController::class)->parameters([
//     'project' => 'projectId',
//     'board' => 'boardId',
//     'task' => 'taskId',
// ]);


Route::resource('folders', FolderController::class);
Route::resource('files', FilesController::class);
Route::resource('users', UserController::class);
Route::resource('permissions', PermissionsController::class);
// Route::resource('documents', DocumentsController::class);
// Route::resource('permission', PermissionController::class);

// Route::get('getActiveFolders', [FolderController::class, 'getActiveFolders'])
//     ->name('getActiveFolders');
