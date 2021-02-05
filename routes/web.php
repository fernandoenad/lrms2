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



Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support');

Route::middleware(['active', 'log'])->group(function () { 
    Route::get('/content/download/{id}/', [App\Http\Controllers\My\ContentController::class, 'download'])->name('content.download');
    
    Route::get('/content/show/{content}', [App\Http\Controllers\My\ContentController::class, 'show'])->name('content.show');
    Route::get('/content/show/{content}/report', [App\Http\Controllers\My\ContentController::class, 'show'])->name('content.show.report');
    Route::get('/content/show/{content}/report-delete/{contentreport}', [App\Http\Controllers\My\ContentController::class, 'deletereport'])->name('content.show.report-delete');
    Route::post('/content/show/{content}/report-store', [App\Http\Controllers\My\ContentController::class, 'storereport'])->name('content.show.report-store');

    Route::get('/content/{category}/{course}', [App\Http\Controllers\My\ContentController::class, 'showCourse'])->name('content.course.show');
    Route::get('/content/{category}', [App\Http\Controllers\My\ContentController::class, 'showCategory'])->name('content.category.show');
    Route::get('/content', [App\Http\Controllers\My\ContentController::class, 'index'])->name('content');

    Route::any('/inventory/search', [App\Http\Controllers\My\InventoryController::class, 'search'])->name('inventory.search');
    Route::get('/inventory/create', [App\Http\Controllers\My\InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory/store', [App\Http\Controllers\My\InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/{inventory}/edit', [App\Http\Controllers\My\InventoryController::class, 'edit'])->name('inventory.edit');
    Route::patch('/inventory/{inventory}', [App\Http\Controllers\My\InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{inventory}', [App\Http\Controllers\My\InventoryController::class, 'delete'])->name('inventory.delete');
    Route::get('/inventory', [App\Http\Controllers\My\InventoryController::class, 'index'])->name('inventory');

    Route::post('/my/password-change', [App\Http\Controllers\My\MyController::class, 'updatePassword'])->name('my.password-change');
    Route::get('/my', [App\Http\Controllers\My\MyController::class, 'profile'])->name('my'); 

    Route::get('/', [App\Http\Controllers\My\MyController::class, 'index'])->name('home');


    Route::middleware(['manager'])->group(function () {
        Route::get('/admin/users/inactive', [App\Http\Controllers\Admin\UserController::class, 'showInactive'])->name('admin.users.inactive');
        Route::any('/admin/users/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.users.search');
        Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/disable', [App\Http\Controllers\Admin\UserController::class, 'disable'])->name('admin.users.disable');
        Route::patch('/admin/users/{user}/disable', [App\Http\Controllers\Admin\UserController::class, 'disabled'])->name('admin.users.disabled');
        Route::get('/admin/users/{user}/reset', [App\Http\Controllers\Admin\UserController::class, 'reset'])->name('admin.users.reset');
        Route::patch('/admin/users/{user}/reset', [App\Http\Controllers\Admin\UserController::class, 'resetted'])->name('admin.users.resetted');
        Route::get('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::get('/admin/users/{user}/logs', [App\Http\Controllers\Admin\UserController::class, 'logs'])->name('admin.users.logs');
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');

        Route::get('/admin/contents/create', [App\Http\Controllers\Admin\ContentController::class, 'create'])->name('admin.contents.create');
        Route::any('/admin/contents/search', [App\Http\Controllers\Admin\ContentController::class, 'search'])->name('admin.contents.search');
        Route::get('/admin/contents/new', [App\Http\Controllers\Admin\ContentController::class, 'displaycontents'])->name('admin.contents.new');
        Route::get('/admin/contents/pending', [App\Http\Controllers\Admin\ContentController::class, 'displaycontents'])->name('admin.contents.pending');
        Route::get('/admin/contents/approved', [App\Http\Controllers\Admin\ContentController::class, 'displaycontents'])->name('admin.contents.approved');
        Route::get('/admin/contents/hidden', [App\Http\Controllers\Admin\ContentController::class, 'displaycontents'])->name('admin.contents.hidden');
        Route::get('/admin/contents', [App\Http\Controllers\Admin\ContentController::class, 'index'])->name('admin.contents');
        Route::post('/admin/contents', [App\Http\Controllers\Admin\ContentController::class, 'store'])->name('admin.contents.store');
        Route::get('/admin/contents/{content}', [App\Http\Controllers\Admin\ContentController::class, 'show'])->name('admin.contents.display');
        Route::get('/admin/contents/{content}/hide', [App\Http\Controllers\Admin\ContentController::class, 'visibility'])->name('admin.contents.hide');
        Route::get('/admin/contents/{content}/show', [App\Http\Controllers\Admin\ContentController::class, 'visibility'])->name('admin.contents.show');
        Route::delete('/admin/contents/{content}', [App\Http\Controllers\Admin\ContentController::class, 'delete'])->name('admin.contents.delete');
        Route::get('/admin/contents/{content}/edit', [App\Http\Controllers\Admin\ContentController::class, 'edit'])->name('admin.contents.edit');
        Route::patch('/admin/contents/{content}', [App\Http\Controllers\Admin\ContentController::class, 'update'])->name('admin.contents.update');
        Route::get('/admin/contents/{content}/move-up', [App\Http\Controllers\Admin\ContentController::class, 'moveup'])->name('admin.contents.move-up');
        Route::get('/admin/contents/{content}/move-down', [App\Http\Controllers\Admin\ContentController::class, 'movedown'])->name('admin.contents.move-down');

        Route::get('/admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::any('/admin/categories/search', [App\Http\Controllers\Admin\CategoryController::class, 'search'])->name('admin.categories.search');
        Route::get('/admin/categories/shown', [App\Http\Controllers\Admin\CategoryController::class, 'displaycategories'])->name('admin.categories.shown');
        Route::get('/admin/categories/hidden', [App\Http\Controllers\Admin\CategoryController::class, 'displaycategories'])->name('admin.categories.hidden');
        Route::post('/admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/admin/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::get('/admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
        Route::patch('/admin/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/admin/categories/{category}/move-up', [App\Http\Controllers\Admin\CategoryController::class, 'moveup'])->name('admin.categories.move-up');
        Route::get('/admin/categories/{category}/move-down', [App\Http\Controllers\Admin\CategoryController::class, 'movedown'])->name('admin.categories.move-down');

        Route::get('/admin/courses/allshown', [App\Http\Controllers\Admin\CourseController::class, 'all'])->name('admin.courses.allshown');
        Route::get('/admin/courses/allhidden', [App\Http\Controllers\Admin\CourseController::class, 'all'])->name('admin.courses.allhidden');
        Route::any('/admin/courses/allsearch', [App\Http\Controllers\Admin\CourseController::class, 'allsearch'])->name('admin.courses.allsearch');

        Route::any('/admin/course/{course}', [App\Http\Controllers\Admin\CourseController::class, 'show'])->name('admin.courses.show');

        Route::get('/admin/courses/{category}/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('admin.courses.create');
        Route::any('/admin/courses/{category}/search', [App\Http\Controllers\Admin\CourseController::class, 'search'])->name('admin.courses.search');
        Route::get('/admin/courses/{category}/shown', [App\Http\Controllers\Admin\CourseController::class, 'displaycourses'])->name('admin.courses.shown');
        Route::get('/admin/courses/{category}/hidden', [App\Http\Controllers\Admin\CourseController::class, 'displaycourses'])->name('admin.courses.hidden');
        Route::post('/admin/courses/{category}/', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/admin/courses/{category}/{course}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::get('/admin/courses/{category}', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses');
        Route::patch('/admin/courses/{category}/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
        Route::get('/admin/courses/{category}/{course}/move-up', [App\Http\Controllers\Admin\CourseController::class, 'moveup'])->name('admin.courses.move-up');
        Route::get('/admin/courses/{category}/{course}/move-down', [App\Http\Controllers\Admin\CourseController::class, 'movedown'])->name('admin.courses.move-down');
    });

    Route::middleware(['personnel'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');

        Route::any('/admin/mycontents/search', [App\Http\Controllers\Admin\MyContentsController::class, 'search'])->name('admin.mycontents.search');
        Route::get('/admin/mycontents/create', [App\Http\Controllers\Admin\MyContentsController::class, 'create'])->name('admin.mycontents.create');
        Route::post('/admin/mycontents', [App\Http\Controllers\Admin\MyContentsController::class, 'store'])->name('admin.mycontents.store');
        Route::get('/admin/mycontents/course/{course}', [App\Http\Controllers\Admin\MyContentsController::class, 'showcourse'])->name('admin.mycontents.course');
        Route::get('/admin/mycontents/course/{course}/{content}/edit', [App\Http\Controllers\Admin\MyContentsController::class, 'edit'])->name('admin.mycontents.edit');       
        Route::patch('/admin/mycontents/course/{course}/{content}', [App\Http\Controllers\Admin\MyContentsController::class, 'update'])->name('admin.mycontents.update');       
        Route::get('/admin/mycontents/course/{course}/{content}/hide', [App\Http\Controllers\Admin\MyContentsController::class, 'visibility'])->name('admin.mycontents.course.hide');
        Route::get('/admin/mycontents/course/{course}/{content}/show', [App\Http\Controllers\Admin\MyContentsController::class, 'visibility'])->name('admin.mycontents.course.show');
        Route::get('/admin/mycontents/course/{course}/{content}/move-up', [App\Http\Controllers\Admin\MyContentsController::class, 'sort'])->name('admin.mycontents.course.move-up');
        Route::get('/admin/mycontents/course/{course}/{content}/move-down', [App\Http\Controllers\Admin\MyContentsController::class, 'sort'])->name('admin.mycontents.course.move-down');
        Route::get('/admin/mycontents/course/{course}/{content}/display', [App\Http\Controllers\Admin\MyContentsController::class, 'show'])->name('admin.mycontents.course.display');
        Route::get('/admin/mycontents', [App\Http\Controllers\Admin\MyContentsController::class, 'index'])->name('admin.mycontents');
        Route::get('/admin/mycontents/shown', [App\Http\Controllers\Admin\MyContentsController::class, 'display'])->name('admin.mycontents.shown');
        Route::get('/admin/mycontents/hidden', [App\Http\Controllers\Admin\MyContentsController::class, 'display'])->name('admin.mycontents.hidden');
        Route::get('/admin/mycontents/submissions', [App\Http\Controllers\Admin\MyContentsController::class, 'display'])->name('admin.mycontents.submissions');

        Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports');
        Route::get('/admin/reports/{contentreport}', [App\Http\Controllers\Admin\ReportController::class, 'show'])->name('admin.reports.show');
        Route::patch('/admin/reports/{contentreport}', [App\Http\Controllers\Admin\ReportController::class, 'update'])->name('admin.reports.update');

    });
});


