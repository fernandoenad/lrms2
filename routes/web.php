<?php

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

Auth::routes();

Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support');

Route::middleware(['active'])->group(function () {
    Route::post('/my/password-change', [App\Http\Controllers\My\MyController::class, 'updatePassword'])->name('my.password-change');
    Route::get('/my', [App\Http\Controllers\My\MyController::class, 'index'])->name('my');  

    Route::middleware(['manager'])->group(function () {
        Route::get('/admin/users/inactive', [App\Http\Controllers\Admin\UserController::class, 'showInactive'])->name('admin.users.inactive');
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
        Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    });

    Route::get('/download/{content}/', [App\Http\Controllers\Home\HomeController::class, 'download'])->name('home.content.download');

    Route::get('/{category}/{course}', [App\Http\Controllers\Home\HomeController::class, 'showCourse'])->name('home.course.show');
    Route::get('/{category}', [App\Http\Controllers\Home\HomeController::class, 'showCategory'])->name('home.category.show');

    Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
});


