<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendDestroyController;
use App\Http\Controllers\FriendIndexController;
use App\Http\Controllers\FriendPatchContoller;
use App\Http\Controllers\FriendsStoreControlller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileIndexController;
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
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/friends', FriendIndexController::class)->name('friends');
Route::post('/friends/{user}', FriendsStoreControlller::class)->name('friends.store');
Route::delete('/friends/{user}', FriendDestroyController::class)->name('friends.destroy');
Route::patch('/friends/{user}', FriendPatchContoller::class)->name('friends.patch');
Route::get('/profile/{user}', ProfileIndexController::class)->name('profile');

require __DIR__.'/auth.php';
