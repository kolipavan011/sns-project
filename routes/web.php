<?php

use App\Http\Controllers\Admin\CategoryController as VidminCategory;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\FolderController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController as VidminPost;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController as VidminTag;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\YtdownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes (thems routes)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('page-cache')->group(function () {
   Route::get('/', [HomeController::class, 'home'])->name('home');
   Route::get('/posts', [PostController::class, 'index']);
   Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.single');
   Route::get('/tags', [TagController::class, 'index']);
   Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tag.single');
   Route::get('/category', [CategoryController::class, 'index']);
   Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('cat.single');
   Route::get('/pages/{slug}', [PageController::class, 'index'])->name('pages');
   Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
   Route::get('/sitemap/{slug}', [SitemapController::class, 'show'])->name('sitemap.single');
});


/*
|--------------------------------------------------------------------------
| Admin routes under vidmin control panel
|--------------------------------------------------------------------------
*/

Route::prefix('vidmin')->group(function () {

   // Auth Controller
   Route::get('login', [LoginController::class, 'create'])->name('vidmin.login');
   Route::post('login', [LoginController::class, 'store']);
   Route::get('logout', [LoginController::class, 'destroy'])->name('vidmin.logout');

   // Authenticated Routes
   Route::middleware(Authenticate::class)->group(function () {

      //Api Routes
      Route::prefix('api')->group(function () {

         Route::get('dash', [DashController::class, 'index']);
         Route::post('user', [UserController::class, 'store']);

         // Post routes...
         Route::prefix('posts')->controller(VidminPost::class)->group(function () {
            Route::get('/', 'index');
            Route::get('create', 'create');
            Route::get('{id}', 'show');
            Route::get('{id}/show', 'showPost');
            Route::get('{id}/videos', 'videos');
            Route::post('{id}/videos-sync', 'videoSync');
            Route::post('{id}/videos-detach', 'videoDetach');
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
            Route::post('{id}/thumb', 'uploadThumbnail');
            Route::post('{id}', 'store');
            Route::delete('{id}', 'destroy');
         });

         //Tag routes
         Route::prefix('tags')->controller(VidminTag::class)->group(function () {
            Route::get('/', 'index');
            Route::get('create', 'create');
            Route::get('{id}', 'show');
            Route::post('{id}', 'store');
         });

         //Category routes
         Route::prefix('category')->controller(VidminCategory::class)->group(function () {
            Route::get('/', 'index');
            Route::get('create', 'create');
            Route::get('{id}', 'show');
            Route::post('{id}', 'store');
         });

         //Setting routes
         Route::prefix('setting')->controller(SettingController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('store', 'store');
         });

         // Ytdownloader route
         Route::post('/ytdownload', [YtdownloadController::class, 'index']);
      });

      // Catch-all route...
      Route::get('/{view?}', [ViewController::class, 'index'])->where('view', '(.*)')->name('vidmin');
   });
});
