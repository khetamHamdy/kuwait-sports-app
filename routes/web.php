<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WEB\Admin\adminController;
use App\Http\Controllers\WEB\Admin\UserContestController;
use App\Models\Subscribe;
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

//dashboard Route


Route::prefix('/admin')->as('admin.')->middleware('admin')->group(function () {

    Route::get('setting', [\App\Http\Controllers\WEB\Admin\SettingsController::class, 'create'])->name('setting.create');
    Route::post('setting', [\App\Http\Controllers\WEB\Admin\SettingsController::class, 'store'])->name('setting.store');

    Route::get('/changeMyPassword', [adminController::class, 'changeMyPassword'])->name('changePassword');
    Route::post('logout', [\App\Http\Controllers\AdminAuth\LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/home', [\App\Http\Controllers\WEB\Admin\homeController::class, 'index'])->name('home');
    Route::resource('event', \App\Http\Controllers\WEB\Admin\EventController::class);
    //advertisement Ads
    Route::resource('poster', \App\Http\Controllers\WEB\Admin\PostersController::class);
    Route::get('/filterEvent', [\App\Http\Controllers\WEB\Admin\EventController::class, 'index'])->name('event.filter');
    Route::get('getItem/{req}/{event_id}', [\App\Http\Controllers\WEB\Admin\EventController::class, 'getItems']);

    Route::get('contest_getItem/{req}/{contest_id}', [\App\Http\Controllers\WEB\Admin\ContestController::class, 'getItems']);


    Route::get('/event-image/{event_image_id}/delete', [\App\Http\Controllers\WEB\Admin\EventController::class, 'deleteEventImage']);
    Route::resource('product', \App\Http\Controllers\WEB\Admin\ProductController::class);
    Route::resource('media', \App\Http\Controllers\WEB\Admin\MediaController::class);

    Route::get('/filterProduct', [\App\Http\Controllers\WEB\Admin\ProductController::class, 'index'])->name('product.filter');
    Route::get('/product-image/{product_image_id}/delete', [\App\Http\Controllers\WEB\Admin\ProductController::class, 'deleteProductImage']);
    Route::resource('slider', \App\Http\Controllers\WEB\Admin\SliderController::class);
    Route::get('/filterSlider', [\App\Http\Controllers\WEB\Admin\SliderController::class, 'index'])->name('slider.filter');

//    Route::delete('/RoleDeleteAll', [\App\Http\Controllers\WEB\Admin\RolesController::class, 'RoleDeleteAll']);

    Route::get('/editAdmin', [adminController::class, 'editAdmin'])->name('editAdmin');
    Route::post('/updateProfile', [adminController::class, 'updateProfile'])->name('updateProfile');

    Route::post('/updateMyPassword', [adminController::class, 'updateMyPassword'])->name('updateMyPassword');

    Route::get('/admins/{id}/edit', [adminController::class, 'edit'])->name('admins.edit');
    Route::patch('/admins/{id}', [adminController::class, 'update'])->name('users.update');
    Route::get('/admins/{id}/edit_password', [adminController::class, 'edit_password'])->name('admins.edit_password');
    Route::post('/admins/{id}/edit_password', [adminController::class, 'update_password'])->name('admins.edit_password');

    Route::resource('contest', \App\Http\Controllers\WEB\Admin\ContestController::class);

    Route::get('/admins', [adminController::class, 'index'])->name('admins.all');
    Route::post('/admins/changeStatus', [adminController::class, 'changeStatus'])->name('admin_changeStatus');
    Route::delete('admins/{id}', [adminController::class, 'destroy'])->name('admins.destroy');
    Route::post('/admins', [adminController::class, 'store'])->name('admins.store');
    Route::get('/admins/create', [adminController::class, 'create'])->name('admins.create');

    Route::get('/user', [\App\Http\Controllers\WEB\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/filterUser', [\App\Http\Controllers\WEB\Admin\UserController::class, 'index'])->name('users.filter');

    Route::get('addUser', [\App\Http\Controllers\WEB\Admin\UserController::class, 'create'])->name('add_user');
    Route::post('storeUser', [\App\Http\Controllers\WEB\Admin\UserController::class, 'store'])->name('store_user');
    Route::get('editUser/{user}', [\App\Http\Controllers\WEB\Admin\UserController::class, 'edit_user'])->name('edit_user');
    Route::put('updateUser/{user}', [\App\Http\Controllers\WEB\Admin\UserController::class, 'update_user'])->name('update_user');
    Route::put('password_update/{user}', [\App\Http\Controllers\WEB\Admin\UserController::class, 'update_password_user'])->name('password_update');
    Route::get('getItems/{req}/{user_id}', [\App\Http\Controllers\WEB\Admin\UserController::class, 'getItems']);

    Route::get('contact_users', [\App\Http\Controllers\WEB\Admin\homeController::class, 'contact_users'])->name('contact.user');
    Route::get('/filterContactUser', [\App\Http\Controllers\WEB\Admin\homeController::class, 'contact_users'])->name('contact_users.filter');

    Route::get('/likesUsers', [\App\Http\Controllers\WEB\Admin\homeController::class, 'favorites'])->name('likesUsers');

    Route::get('/filterContest', [\App\Http\Controllers\WEB\Admin\ContestController::class, 'index'])->name('contest.filter');

    Route::resource('permission', \App\Http\Controllers\WEB\Admin\PermissionsController::class);
    Route::delete('/permissionDeleteAll', [\App\Http\Controllers\WEB\Admin\PermissionsController::class, 'deletePermission']);
    Route::resource('/roles', \App\Http\Controllers\WEB\Admin\RolesController::class);

    // Route::resource('winner', \App\Http\Controllers\WEB\Admin\PermissionsController::class);

    Route::get('newsletter', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'index'])->name('newsletter.index');

    Route::get('PdfNewsletter', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'pdf_subscribe']);
    Route::get('ExcelNewsletter', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'export_subscribe']);

    Route::get('ExcelUser', [\App\Http\Controllers\WEB\Admin\UserController::class, 'export_user']);
    Route::get('ExcelMessage', [\App\Http\Controllers\WEB\Admin\homeController::class, 'export_message']);

    Route::get('filterNewsletter', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'index'])->name('filterNewsletter.index');
    Route::get('newsletter/edit/{subscribe}', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::put('newsletter/update/{subscribe}', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'update'])->name('newsletter.update');
    Route::delete('/newsletterDeleteAll', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'deleteNewsletter']);

    Route::post('/changeStatus/{model}', [\App\Http\Controllers\WEB\Admin\homeController::class, 'changeStatus']);

    Route::resource('usercontest', UserContestController::class);
    Route::get('users_contest_participants/{contest_id}', [UserContestController::class, 'index'])->name('participants.contest');

});

