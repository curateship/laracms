<?php

use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminCommentController;

// Front-End Controllers
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

// Index/Dashboard
route::get('/', [IndexController::class, 'index'])->name('index');
route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

// Post
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');

// Contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('theme.default.archive.categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('theme.default.archive.categories.index');

// Tags
Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');
Route::get('/tags/{tags_categories_name}/{tag_name}', [TagController::class, 'show'])->name('theme.default.archive.tags.show');

// Comments
Route::get('post/comment/get/{post_id}/{last_comment_id}', [PostController::class, 'getPostComments'])->name('post-comment-get');
Route::get('post/comment/reply', [PostController::class, 'reply'])->name('post-comment-reply')->middleware(['auth', 'verified']);
Route::post('post/comment/reply-save', [PostController::class, 'saveReply'])->name('post-comment-reply-save')->middleware(['auth', 'verified']);
Route::post('post/comment/save', [PostController::class, 'saveComment'])->name('post-comment-save')->middleware(['auth', 'verified']);
Route::get('post/comment/reply-get-list', [PostController::class, 'getReply'])->name('post-comment-reply-list');

// Profiles;
Route::get('/user/edit', [UserController::class, 'editProfile'])->middleware(['auth'])->name('profile.edit');
Route::get('/user/{user_id}', [UserController::class, 'showProfile']);
Route::post('/user/edit/{user_id}', [UserController::class, 'profileUpdate'])->middleware(['auth'])->name('profile.update');

// Search;
Route::get('/search/{search_request}', [PostController::class, 'postSearch'])->name('posts.search');

// Temp
Route::get('/dashboard', function () {
    return view('themes/jpn/users/dashboard');
});


/*
|--------------------------------------------------------------------------
| // Admin Routes
|--------------------------------------------------------------------------
*/
// Tags;
Route::get('/tags/edit/{tag_id}', [AdminTagController::class, 'edit'])->name('admin.tags.edit')->middleware(['auth', 'verified']);
Route::post('/tags/upload/{type}', [AdminTagController::class, 'upload'])->name('admin.tags.upload')->middleware(['auth', 'verified']);
Route::post('/tags/store', [AdminTagController::class, 'store'])->name('admin.tags.store')->middleware(['auth', 'verified']);

// Post Admin;
Route::post('/post/upload/{type}', [AdminPostController::class, 'upload'])->name('post.upload')->middleware(['auth', 'verified']);
Route::post('/post/store', [AdminPostController::class, 'store'])->name('post.store')->middleware(['auth', 'verified']);
Route::get('/post/edit/{post:slug}', [AdminPostController::class, 'edit'])->name('post.edit')->middleware(['auth', 'verified']);

// Users Admin
Route::post('/user/upload', [AdminUserController::class, 'upload'])->name('user.upload');
Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store');
Route::post('users/saveTheme', [AdminUserController::class, 'saveTheme'])->middleware(['auth']); // Theme Switcher

// Admin Prefix
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
    Route::resource('/', AdminIndexController::class); // Index Route
    Route::resource('/users', AdminUserController::class); // User Route
    Route::resource('/posts', AdminPostController::class); // Post Route
    Route::resource('/categories', AdminCategoryController::class); // Category Route
    Route::resource('/tags', AdminTagController::class); // Category Route
    Route::resource('/comments', AdminCommentController::class); // Comment Route
    Route::resource('/videos', AdminVideoController::class); // Video Route
});

// Other users posts;
Route::resource('/posts', PostController::class)->middleware(['auth']); // Post Route
