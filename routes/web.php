<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomePageSettingController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Vendor\VendorMainController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorStoreController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterBrandContoller;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubCategoryController;
use App\Http\Controllers\WishlistController;
use App\Models\HomePageSetting;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});


Route::controller(CustomerProductController::class)->group(function () {
    Route::get('/product/{slug}', 'index')->name('product.show');
    Route::post('/product/review/{slug}', 'addReview')->name('product.review');
});


Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('user.cart');
    // Route::post('/product/review/{slug}', 'addReview')->name('product.review');
});

Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', 'index')->name('user.wishlist');
    // Route::post('/product/review/{slug}', 'addReview')->name('product.review');
});




// Route::get('/home', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('home');

//admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
            Route::get('/manage/store', 'manage_stores')->name('admin.manage.store');
            Route::get('/cart/history', 'cart_history')->name('admin.cart.histroy');
            Route::get('/order/history', 'order_history')->name('admin.order.histroy');
        });

        Route::controller(HomePageSettingController::class)->group(function () {

            Route::get('/home/banner/create', 'index')->name('home.banner.create');
            Route::get('/home/banner/manage', 'manage')->name('home.banner.manage');

            Route::post('/home/banner/add', 'add_home_banner')->name('add.home.banner');
            // Route::get('/home/banner/{id}', 'show_single_home_banner')->name('show.home.banner');
            // Route::put('/home/banner/update/{id}', 'update_home_banner')->name('update.home.banner');
            Route::delete('/home/banner/delete/{id}', 'delete_home_banner')->name('delete.home.banner');
        });


        Route::controller(CategoryController::class)->group(function () {

            Route::get('/category/create', 'index')->name('category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });


        Route::controller(SubCategoryController::class)->group(function () {

            Route::get('/subcategory/create', 'index')->name('subcategory.create');
            Route::get('/subcategory/manage', 'manage')->name('subcategory.manage');
        });

        Route::controller(ProductController::class)->group(function () {

            Route::get('/product/manage', 'index')->name('product.manage');
            Route::get('/product/review/manage', 'review_manage')->name('product.review.manage');
        });

        Route::controller(BrandController::class)->group(function () {

            Route::get('/brand/create', 'index')->name('brand.create');
            Route::get('/brand/manage', 'manage')->name('brand.manage');
        });


        Route::controller(ProductAttributeController::class)->group(function () {

            Route::get('/productattribute/create', 'index')->name('productattribute.create');
            Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');
            Route::post('/defaultattribute/create', 'create_attribute')->name('attribute.create');
            Route::get('/defaultattribute/{id}', 'show_single_attribute')->name('show.attribute');
            Route::put('/defaultattribute/update/{id}', 'update_attribute')->name('update.attribute');
            Route::delete('/defaultattribute/delete/{id}', 'delete_attribute')->name('delete.attribute');
        });

        Route::controller(ProductDiscountController::class)->group(function () {

            Route::get('/discount/create', 'index')->name('discount.create');
            Route::get('/discount/manage', 'manage')->name('discount.manage');
        });

        Route::controller(MasterCategoryController::class)->group(function () {

            Route::post('/store/category', 'storecat')->name('store.cat');
            Route::get('/category/{id}', 'show_single_category')->name('show.cat');
            Route::put('/category/update/{id}', 'update_category')->name('update.cat');
            Route::delete('/category/delete/{id}', 'delete_category')->name('delete.cat');
        });


        Route::controller(MasterSubCategoryController::class)->group(function () {

            Route::post('/store/subcategory', 'store_subcat')->name('store.subcat');
            Route::get('/subcategory/{id}', 'show_single_subcategory')->name('show.subcat');
            Route::put('/subcategory/update/{id}', 'update_subcategory')->name('update.subcat');
            Route::delete('/subcategory/delete/{id}', 'delete_subcategory')->name('delete.subcat');
        });

        Route::controller(MasterBrandContoller::class)->group(function () {

            Route::post('/store/brand', 'store_brand')->name('store.brand');
            Route::get('/brand/{id}', 'show_single_brand')->name('show.brand');
            Route::put('/brand/update/{id}', 'update_brand')->name('update.brand');
            Route::delete('/brand/delete/{id}', 'delete_brand')->name('delete.brand');
        });
    });
});

// vendor routes
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function () {
    Route::prefix('vendor')->group(function () {
        Route::controller(VendorMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('vendor');
            Route::get('/order/history', 'order_history')->name('vendor.order.history');
        });

        Route::controller(VendorProductController::class)->group(function () {
            Route::get('/product/create', 'index')->name('vendor.product');
            Route::get('/product/manage', 'manage')->name('vendor.product.manage');
            Route::post('/product/store', 'store_product')->name('vendor.product.store');
            Route::get('/product/{id}', 'show_single_product')->name('vendor.product.show');
            Route::put('/product/update/{id}', 'update_product')->name('vendor.update.product');
            Route::delete('/product/delete/{id}', 'delete_product')->name('vendor.product.delete');


            // Route::get('/product/variant/create', 'index_variant')->name('vendor.product.variant');
            // Route::get('/product/variant/manage', 'manage_variant')->name('vendor.product.variant.manage');
            // Route::post('/product/variant/store','store_product_variant')->name('vendor.product.variant.store');
            // Route::get('/product/variant/{id}', 'show_single_product_variant')->name('vendor.product.variant.show');
            // Route::put('/product/variant/update/{id}', 'update_product_variant')->name('vendor.update.product.variant');
            // Route::delete('/product/variant/delete/{id}', 'delete_product_variant')->name('vendor.product.variant.delete');
        });

        Route::controller(VendorStoreController::class)->group(function () {
            Route::get('/store/create', 'index')->name('vendor.store.create');
            Route::get('/store/manage', 'manage')->name('vendor.store.manage');
            Route::post('/store/publish', 'store')->name('create.store');
            Route::get('/store/{id}', 'show_single_store')->name('show.store');
            Route::put('/store/update/{id}', 'update_store')->name('update.store');
            Route::delete('/store/delete/{id}', 'delete_store')->name('delete.store');
        });
    });
});


// Route::get('/vendor/dashboard', function () {
//     return view('vendor');
// })->middleware(['auth', 'verified', 'rolemanager:vendor'])->name('vendor');


//user routes
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::controller(CustomerMainController::class)->group(function () {
            // Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/order/history', 'history')->name('customer.history');
            Route::get('/setting/payment', 'payment')->name('customer.payment');
            Route::get('/affiliate', 'affiliate')->name('customer.affiliate');
        });
    });


  
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
