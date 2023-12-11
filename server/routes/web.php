<?php

use App\Http\Controllers\OrderController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\User\UserPaymentResultComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserCheckoutComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DetailsComponent;
use App\Http\Controllers\CheckoutController;
use App\Http\Livewire\WishlistComponent;
use App\Http\Controllers\Auth\RegisteredSellerController;

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

Route::group(['middleware' => ['userLogin']], function () {
    //admin
    Route::group(['middleware' => 'authAdmin', 'prefix'=> 'admin'], function () {
        Route::get('dashboard', \App\Http\Livewire\Admin\AdminDashBoardComponent::class)->name('admin.dashboard');
        Route::get('categories', \App\Http\Livewire\Admin\AdminCategoriesComponent::class)->name('admin.categories');
        Route::get('category/add', \App\Http\Livewire\Admin\AdminAddCategoryComponent::class)->name('admin.category.add');
        Route::get('category/edit/{category_id}', \App\Http\Livewire\Admin\AdminEditCategoryComponent::class)->name('admin.category.edit');
        Route::get('category/delete/{category_id}', \App\Http\Livewire\Admin\AdminDeleteCategoryComponent::class)->name('admin.category.delete');
        Route::get('authors', \App\Http\Livewire\Admin\AdminAuthorsComponent::class)->name('admin.authors');
        Route::get('author/add', \App\Http\Livewire\Admin\AdminAuthorAddComponent::class)->name('admin.author.add');
        Route::get('author/edit/{author_id}', \App\Http\Livewire\Admin\AdminAuthorEditComponent::class)->name('admin.author.edit');
        Route::get('author/delete/{author_id}', \App\Http\Livewire\Admin\AdminAuthorDeleteComponent::class)->name('admin.author.delete');
        Route::get('publishers', \App\Http\Livewire\Admin\AdminPublishersComponent::class)->name('admin.publishers');
        Route::get('publisher/add', \App\Http\Livewire\Admin\AdminPublisherAddComponent::class)->name('admin.publisher.add');
        Route::get('publisher/edit/{publisher_id}', \App\Http\Livewire\Admin\AdminPublisherEditComponent::class)->name('admin.publisher.edit');
        Route::get('publisher/delete/{publisher_id}', \App\Http\Livewire\Admin\AdminPublisherDeleteComponent::class)->name('admin.publisher.delete');
        Route::get('products', \App\Http\Livewire\Admin\AdminProductComponent::class)->name('admin.products');
        Route::get('product/add', \App\Http\Livewire\Admin\AdminProductAddComponent::class)->name('admin.product.add');
        Route::get('product/edit/{product_id}', \App\Http\Livewire\Admin\AdminProductEditComponent::class)->name('admin.product.edit');
        Route::get('product/delete/{product_id}', \App\Http\Livewire\Admin\AdminProductDeleteComponent::class)->name('admin.product.delete');
        Route::get('orders', \App\Http\Livewire\Admin\AdminOrdersComponent::class)->name('admin.orders');
        Route::get('order/edit/{order_id}', \App\Http\Livewire\Admin\AdminOrderEditComponent::class)->name('admin.order.edit');
    });

    // seller
    Route::group(['middleware' => 'authSeller', 'prefix'=> 'seller'], function () {

    });

    //user
    Route::group(['middleware'=> 'authUser', 'prefix' => 'user'], function () {
        Route::get('orders', UserOrdersComponent::class)->name('user.orders');
        Route::post('place-order', [CheckoutController::class, 'payment'])->name('user.payment');
        Route::get('order-detail/{order_id}', [OrderController::class, 'show'])->name('user.order_detail');
        Route::post('order-cancel/{order_id}', [OrderController::class, 'cancel'])->name('user.order_cancel');
        Route::get('checkout', UserCheckoutComponent::class)->name('user.checkout');
        Route::get('payment-result', UserPaymentResultComponent::class)->name('user.payment_result');
        Route::get('wishlist', WishlistComponent::class)->name('user.wishlist');
    });
});

// Guest
Route::get('/', HomeComponent::class)->name('home.index');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/products{category_id}', DetailsComponent::class)->name('product.detailss');
Route::get('/product-category/{slug}', App\Http\Livewire\CategoryComponent::class)->name('product.category');
Route::get('/search', App\Http\Livewire\SearchComponent::class)->name('product.search');
Route::get('/About', App\Http\Livewire\AboutComponent::class)->name('about');
Route::get('/Blog', App\Http\Livewire\BlogComponent::class)->name('blog');
Route::get('/seller/register', [RegisteredSellerController::class, 'create'])->name('seller.register');
Route::post('/seller/register', [RegisteredSellerController::class, 'store'])->name('seller.store');

Route::get('/handle-vnpay-return', [CheckoutController::class, 'handleVNPayReturn'])->name('vnpay.return');

require __DIR__.'/auth.php';
