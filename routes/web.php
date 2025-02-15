<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
    return view('pages.index');
})->name('home');


Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "done";
});


Route::get('news', [SiteController::class, 'news'])->name('news.index');
Route::get('news/{slug}', [SiteController::class, 'showNews'])->name('news.show');

Route::get('login', [SiteController::class, 'login'])->name('login');
Route::post('login', [SiteController::class, 'login'])->name('login');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');

Route::get('register', [SiteController::class, 'register'])->name('register');
Route::post('register', [SiteController::class, 'register'])->name('register');

Route::get('gallery', [SiteController::class, 'gallery'])->name('gallery.index');
Route::get('gallery/{id}', [SiteController::class, 'showgallery'])->name('gallery.show');
Route::get('page/{id}', [SiteController::class, 'pageShow'])->name('pages.show');

//events
Route::get('events', [SiteController::class, 'events'])->name('event.index');
Route::get('events/archive', [SiteController::class, 'events_archive'])->name('event.archive');
Route::get('events/{id}', [SiteController::class, 'event_show'])->name('event.show');



//auth
Route::group(['middleware' => ['auth']], function () {

    //profile
    Route::get('profile', [SiteController::class, 'profile'])->name('profile');
    Route::post('profile', [SiteController::class, 'profile'])->name('profile.update');

    Route::get( 'my_events', [SiteController::class, 'my_events'])->name('my_events');
    Route::get( 'my_rentals', [SiteController::class, 'my_rentals'])->name('my_rentals');

    Route::post('event/register', [SiteController::class, 'event_register'])->name('event.register');

    Route::get('user', [SiteController::class, 'user'])->name('user');
    Route::get('user/edit', [SiteController::class, 'userEdit'])->name('user.edit');
    Route::post('user/edit', [SiteController::class, 'userEdit'])->name('user.edit');

    Route::get('rental/{id}', [SiteController::class, 'rentalTypeShow'])->name('rentalType.show');
    //rentals.store
    Route::post('rental/{id}', [SiteController::class, 'rentalStore'])->name('rentals.store');
    Route::get('rental/show/{id}', [SiteController::class, 'rentalShowUser'])->name('rentals.show');

    Route::get('rental/getHours/{id}', [SiteController::class, 'getHours'])->name('getHours');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

