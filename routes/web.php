<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseProgressController;
use App\Http\Controllers\StaffProvincesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;







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
Route::middleware(['IsGuest'])->group(function(){
    Route::get('/', [LandingController::class, 'index'])->name('landing');
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/loginAuth', [UserController::class, 'loginAuth'])->name('login.auth');
    // Buat Akun Guest
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register-store', [UserController::class, 'register'])->name('register.store');
});

Route::middleware(['IsLogin'])->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    // Comment
    Route::middleware(['IsUser'])->group(function(){
        Route::prefix('/report')->name('report.')->group(function() {
            Route::get('/data', [ReportController::class, 'index'])->name('data');
            Route::get('/create', [ReportController::class, 'create'])->name('create');
            Route::post('/store', [ReportController::class, 'store'])->name('store');
            // Comments
            Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment');
            Route::get('/pengaduan/{id}', [ReportController::class, 'show'])->name('show');
            Route::delete('/pengaduan/{id}', [ReportController::class, 'destroy'])->name('delete');
            // Like & Monitor
            Route::post('/{id}/like', [ReportController::class, 'like'])->name('like');
            Route::post('/{id}', [ReportController::class, 'show'])->name('view');
            Route::get('/monitor', [ReportController::class, 'monitor'])->name('monitor');
        });
    });
        // Response
    Route::middleware(['IsStaff'])->group(function(){
        Route::prefix('/response')->name('response.')->group(function() {
            Route::get('/data', [ResponseController::class, 'index'])->name('data');
            Route::post('/store/{id}', [ResponseController::class, 'store'])->name('store.response');
            Route::get('/show/{id}', [ResponseController::class, 'show'])->name('show');
            Route::post('/show/{id}', [ResponseProgressController::class, 'done'])->name('store.done');
            Route::post('/progress', [ResponseProgressController::class, 'store'])->name('store');
            Route::delete('/delete/{id}', [ResponseProgressController::class, 'destroy'])->name('delete');
        });
    });
    Route::middleware(['IsHeadStaff'])->group(function(){
        Route::prefix('/user')->name('user.')->group(function() {
            Route::get('/table', [UserController::class, 'index'])->name('table');
            Route::get('/create', [UserController::class, 'create'])->name('form');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('form.edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('form.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
            Route::get('/chart', [UserController::class, 'chart'])->name('chart');
        });
    });
});
