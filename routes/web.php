<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminPostController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\TagController;

/*
|--------------------------------------------------------------------------
| // Front-End Routes
|--------------------------------------------------------------------------
*/

route::get('/', [IndexController::class, 'index'])->name('index');
route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::post('post/{post:slug}', [PostController::class, 'addComment'])->name('post.add_comment');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('theme.default.archive.categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('theme.default.archive.categories.index');

Route::get('/tags/{tag:name}', [TagController::class, 'show'])->name('theme.default.archive.tags.show');


/*
|--------------------------------------------------------------------------
| // Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'auth.isAdmin', 'verified']);

Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
	Route::resource('/users', UserController::class);
});

Route::resource('admin.posts', AdminPostController::class);

Route::post('users/saveTheme', [UserController::class, 'saveTheme'])->middleware(['auth']);
/*
|--------------------------------------------------------------------------
| OLD
|--------------------------------------------------------------------------
*/

Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/admin/setting', function () {
    return view('admin.pages.setting');
});

Route::get('/admin/post/trash', function () {
    return view('admin.post.trash');
});

Route::get('/admin/post/add', function () {
    return view('admin.post.add');
});

Route::get('/admin/post/trash', function () {
    return view('admin.post.trash');
});

