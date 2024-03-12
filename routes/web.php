<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('user.login-page');
});


Route::get('/login-page', [ProfileController::class, 'loginPage'])->name('login-page');
Route::get('/register-page', [ProfileController::class, 'registerPage'])->name('register-page');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [UserController::class, 'homePage'])->name('home');
    Route::get('/profil', [ProfileController::class, 'profilePage'])->name('profil');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});



require __DIR__.'/auth.php';
