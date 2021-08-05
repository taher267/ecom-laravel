<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;

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

Route::get('/', HomeComponent::class)->name('home');

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');
// Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');

Route::get('/wishlist', App\Http\Livewire\WishlistComponent::class)->name('product.wishlist');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//For user or customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

//For Adamin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    //Admin Category
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');

    //Admin Product
    Route::get('/admin/products', App\Http\Livewire\Admin\AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', App\Http\Livewire\Admin\AdminAddProductComponent::class)->name('admin.addproduct');
    Route::get('/admin/product/edit/{product_slug}', App\Http\Livewire\Admin\AdminEditProductComponent::class)->name('admin.editproduct');

    //Home Slider
    Route::get('/admin/homeslider', App\Http\Livewire\Admin\AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/homeslide/add', App\Http\Livewire\Admin\AdminAddHomeSliderComponent::class)->name('admin.addhomeslide');
    Route::get('/admin/homeslide/edit/{slide_id}', App\Http\Livewire\Admin\AdminEditHomeSliderComponent::class)->name('admin.edithomeslide');

    //Home Category
     Route::get('/admin/home-category', App\Http\Livewire\Admin\AdminHomeCategoryComponent::class)->name('admin.homecategory');

     Route::get('/admin/onsale', App\Http\Livewire\Admin\AdminOnSaleComponent::class)->name('admin.onsale');

});
