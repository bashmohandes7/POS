<?php


use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::group(['middleware'=>'auth','prefix'=>'dashboard', 'as'=>'dashboard.'], function (){

        // Dashboard Routes
        Route::get('index', [DashboardController::class, 'index'])->name('welcome');

        // User Routes
        Route::group(['prefix'=> 'users', 'as' => 'users.'], function(){

            Route::get('/', [UserController::class, 'index'])
                ->name('index')
                ->middleware('permission:read_users');

            Route::get('/create', [UserController::class, 'create'])
                ->name('create')
                ->middleware('permission:create_users');

            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user}', [UserController::class, 'edit'])
                ->name('edit')
                ->middleware('permission:update_users');

            Route::put('update/{user}', [UserController::class, 'update'])->name('update');

            Route::delete('destroy/{user}', [UserController::class, 'destroy'])
                ->name('destroy')
                ->middleware('permission:delete_users');
        }); // end of user Routes


        // Category Routes
        Route::group(['prefix'=> 'categories', 'as'=> 'categories.'], function(){
            Route::get('/', [CategoryController::class, 'index'])
                ->name('index')
                ->middleware('permission:read_categories');

            Route::get('create', [CategoryController::class, 'create'])
                ->name('create')
                ->middleware('permission:create_categories');

            Route::post('store', [CategoryController::class, 'store'])->name('store');

            Route::get('edit/{category}', [CategoryController::class, 'edit'])
                ->name('edit')
                ->middleware('permission:update_categories');

            Route::put('update/{category}', [CategoryController::class, 'update'])->name('update');

            Route::delete('destroy/{category}', [CategoryController::class, 'destroy'])
                ->name('destroy')
                ->middleware('permission:delete_categories');


        }); // end of category routes



        // Product Routes

        Route::group(['prefix'=> 'products', 'as'=>'products.'], function(){

            Route::get('/', [ProductController::class, 'index'])
                ->name('index')
                ->middleware('permission:read_products');

            Route::get('create', [ProductController::class, 'create'])
                ->name('create')
                ->middleware('permission:create_products');

            Route::post('store', [ProductController::class, 'store'])->name('store');

            Route::get('edit/{product}', [ProductController::class, 'edit'])
                ->name('edit')
                ->middleware('permission:update_products');

            Route::put('update/{product}', [ProductController::class, 'update'])->name('update');

            Route::delete('destroy/{product}', [ProductController::class, 'destroy'])
                ->name('destroy')
                ->middleware('permission:delete_products');

        }); // end of product routes



    }); // end of dashboard routes



}); // End of Group
