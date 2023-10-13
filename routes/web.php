<?php

use App\Http\Controllers\Admin\FolderController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
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

      //Api Routes
      Route::prefix('api')->group(function () {

         // Post routes...
         Route::prefix('posts')->controller(PostController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('create', 'create');
            Route::get('{id}', 'show');
            Route::get('{id}/videos', 'videos');
            Route::post('{id}', 'store');
            Route::delete('{id}', 'destroy');
         });

         // Folder routes...
         Route::prefix('folder')->controller(FolderController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('create', 'create');
            Route::post('{id}', 'store');
            Route::post('{id}/paste', 'paste');
            Route::delete('{id}', 'destroy');
         });

         // Media Route
         Route::prefix('media')->controller(MediaController::class)->group(function () {
            Route::post('{id}/upload', 'upload');
            Route::post('{id}', 'store');
            Route::delete('{id}', 'destroy');
         });
         //Users routes
      });

      // Catch-all route...
      Route::get('/{view?}', [ViewController::class, 'index'])->where('view', '(.*)')->name('vidmin');
   });
});
