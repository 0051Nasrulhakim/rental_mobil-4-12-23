<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;

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

// Home (default route for authenticated users)
// Route::get('/', [HomeController::class, 'index'])->middleware('auth');
// Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('/logout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::group(['prefix' => 'dashboard', 'middleware' =>['AuthenticateOnceWithBasicAuth'], 'as' => 'dashboard.'] , function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/sewa/{id_mobil}', [HomeController::class, 'index'])->name('sewa');
    });

// Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'actionregister'])->name('actionregister');

// Products
Route::resource('/products', ProductController::class);
