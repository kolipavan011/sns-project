<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\Authenticate;

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

Route::get('/', [ViewController::class, 'home']);

Route::prefix('vidmin')->group(function () {

   // Auth Controller
   Route::get('login', [LoginController::class, 'create'])->name('vidmin.login');
   Route::post('login', [LoginController::class, 'store']);
   Route::get('logout', [LoginController::class, 'destroy'])->name('vidmin.logout');

   // Authenticated Routes
   Route::middleware(Authenticate::class)->group(function () {
      // Catch-all route...
      Route::get('/{view?}', [ViewController::class, 'index'])->where('view', '(.*)')->name('vidmin');
   });
});
