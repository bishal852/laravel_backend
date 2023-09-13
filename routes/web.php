<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\SiteController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DashboardController;


Route::get('/esewa', [SiteController::class, 'getSewa'])->name('getSewa');
Route::get('/esewa/success', function(){
	dd('payment success');
});

Route::get('/esewa/fail', function(){
	dd('payment fail');
});


Route::get('postAjax/abc',[SiteController::class, 'postAjax'])->name('postAjax');



Route::get('/product/views', [SiteController::class, 'getProduct'])->name('getProduct');
Route::get('/product/cart/{product}', [SiteController::class, 'getAddCart'])->name('getAddCart');
Route::get('/product/cart/delete/{cart}', [SiteController::class, 'deletecarts'])->name('deletecarts');
Route::get('/product/cart/edit/{cart}', [SiteController::class, 'getEditCarts'])->name('editcarts');
Route::put('/product/cart/update/{cart}', [SiteController::class, 'postEditCart'])->name('updatecart');
Route::get('/product/carts', [SiteController::class, 'getCart'])->name('getCart');
Route::get('/product/carts/checkout/{cart}', [SiteController::class, 'getCheckOut'])->name('getCheckOut');
Route::post('/product/carts/checkout/form', [SiteController::class, 'postform'])->name('postform');




Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});

Route::get('/', [SiteController::class, 'getHome'])->name('getHome');


Route::get('/category', [CategoryController::class, 'AddCategory'])->name('AddCategory');
Route::post('/category/add', [CategoryController::class, 'postAddCategory'])->name('postAddCategory');
Route::get('/category/manage', [CategoryController::class, 'ManageCategory'])->name('ManageCategory');
Route::get('/category/manage/delete/{category}', [CategoryController::class, 'getDeleteCategory'])->name('getDeleteCategory');
Route::get('/category/manage/edit/{category}', [CategoryController::class, 'geteditcategory'])->name('geteditcategory');
Route::post('/category/manage/edited/{category}', [CategoryController::class, 'postEditCategory'])->name('postEditCategory');



Route::get('/gallery', [GalleryController::class, 'photo'])->name('AddGallery');
Route::post('/gallery/add', [GalleryController::class, 'postAddGallery'])->name('postAddGallery');
Route::get('/gallery/manage', [GalleryController::class, 'ManageGallery'])->name('ManageGallery');
Route::get('/gallery/manage/delete/{gallery}', [GalleryController::class, 'getDeleteGallery'])->name('getDeleteGallery');
Route::get('/gallery/manage/delete/edit/{gallery}', [GalleryController::class, 'getEditGallery'])->name('getEditGallery');
Route::post('/gallery/manage/delete/edited/{gallery}', [GalleryController::class, 'postEditGallery'])->name('postEditGallery');



Route::get('/product', [ProductController::class, 'product'])->name('AddProduct');
Route::post('/product/add', [ProductController::class, 'postAddProduct'])->name('postAddProduct');
Route::get('/product/manage', [ProductController::class, 'ManageProduct'])->name('ManageProduct');
Route::get('/product/manage/delete/{product}', [ProductController::class, 'getDeleteProduct'])->name('getDeleteProduct');
Route::get('/product/manage/edit/{product}', [ProductController::class, 'getEditProduct'])->name('getEditProduct');
Route::post('/product/manage/edited/{product}', [ProductController::class, 'postEditProduct'])->name('postEditProduct');





Route::get('/media', [MediaController::class, 'media'])->name('AddMedia');
Route::post('/media/add', [MediaController::class, 'postAddmedia'])->name('postAddMedia');
Route::get('/media/manage', [MediaController::class, 'Managemedia'])->name('ManageMedia');
Route::get('/media/manage/delete/{media}', [MediaController::class, 'getDeleteMedia'])->name('getDeleteMedia');
Route::get('/media/manage/delete/edit/{media}', [MediaController::class, 'getEditMedia'])->name('getEditMedia');
Route::post('/media/manage/delete/edited{media}', [MediaController::class, 'postEditMedia'])->name('postEditMedia');


Route::get('/shipping', [ShippingController::class, 'shipping'])->name('shipping');
Route::post('/shipping', [ShippingController::class, 'postAddShipping'])->name('postAddShipping');

