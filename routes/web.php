<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LibraryController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('library/index', [LibraryController::class, 'index']);
    Route::get('library/borrow/{id}', [LibraryController::class, 'borrowingForm']);
    Route::post('library/borrow', [LibraryController::class, 'borrow']);
    Route::post('library/return', [LibraryController::class, 'returnBook']);
    Route::get('library/history', [LibraryController::class, 'history']);

});


require __DIR__.'/auth.php';
