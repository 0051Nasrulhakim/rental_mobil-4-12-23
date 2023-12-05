<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('actionregister', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');

Route::resource('products', ProductController::class);
Route::resource('home', DashboardController::class)->middleware('auth');
// Route::resource('admin', AdminController::class);
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/detail/{id_sewa}', [AdminController::class, 'detail'])->name('admin.detail');
Route::get('admin/riwayat_admin', [AdminController::class, 'riwayat_admin'])->name('admin.riwayat_admin');
Route::post('admin/selesaikanPenyewaan', [AdminController::class, 'selesaikanPenyewaan'])->name('admin.selesaikanPenyewaan');
// Route::get('admin/detail_riwayat', [AdminController::class, 'detail_riwayat'])->name('admin.detail_riwayat');
Route::get('/dashboard/sewa/{id}', [DashboardController::class, 'sewa'])->name('dashboard.sewa')->middleware('auth');
Route::post('dashboard/checkout', [DashboardController::class, 'checkout'])->name('dashboard.checkout')->middleware('auth');
Route::get('dashboard/riwayat', [DashboardController::class, 'riwayat'])->name('dashboard.riwayat')->middleware('auth');
// Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');
