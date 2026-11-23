<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CastController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryNewsController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Admin.layouts.Dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('/Admin/categories', CategoryController::class)->names('categories');
//Route::resource('/Admin/test', TestController::class)->names('categories');
Route::resource('/Admin/category_news', CategoryNewsController::class)->names('category_news');
Route::resource('/Admin/settings', SettingsController::class)->names('settings');
Route::resource('/Admin/admins', AdminController::class)->names('admins');
Route::resource('/Admin/casts', CastController::class)->names('casts');
Route::resource('/Admin/tags', TagController::class)->names('tags');
Route::resource('/Admin/movies', MovieController::class)->names('movies');
Route::resource('/Admin/news', NewsController::class)->names('news');
Route::resource('/Admin/collection', CollectionController::class)->names('collection');
require __DIR__.'/auth.php';
