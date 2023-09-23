<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

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

Route::prefix('vidmin/')->group(function () {

   // Auth Controller
   Route::prefix('auth')->group(function () {
      Route::post('login', [LoginController::class, 'store']);
      Route::get('user', [LoginController::class, 'index']);
      Route::post('logout', [LoginController::class, 'destroy']);
   });

   Route::namespace('Api')->prefix('api')->group(function () {
   });

   // Catch-all route...
   Route::get('/{view?}', [ViewController::class, 'index'])->where('view', '(.*)')->name('vidmin');
});
