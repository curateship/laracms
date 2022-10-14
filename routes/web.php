<?php

use App\Http\Controllers\Frontend\GalleryController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminScraperController;
use App\Http\Controllers\Admin\AdminFavoriteController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminContestController;

// Front-End Controllers
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\FollowController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\FavoriteController;


/*
|--------------------------------------------------------------------------
| // Front-End Routes
|--------------------------------------------------------------------------
*/

// Index/Dashboard
route::get('/', [IndexController::class, 'index'])->name('index');
route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
route::get('/dashboard/getListBadges', [HomeController::class, 'getListBadges'])->middleware(['auth', 'verified']);

// Static Pages
Route::get('/page/contact', function () {return view('theme.pages.contact');});
Route::get('/page/term', function () {return view('theme.pages.term');});
Route::get('/page/jobs', function () {return view('theme.pages.jobs');});

// Users
route::get('/users', [UserController::class, 'index'])->name('index');

// Notifications
route::get('/notifications/getList', [NotificationController::class, 'getList'])->name('notifications.get')->middleware(['auth']);
route::post('/notifications/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.mark')->middleware(['auth']);
route::post('/notifications/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAll')->middleware(['auth']);
route::post('/notifications/clear', [NotificationController::class, 'clear'])->name('notifications.clear')->middleware(['auth']);

// Follows
Route::post('/users/follow', [FollowController::class, 'followUser'])->name('users.follow')->middleware(['auth']);
Route::post('/tags/follow', [FollowController::class, 'followTag'])->name('tags.follow')->middleware(['auth']);
Route::post('/contests/follow', [FollowController::class, 'followContest'])->name('contest.follow')->middleware(['auth']);

// Likes
Route::post('/like/post', [LikeController::class, 'like'])->name('post.like');

// Post
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');

// Posts masonry ajax;
Route::get('/masonry/posts/page/{id}', [PostController::class, 'ajaxShowPosts']);//->middleware('cache');
Route::get('/infinite/posts/page/{id}', [PostController::class, 'ajaxInfiniteShowPosts']);//->middleware('cache');

// Suggestions;
Route::get('/suggestions/get', [PostController::class, 'getSuggestions'])->name('suggestions.get')->middleware(['auth', 'verified']);

// Posts
Route::resource('/posts', PostController::class)->middleware(['auth']);
Route::post('/posts/move', [PostController::class, 'move'])->name('post.move')->middleware(['auth', 'verified']);
Route::post('/posts/changeOwner/multiple', [AdminPostController::class, 'changeOwnerMultiple'])->name('posts.chaneOwner.multiple')->middleware(['auth', 'auth.isAdmin']);

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
Route::resource('/comments', AdminCommentController::class)->middleware(['auth']);
Route::get('/comments/edit/{id}', [AdminCommentController::class, 'edit'])->name('comments.edit')->middleware(['auth']);
Route::post('/comments/update', [AdminCommentController::class, 'update'])->name('comments.update')->middleware(['auth', 'verified']);
Route::get('/post/comment/get/{post_id}/{last_comment_id}', [PostController::class, 'getPostComments'])->name('post-comment-get');
Route::get('/post/comment/reply', [PostController::class, 'reply'])->name('post-comment-reply')->middleware(['auth', 'verified']);
Route::post('/post/comment/reply-save', [PostController::class, 'saveReply'])->name('post-comment-reply-save')->middleware(['auth', 'verified']);
Route::post('/post/comment/save', [PostController::class, 'saveComment'])->name('post-comment-save')->middleware(['auth', 'verified']);
Route::get('/post/comment/reply-get-list', [PostController::class, 'getReply'])->name('post-comment-reply-list');

// Profiles
Route::get('/user/edit', [UserController::class, 'editProfile'])->middleware(['auth'])->name('profile.edit');
Route::get('/user/{username}', [UserController::class, 'showProfile']);
Route::post('/user/edit/{user_id}', [UserController::class, 'profileUpdate'])->middleware(['auth'])->name('profile.update');

// Search
Route::get('/search/{search_request}', [PostController::class, 'postSearch'])->name('posts.search');

// Filtered Posts;
Route::get('/most-liked', [PostController::class, 'mostLiked'])->name('posts.most-liked');
Route::get('/most-commented', [PostController::class, 'mostCommented'])->name('posts.most-commented');
Route::get('/most-viewed', [PostController::class, 'mostViewed'])->name('posts.most-viewed');
Route::get('/most-recent', [PostController::class, 'mostRecent'])->name('posts.most-recent');
Route::get('/premium', [PostController::class, 'premium'])->name('posts.premium');

