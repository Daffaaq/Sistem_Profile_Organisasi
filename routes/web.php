<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardSuperadminController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\CategoryGaleryController;
use App\Http\Controllers\CategoryAspirationController;
use App\Http\Controllers\CategoryFileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SOController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\AspirationController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.role:superadmin'])->prefix('superadmin')->group(function () {

    Route::get('/', [DashboardSuperadminController::class, 'index'])->name('superadmin.dashboard');

    Route::prefix('/')->group(function () {
        Route::get('/Galery', [GaleryController::class, 'index']);
        Route::get('/Galery/create', [GaleryController::class, 'create']);
        Route::post('/Galery/store', [GaleryController::class, 'store']);
        Route::get('/Galery/edit/{id}', [GaleryController::class, 'edit']);
        Route::put('/Galery/update/{id}', [GaleryController::class, 'update']);
        Route::delete('/Galery/destroy/{id}', [GaleryController::class, 'destroy']);
        Route::get('/Galery/data', [GaleryController::class, 'json']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/SO', [SOController::class, 'index']);
        Route::get('/SO/create', [SOController::class, 'create']);
        Route::post('/SO/store', [SOController::class, 'store']);
        Route::get('/SO/edit/{id}', [SOController::class, 'edit']);
        Route::put('/SO/update/{id}', [SOController::class, 'update']);
        Route::delete('/SO/destroy/{id}', [SOController::class, 'destroy']);
        Route::get('/SO/data', [SOController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/Profile', [ProfileController::class, 'index']);
        Route::get('/Profile/create', [ProfileController::class, 'create']);
        Route::post('/Profile/store', [ProfileController::class, 'store']);
        Route::get('/Profile/edit/{id}', [ProfileController::class, 'edit']);
        Route::put('/Profile/update/{id}', [ProfileController::class, 'update']);
        Route::delete('/Profile/destroy/{id}', [ProfileController::class, 'destroy']);
        Route::get('/Profile/data', [ProfileController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/categoryArticle', [CategoryArticleController::class, 'index']);
        Route::get('/categoryArticle/create', [CategoryArticleController::class, 'create']);
        Route::post('/categoryArticle/store', [CategoryArticleController::class, 'store']);
        Route::get('/categoryArticle/edit/{id}', [CategoryArticleController::class, 'edit']);
        Route::put('/categoryArticle/update/{id}', [CategoryArticleController::class, 'update']);
        Route::delete('/categoryArticle/destroy/{id}', [CategoryArticleController::class, 'destroy']);
        Route::get('/categoryArticle/data', [CategoryArticleController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/categoryGalery', [CategoryGaleryController::class, 'index']);
        Route::get('/categoryGalery/create', [CategoryGaleryController::class, 'create']);
        Route::post('/categoryGalery/store', [CategoryGaleryController::class, 'store']);
        Route::get('/categoryGalery/edit/{id}', [CategoryGaleryController::class, 'edit']);
        Route::put('/categoryGalery/update/{id}', [CategoryGaleryController::class, 'update']);
        Route::delete('/categoryGalery/destroy/{id}', [CategoryGaleryController::class, 'destroy']);
        Route::get('/categoryGalery/data', [CategoryGaleryController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/categoryAspiration', [CategoryAspirationController::class, 'index']);
        Route::get('/categoryAspiration/create', [CategoryAspirationController::class, 'create']);
        Route::post('/categoryAspiration/store', [CategoryAspirationController::class, 'store']);
        Route::get('/categoryAspiration/edit/{id}', [CategoryAspirationController::class, 'edit']);
        Route::put('/categoryAspiration/update/{id}', [CategoryAspirationController::class, 'update']);
        Route::delete('/categoryAspiration/destroy/{id}', [CategoryAspirationController::class, 'destroy']);
        Route::get('/categoryAspiration/data', [CategoryAspirationController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/categoryFile', [CategoryFileController::class, 'index']);
        Route::get('/categoryFile/create', [CategoryFileController::class, 'create']);
        Route::post('/categoryFile/store', [CategoryFileController::class, 'store']);
        Route::get('/categoryFile/edit/{id}', [CategoryFileController::class, 'edit']);
        Route::put('/categoryFile/update/{id}', [CategoryFileController::class, 'update']);
        Route::delete('/categoryFile/destroy/{id}', [CategoryFileController::class, 'destroy']);
        Route::get('/categoryFile/data', [CategoryFileController::class, 'json']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/File', [FileController::class, 'index']);
        Route::get('/File/create', [FileController::class, 'create']);
        Route::post('/File/store', [FileController::class, 'store']);
        Route::get('/File/edit/{id}', [FileController::class, 'edit']);
        Route::put('/File/update/{id}', [FileController::class, 'update']);
        Route::delete('/File/destroy/{id}', [FileController::class, 'destroy']);
        Route::get('/File/data', [FileController::class, 'json']);
        Route::get('/File/data/upload/{id}', [FileController::class, 'serveFile']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/Article', [ArticleController::class, 'index']);
        Route::get('/Article/create', [ArticleController::class, 'create']);
        Route::post('/Article/store', [ArticleController::class, 'store']);
        Route::get('/Article/edit/{id}', [ArticleController::class, 'edit']);
        Route::put('/Article/update/{id}', [ArticleController::class, 'update']);
        Route::delete('/Article/destroy/{id}', [ArticleController::class, 'destroy']);
        Route::get('/Article/data', [ArticleController::class, 'json']);
        Route::get('/Article/data/upload/{id}', [ArticleController::class, 'serveFile']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/Users', [UserController::class, 'index']);
        Route::get('/Users/create', [UserController::class, 'create']);
        Route::post('/Users/store', [UserController::class, 'store']);
        Route::get('/Users/edit/{id}', [UserController::class, 'edit']);
        Route::put('/Users/update/{id}', [UserController::class, 'update']);
        Route::delete('/Users/destroy/{id}', [UserController::class, 'destroy']);
        Route::get('/Users/data', [UserController::class, 'json']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/Aspiration', [AspirationController::class, 'index']);
        Route::get('/Aspiration/create', [AspirationController::class, 'create']);
        Route::post('/Aspiration/store', [AspirationController::class, 'store']);
        Route::get('/Aspiration/edit/{id}', [AspirationController::class, 'edit']);
        Route::put('/Aspiration/update/{id}', [AspirationController::class, 'update']);
        Route::delete('/Aspiration/destroy/{id}', [AspirationController::class, 'destroy']);
        Route::get('/Aspiration/data', [AspirationController::class, 'json']);
        Route::put('/Aspiration/updateStatus/{id}', [AspirationController::class, 'updateStatus']);
        Route::get('/Aspiration/print_pdf', [AspirationController::class, 'pdfPrint']);
    });
});



Route::middleware(['auth', 'check.role:admin'])->prefix('admin')->group(function () {
    // Route::get('/', [DashboardKasubagController::class, 'ViewKasubag'])->name('kasubag.dashboard');
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('/')->group(function () {
        Route::get('/Aspiration', [AspirationController::class, 'index']);
        Route::get('/Aspiration/create', [AspirationController::class, 'create']);
        Route::post('/Aspiration/store', [AspirationController::class, 'store']);
        Route::get('/Aspiration/edit/{id}', [AspirationController::class, 'edit']);
        Route::put('/Aspiration/update/{id}', [AspirationController::class, 'update']);
        Route::delete('/Aspiration/destroy/{id}', [AspirationController::class, 'destroy']);
        Route::get('/Aspiration/data', [AspirationController::class, 'jsonAdmin']);
        Route::put('/Aspiration/updateStatus/{id}', [AspirationController::class, 'updateStatus']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/File', [FileController::class, 'index']);
        Route::get('/File/create', [FileController::class, 'create']);
        Route::post('/File/store', [FileController::class, 'store']);
        Route::get('/File/edit/{id}', [FileController::class, 'edit']);
        Route::put('/File/update/{id}', [FileController::class, 'update']);
        Route::delete('/File/destroy/{id}', [FileController::class, 'destroy']);
        Route::get('/File/data', [FileController::class, 'jsonAdmin']);
        Route::get('/File/data/upload/{id}', [FileController::class, 'serveFile']);
    });

    Route::prefix('/')->group(function () {
        Route::get('/categoryAspiration', [CategoryAspirationController::class, 'index']);
        Route::get('/categoryAspiration/create', [CategoryAspirationController::class, 'create']);
        Route::post('/categoryAspiration/store', [CategoryAspirationController::class, 'store']);
        Route::get('/categoryAspiration/edit/{id}', [CategoryAspirationController::class, 'edit']);
        Route::put('/categoryAspiration/update/{id}', [CategoryAspirationController::class, 'update']);
        Route::delete('/categoryAspiration/destroy/{id}', [CategoryAspirationController::class, 'destroy']);
        Route::get('/categoryAspiration/data', [CategoryAspirationController::class, 'jsonAdmin']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/categoryFile', [CategoryFileController::class, 'index']);
        Route::get('/categoryFile/create', [CategoryFileController::class, 'create']);
        Route::post('/categoryFile/store', [CategoryFileController::class, 'store']);
        Route::get('/categoryFile/edit/{id}', [CategoryFileController::class, 'edit']);
        Route::put('/categoryFile/update/{id}', [CategoryFileController::class, 'update']);
        Route::delete('/categoryFile/destroy/{id}', [CategoryFileController::class, 'destroy']);
        Route::get('/categoryFile/data', [CategoryFileController::class, 'jsonAdmin']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/File', [FileController::class, 'index']);
        Route::get('/File/create', [FileController::class, 'create']);
        Route::post('/File/store', [FileController::class, 'store']);
        Route::get('/File/edit/{id}', [FileController::class, 'edit']);
        Route::put('/File/update/{id}', [FileController::class, 'update']);
        Route::delete('/File/destroy/{id}', [FileController::class, 'destroy']);
        Route::get('/File/data', [FileController::class, 'jsonAdmin']);
    });
});