Route::prefix('/admin')->as('admin.')->group(function () {
//    Route::get('register', [\App\Http\Controllers\AdminAuth\RegisterController::class, 'create'])
//        ->name('register');
//    Route::post('register', [\App\Http\Controllers\AdminAuth\RegisterController::class, 'store']);
    Route::get('/login', [\App\Http\Controllers\AdminAuth\LoginController::class, 'create'])
        ->name('login');
    Route::post('/login', [\App\Http\Controllers\AdminAuth\LoginController::class, 'store']);
});

Route::get("/", [\App\Http\Controllers\WEB\Site\HomeController::class, 'index'])->name('home');


Route::get('register', [RegisterController::class, 'create'])
    ->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'create'])
    ->name('login');
Route::post('login', [LoginController::class, 'store']);

Route::get('search', [\App\Http\Controllers\WEB\Site\HomeController::class, 'search_event'])->name('search');
Route::get('event', [\App\Http\Controllers\WEB\Site\HomeController::class, 'event'])->name('event');
Route::get('products', [\App\Http\Controllers\WEB\Site\HomeController::class, 'products'])->name('products');
Route::get('read_more_event/{type}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'event_more'])->name('event_more');
Route::get('details_event/{event}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'details_event'])->name('details.event');

Route::get('details_product/{product}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'details_product'])->name('detail.product');
Route::get('about', [\App\Http\Controllers\WEB\Site\HomeController::class, 'about'])->name('about');
Route::get('blogs', [\App\Http\Controllers\WEB\Site\HomeController::class, 'blogs'])->name('blogs');
Route::get('advice', [\App\Http\Controllers\WEB\Site\HomeController::class, 'advice'])->name('advice');
Route::get('Interviews', [\App\Http\Controllers\WEB\Site\HomeController::class, 'Interviews'])->name('Interviews');


Route::get('terms_condition', [\App\Http\Controllers\WEB\Site\HomeController::class, 'terms_condition'])->name('terms.condition');
Route::get('privacyPolicy', [\App\Http\Controllers\WEB\Site\HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('food', [\App\Http\Controllers\WEB\Site\HomeController::class, 'food'])->name('food');
Route::post('newsletter', [\App\Http\Controllers\WEB\Admin\NewsletterController::class, 'store'])->name('newsletter.store');

Route::get('contact', [\App\Http\Controllers\WEB\Site\HomeController::class, 'contact_create'])->name('contact.create');
Route::post('contactUs', [\App\Http\Controllers\WEB\Site\HomeController::class, 'contact_store'])->name('contact.store');

Route::get('users-photo-contest', [\App\Http\Controllers\WEB\Site\HomeController::class, 'photoContestUsers'])->name('photo-contest-user');
Route::get('photo-media', [\App\Http\Controllers\WEB\Site\HomeController::class, 'photoMedia'])->name('photo-media');

Route::get('event_favorite/{event_id}/{user_id}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'favorite_users'])->middleware('auth:web')
    ->name('favorite_users');


Route::get('Favorite/{contest_id}/{user_id}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'favorite_contest'])->name('Favorite_contest');
Route::get('contest_admin/{contest_id}/{user_id}', [\App\Http\Controllers\WEB\Site\HomeController::class, 'favorite_admin'])->middleware('auth:web');


Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');


//Web Route
Route::middleware('auth:web')->group(function () {

    Route::get('editProfile', [\App\Http\Controllers\WEB\Site\HomeController::class, 'editProfile'])->name('edit.profile');
    Route::put('editProfile', [\App\Http\Controllers\WEB\Site\HomeController::class, 'updateProfile'])->name('update.profile');
    Route::get('editPassword', [\App\Http\Controllers\WEB\Site\HomeController::class, 'editPassword'])->name('edit.password');
    Route::put('editPassword', [\App\Http\Controllers\WEB\Site\HomeController::class, 'updatePassword'])->name('update.password');


    Route::get('contest', [\App\Http\Controllers\WEB\Site\HomeController::class, 'contest_create'])->name('contest.create');
    Route::post('contest', [\App\Http\Controllers\WEB\Site\HomeController::class, 'contest_store'])->name('contest.store');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');

});