// Favorite lists;
Route::resource('/favorites', FavoriteController::class)->middleware(['auth']);
Route::post('/favorite/store', [AdminFavoriteController::class, 'store'])->name('favorite.store')->middleware(['auth', 'verified']);
Route::get('/favorite/edit/{favorite_id}', [AdminFavoriteController::class, 'edit'])->name('favorite.edit')->middleware(['auth', 'verified']);
Route::get('/favorite/getListCreateForm', [FavoriteController::class, 'getListCreateForm'])->middleware(['auth'])->name('favorite.get-create-form');
Route::get('/favorite/getList', [FavoriteController::class, 'getList'])->middleware(['auth'])->name('favorite.get-list');
Route::get('/favorite/getModal', [FavoriteController::class, 'getModal'])->middleware(['auth'])->name('favorite.get-modal');
Route::post('/favorite/upload', [FavoriteController::class, 'upload'])->name('favorite.upload')->middleware(['auth', 'verified']);
Route::post('/favorite/create', [FavoriteController::class, 'createNew'])->name('favorite.create')->middleware(['auth', 'verified']);
Route::post('/favorite/addItem', [FavoriteController::class, 'addItem'])->name('favorite.add-item')->middleware(['auth', 'verified']);
Route::post('/favorite/removeList', [FavoriteController::class, 'removeList'])->name('favorite.remove')->middleware(['auth', 'verified']);
Route::get('/lists', [FavoriteController::class, 'showUserLists']);
Route::get('/lists/show/{slug}', [FavoriteController::class, 'showListPosts']);

/*
|--------------------------------------------------------------------------
| // Admin Routes
|--------------------------------------------------------------------------
*/

// Scraper
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

// Post Admin
Route::post('/admin/posts/move', [AdminPostController::class, 'move'])->name('post.move')->middleware(['auth', 'auth.isAdmin']);
Route::get('/post/upload/getUploadForm/{type}', [AdminPostController::class, 'getUploadForm'])->name('post.getUploadForm')->middleware(['auth', 'verified']);
Route::post('/post/upload/image/{type}', [AdminPostController::class, 'upload'])->name('post.upload.image')->middleware(['auth', 'verified']);
Route::post('/post/upload/video/{type}', [AdminVideoController::class, 'upload'])->name('post.upload.video')->middleware(['auth', 'verified']);
Route::post('/post/upload/gallery/{type}', [AdminPostController::class, 'upload'])->name('post.uploadMain.gallery')->middleware(['auth', 'verified']);
Route::post('/post/upload/news/{type}', [AdminPostController::class, 'upload'])->name('post.uploadMain.news')->middleware(['auth', 'verified']);
Route::post('/post/upload/gallery', [AdminGalleryController::class, 'upload'])->name('post.upload.gallery')->middleware(['auth', 'verified']);
Route::post('/post/store', [AdminPostController::class, 'store'])->name('post.store')->middleware(['auth', 'verified']);
Route::get('/post/edit/{post:slug}', [AdminPostController::class, 'edit'])->name('post.edit')->middleware(['auth', 'verified']);

// Galleries;
Route::resource('/galleries', GalleryController::class)->middleware(['auth']);
Route::get('/gallery/getManga', [GalleryController::class, 'mangeAjax']);

// Users Admin
Route::post('/user/upload', [AdminUserController::class, 'upload'])->name('user.upload');
Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store');
Route::post('/users/saveTheme', [AdminUserController::class, 'saveTheme'])->middleware(['auth']); // Theme Switcher
Route::post('/users/restoreFromTrash', [AdminUserController::class, 'restoreFromTrash'])->middleware(['auth']); // Theme Switcher

// Pages;
Route::get('/pages/edit/{page:slug}', [AdminPageController::class, 'edit'])->name('page.edit')->middleware(['auth', 'verified']);
// Contests;
Route::get('/contests', [AdminContestController::class, 'showList'])->name('contest.list');
Route::get('/contests/edit/{contest:slug}', [AdminContestController::class, 'edit'])->name('contest.edit')->middleware(['auth', 'verified']);
Route::get('/contests/getFollows/{contest_id}', [AdminContestController::class, 'getContestFollower']);
Route::post('/contests/upload/{type}', [AdminContestController::class, 'upload'])->name('admin.contests.upload')->middleware(['auth', 'verified']);

// Admin Prefix
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function (){
    Route::get('/contests/getFollows/{contest_id}', [AdminContestController::class, 'getFollows']);
    Route::get('/contests/getPosts/{contest_id}', [AdminContestController::class, 'getPosts']);
    Route::post('/contests/removeFollow', [AdminContestController::class, 'removeFollow']);
    Route::post('/contests/removePostFromContest', [AdminContestController::class, 'removePostFromContest']);



    Route::resource('/', AdminIndexController::class); // Index Route
    Route::resource('/users', AdminUserController::class); // User Route
    Route::resource('/posts', AdminPostController::class); // Post Route
    Route::resource('/categories', AdminCategoryController::class); // Category Route
    Route::resource('/tags', AdminTagController::class); // Category Route
    Route::resource('/comments', AdminCommentController::class); // Comment Route
    Route::resource('/videos', AdminVideoController::class); // Video Route
    Route::resource('/favorites', AdminFavoriteController::class); // Favorites Route
    Route::resource('/galleries', AdminGalleryController::class); // Galleries Route
    Route::resource('/pages', AdminPageController::class); // Pages Route
    Route::resource('/contests', AdminContestController::class); // Contest Route
});

// Universal pages router;
Route::get('/contest/{any}', [AdminContestController::class, 'show'])->where('any', '.*');
Route::get('/{any}', [AdminPageController::class, 'show'])->where('any', '.*');
