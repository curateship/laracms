<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminScraperController;

// Front-End Controllers
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\Frontend\UserController;


/*
|--------------------------------------------------------------------------
| // Front-End Routes
|--------------------------------------------------------------------------
*/

// Index/Dashboard
route::get('/', [IndexController::class, 'index'])->name('index');
route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

// Users;
route::get('/users', [UserController::class, 'index'])->name('index');

// Post
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');

// Contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Categories
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('theme.default.archive.categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('theme.default.archive.categories.index');

// Tags
Route::get('/category/{category_name}', [TagController::class, 'showCategory'])->name('tags.category');
Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');
Route::get('/tags/{tags_categories_name}/{tag_slug}', [TagController::class, 'show'])->name('theme.default.archive.tags.show');

// Comments
Route::get('/post/comment/get/{post_id}/{last_comment_id}', [PostController::class, 'getPostComments'])->name('post-comment-get');
Route::get('/post/comment/reply', [PostController::class, 'reply'])->name('post-comment-reply')->middleware(['auth', 'verified']);
Route::post('/post/comment/reply-save', [PostController::class, 'saveReply'])->name('post-comment-reply-save')->middleware(['auth', 'verified']);
Route::post('/post/comment/save', [PostController::class, 'saveComment'])->name('post-comment-save')->middleware(['auth', 'verified']);
Route::get('/post/comment/reply-get-list', [PostController::class, 'getReply'])->name('post-comment-reply-list');

// Profiles;
Route::get('/user/edit', [UserController::class, 'editProfile'])->middleware(['auth'])->name('profile.edit');
Route::get('/user/{user_id}', [UserController::class, 'showProfile']);
Route::post('/user/edit/{user_id}', [UserController::class, 'profileUpdate'])->middleware(['auth'])->name('profile.update');

// Posts;
Route::resource('/posts', PostController::class)->middleware(['auth']);
Route::post('/posts/move', [PostController::class, 'move'])->name('post.move')->middleware(['auth', 'verified']);

// Search;
Route::get('/search/{search_request}', [PostController::class, 'postSearch'])->name('posts.search');

// Temp
Route::get('/dashboard', function () {
    return view('theme/users/dashboard');
});

/*
|--------------------------------------------------------------------------
| // Admin Routes
|--------------------------------------------------------------------------
*/

// Scraper;
Route::get('/scraper', [AdminScraperController::class, 'index'])->middleware(['auth', 'auth.isAdmin']);
Route::get('/scraper/settings', [AdminScraperController::class, 'scraperSetting'])->middleware(['auth', 'auth.isAdmin']);
Route::post('/scraper/store', [AdminScraperController::class, 'storeScraperSetting'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.store');
Route::post('/scraper/scraper-v1', [AdminScraperController::class, 'saveScraper'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.save_scraper');
Route::get('/scraper/run_pause/{id}', [AdminScraperController::class, 'runpauseScraperCron'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.run_pause');
Route::get('/scraper/stop/{id}', [AdminScraperController::class, 'stopScraperCron'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.stop');
Route::get('/scraper/delete/{id}', [AdminScraperController::class, 'deleteScraperCron'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.delete');
Route::get('/scraper/retry', [AdminScraperController::class, 'retryScraper'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.retry');
Route::post('/scraper/get_logs', [AdminScraperController::class, 'getLogs'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.get_logs');
Route::post('/scraper/delete_log_item', [AdminScraperController::class, 'deleteLogItem'])->middleware(['auth', 'auth.isAdmin'])->name('scraper.delete_log_item');
Route::get('/scraper/scraper-v1', [AdminScraperController::class, 'newScraper'])->middleware(['auth', 'auth.isAdmin']);
Route::get('/scraper/scraper-v1/{id}', [AdminScraperController::class, 'loadScraper'])->middleware(['auth', 'auth.isAdmin']);


// Tags;
Route::get('/tags/edit/{tag_id}', [AdminTagController::class, 'edit'])->name('admin.tags.edit')->middleware(['auth', 'verified']);
Route::post('/tags/upload/{type}', [AdminTagController::class, 'upload'])->name('admin.tags.upload')->middleware(['auth', 'verified']);
Route::post('/tags/store', [AdminTagController::class, 'store'])->name('admin.tags.store')->middleware(['auth', 'verified']);

// Post Admin;
Route::post('/admin/posts/move', [AdminPostController::class, 'move'])->name('post.move')->middleware(['auth', 'auth.isAdmin']);
Route::post('/post/upload/{type}', [AdminPostController::class, 'upload'])->name('post.upload')->middleware(['auth', 'verified']);
Route::post('/post/store', [AdminPostController::class, 'store'])->name('post.store')->middleware(['auth', 'verified']);
Route::get('/post/edit/{post:slug}', [AdminPostController::class, 'edit'])->name('post.edit')->middleware(['auth', 'verified']);

// Users Admin
Route::post('/user/upload', [AdminUserController::class, 'upload'])->name('user.upload');
Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store');
Route::post('/users/saveTheme', [AdminUserController::class, 'saveTheme'])->middleware(['auth']); // Theme Switcher

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
