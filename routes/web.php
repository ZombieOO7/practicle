<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;

/* Login and signup  routes*/
Route::get('/',[UserLoginController::class, 'loginForm']);
Route::get('/login',[UserLoginController::class, 'loginForm'])->name('login');
Route::get('/signup',[UserLoginController::class, 'registerForm'])->name('signup');
Route::post('/login',[UserLoginController::class, 'login'])->name('login.post');
Route::post('/signup',[UserLoginController::class, 'register'])->name('register');
Route::get('/logout',[UserLoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'user','middleware' => ['auth']],function () {
    Route::get('/', [UserController::class , 'index'])->name('user.index');
    Route::post('store', [UserController::class , 'store'])->name('user.store');
    Route::get('edit/{uuid?}', [UserController::class , 'edit'])->name('user.edit');
    Route::post('update', [UserController::class , 'update'])->name('user.update');
    Route::get('active-inactive/{uuid?}', [UserController::class , 'updateStatus'])->name('user.active-inactive');
    Route::delete('delete/{uuid?}', [UserController::class , 'destroy'])->name('user.delete');
    Route::get('/datatable', [UserController::class , 'datatable'])->name('user.datatable');
    Route::post('/validate-email', [UserController::class , 'validateEmail'])->name('validate.email');
    Route::post('/validate-phone', [UserController::class , 'validatePhone'])->name('validate.phone');
});