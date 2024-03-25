<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Guest-Home
Route::get('/', GuestHomeController::class)->name('guest.home');


// Admin-Home
Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {
    // Rotta per la home di amministrazione
    Route::get('', AdminHomeController::class)->name('home');
    // Rotta per spostare un progetto nel cestino
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    // Rotta per il restore di un progetto
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore')->withTrashed();
    // Rotta per eliminare un progetto definitivamente
    Route::delete('/projects/{project}/drop', [ProjectController::class, 'drop'])->name('projects.drop')->withTrashed();
    // Rotta per svuotare il cestino
    Route::delete('/admin/projects/deleteAll', [ProjectController::class, 'deleteAll'])->name('admin.projects.deleteAll');


    // Rotte per le operazioni CRUD
    Route::resource('projects', ProjectController::class);
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
