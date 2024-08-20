<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login',[LoginController::class,'login'])->name('auth');
Route::post('logout', [LoginController::class,'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class,'register']);

// Password Reset Routes...
Route::get('password', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

// // Confirm Password (added in v6.2)
Route::get('password/confirm', [ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class,'confirm']);

// // Email Verification Routes...
Route::get('email/verify', [VerificationController::class,'show'])->name('verification.notice');
Route::get('email/verify/{id}', [VerificationController::class,'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class,'resend'])->name('verification.resend');

Route::get('/password/reset',[ProfileController::class,'ResetPassword'])->name('password.resetpassword');
Route::post('/password/firstreset',[ProfileController::class,'CustomPassword'])->name('password.firstreset');

Route::get('/password/change',[ProfileController::class,'ChangePassword'])->name('password.changepassword');
Route::post('/password/{user}/update',[ProfileController::class,'UpdatePassword'])->name('password.updatepassword');
Route::get('/profile',[ProfileController::class,'getProfile'])->name('profile');
Route::post('/profile/{user}',[ProfileController::class,'updateProfile'])->name('update.profile');


Route::resource('students',StudentsController::class)->middleware('role:admin,teacher');
Route::resource('teachers',TeacherController::class)->middleware('role:admin');
Route::resource('attendance',AttendanceController::class)->middleware('role:teacher');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
