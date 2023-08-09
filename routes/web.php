<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ChildCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Models\CustomerAuth;
use Illuminate\Support\Facades\Route;

/* Middleware */
use App\Http\Middleware\isCustomer;
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

Route::get('/',[FrontendController::class,'index']);
Route::get('/home',[FrontendController::class,'index'])->name('home');
Route::get('/search_product',[FrontendController::class,'Search'])->name('search_product');
Route::get('/category-all',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/{category_id}',[FrontendController::class,'subCategory'])->name('category.list');
Route::get('/category/{category_id}/{subcategory_id}',[FrontendController::class,'childCategory'])->name('category.subcategory.list');
Route::get('/products/{category_id}/{subcategory_id?}/{childcategory_id?}',[FrontendController::class,'childCategoryProductList'])->name('category.product.list');
Route::get('/child-category-all',[ChildCategoryController::class,'index'])->name('child-category.index');
Route::get('/child-category-list/{subcategory_id}',[ChildCategoryController::class,'childCategory'])->name('child-category.list');
Route::get('offer-product',[ProductController::class,'index'])->name('product.index');
Route::get('popular-product',[ProductController::class,'topProduct'])->name('product.populer');
Route::get('/product-list/{childcategory_id}', [ProductController::class,'productList'])->name('product.list');
Route::get('/product_details/{id}', [ProductController::class,'singleProduct'])->name('product_details.singleProduct');

Route::get('/shopping-cart',[CartController::class,'cartPage'])->name('cart.page');
Route::get('/remove-from-cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('removefrom.cart');

/* Coupon apply & remove */
Route::post('cart/apply-coupon',[CartController::class,'couponApply'])->name('customer.couponapply');
Route::get('cart/remove-coupon/{coupon_name}',[CartController::class,'removeCoupon'])->name('customer.couponremove');


Route::get('/customer',[CustomerAuthController::class,'SingUpForm'])->name('register');
Route::post('register',[CustomerAuthController::class,'signUpStore'])->name('customer.store');
Route::get('/login',[CustomerAuthController::class,'SinInForm'])->name('login');
Route::post('/login',[CustomerAuthController::class,'customerLoginCheck'])->name('login.check');
Route::get('/customer-profile',[CustomerAuthController::class,'ProfileEdit'])->name('customer-profile');
Route::get('/allorder-list',[CustomerAuthController::class,'AllOrderList'])->name('allorder');
Route::post('/customer_update',[CustomerAuthController::class,'update'])->name('customer.update');
Route::get('/wishlist-add/{id}',[CustomerAuthController::class,'WishlistAdd'])->name('addwishlist');
Route::get('/wishlist-index',[CustomerAuthController::class,'WishlistIndex'])->name('wishlist.list');
Route::post('/wishlist-delete/{id}',[CustomerAuthController::class,'WishlistDelete'])->name('wishlist.destroy');
Route::get('/invoice-show/{id}',[CustomerAuthController::class,'InvoiceShow'])->name('invoice');
Route::get('/logout',[CustomerAuthController::class,'singOut'])->name('logOut');

    /*AJAX Call */
    Route::get('/upzilla/ajax/{district_id}', [CheckoutController::class, 'loadUpazillaAjax'])->name('loadupazila.ajax');
    Route::get('/shipping/ajax/{district_id}', [CheckoutController::class, 'ShippingAjax'])->name('loadupazila.ajax');

Route::group(['middleware'=>isCustomer::class],function(){
    Route::prefix('customer')->group(function(){
        Route::get('dashboard',[FrontendController::class,'CustomerDasboard'])->name('customer.dashboard');

        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to.cart');
        /*Checkout Page */
        Route::get('checkout', [CheckoutController::class, 'checkoutPage'])->name('customer.checkoutpage');
        Route::post('placeorder', [CheckoutController::class, 'placeOrder'])->name('customer.placeorder');

    });
});

