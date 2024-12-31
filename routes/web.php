<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\MasterPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard','index')->name('admin');
            Route::get('/settings','settings')->name('admin.settings');
            Route::get('/manage/user','manage_user')->name('admin.manage.user');
            Route::get('/manage/store','manage_stores')->name('admin.manage.store');
            Route::get('/cart/history','cart_history')->name('admin.cart.history');
            Route::get('/order/history','order_history')->name('admin.order.history');
        });
        Route::prefix('post')->group(function () {
            Route::controller(PostController::class)->group(function () {
                Route::get('/create','index')->name('post.create');
                Route::get('/manage','index')->name('post.manage');
                
            });
            Route::controller(MasterPostController::class)->group(function () {
                Route::post('/store/subcategory','storesubcat')->name('store.subcat');
                Route::get('/subcategory/{id}','showsubcat')->name('show.subcat');
                Route::put('/subcategory/update/{id}','updatesubcat')->name('update.subcat');
                Route::delete('/subcategory/delete/{id}','deletesubcat')->name('delete.subcat');
            });
          
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create','index')->name('category.create');
            Route::get('/category/manage','manage')->name('category.manage');
        });
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::post('/store/category','storecat')->name('store.cat');
            Route::get('/category/{id}','showcat')->name('show.cat');
            Route::put('/category/update/{id}','updatecat')->name('update.cat');
            Route::delete('/category/delete/{id}','deletecat')->name('delete.cat');
        });
      
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
