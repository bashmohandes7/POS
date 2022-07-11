<?php

use App\Http\Controllers\Client\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::group(['middleware'=>'auth','prefix'=>'dashboard', 'as'=>'dashboard.'], function (){

        // Dashboard Routes
        Route::get('index', [DashboardController::class, 'index'])->name('welcome');

        // User Routes
        Route::group(['prefix'=> 'users', 'as' => 'users.'], function(){
            Route::controller(UserController::class)->group(function (){
                Route::get('/', 'index')
                    ->name('index')
                    ->middleware('permission:read_users');

                Route::get('/create', 'create')
                    ->name('create')
                    ->middleware('permission:create_users');

                Route::post('store','store')->name('store');
                Route::get('edit/{user}', [UserController::class, 'edit'])
                    ->name('edit')
                    ->middleware('permission:update_users');

                Route::put('update/{user}', 'update')->name('update');

                Route::delete('destroy/{user}', 'destroy')
                    ->name('destroy')
                    ->middleware('permission:delete_users');
            }); // end of controller

        }); // end of user Routes


        // Category Routes
        Route::group(['prefix'=> 'categories', 'as'=> 'categories.'], function(){
            Route::controller(CategoryController::class)->group(function(){

                Route::get('/', 'index')
                    ->name('index')
                    ->middleware('permission:read_categories');

                Route::get('create', 'create')
                    ->name('create')
                    ->middleware('permission:create_categories');

                Route::post('store', 'store')->name('store');

                Route::get('edit/{category}', 'edit')
                    ->name('edit')
                    ->middleware('permission:update_categories');

                Route::put('update/{category}', 'update')->name('update');

                Route::delete('destroy/{category}', 'destroy')
                    ->name('destroy')
                    ->middleware('permission:delete_categories');
            }); // end of controller


        }); // end of category routes



        // Product Routes

        Route::group(['prefix'=> 'products', 'as'=>'products.'], function(){

            Route::controller(ProductController::class)->group(function (){

                Route::get('/','index')
                    ->name('index')
                    ->middleware('permission:read_products');

                Route::get('create', 'create')
                    ->name('create')
                    ->middleware('permission:create_products');

                Route::post('store', 'store')->name('store');

                Route::get('edit/{product}', 'edit')
                    ->name('edit')
                    ->middleware('permission:update_products');

                Route::put('update/{product}',  'update')->name('update');

                Route::delete('destroy/{product}', 'destroy')
                    ->name('destroy')
                    ->middleware('permission:delete_products');
            }); // end of controller


        }); // end of product routes


         // Client Routes

         Route::group(['prefix'=> 'clients', 'as'=>'clients.'], function(){

             Route::controller(ClientController::class)->group(function(){

                 Route::get('/', 'index')
                     ->name('index')
                     ->middleware('permission:read_clients');

                 Route::get('create', 'create')
                     ->name('create')
                     ->middleware('permission:create_clients');

                 Route::post('store', 'store')->name('store');

                 Route::get('edit/{client}', 'edit')
                     ->name('edit')
                     ->middleware('permission:update_clients');

                 Route::put('update/{client}', 'update')->name('update');

                 Route::delete('destroy/{client}', 'destroy')
                     ->name('destroy')
                     ->middleware('permission:delete_clients');
             }); // end of controller


        }); // end of client routes

        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function (){

            Route::controller(OrderController::class)->group(function(){

                Route::get('/', 'index')
                    ->name('index')
                    ->middleware('permission:read_orders');

                Route::get('create/{client}', 'create')
                    ->name('create')
                    ->middleware('permission:create_orders');

                Route::post('store', 'store')
                    ->name('store');

                Route::get('edit/{client}/{order}','edit')
                    ->name('edit')
                    ->middleware('permission:update_orders');

                Route::put('update/{client}/{order}', 'update')->name('update');

                Route::delete('destroy/{client}/{order}', 'destroy')
                    ->name('destroy')
                    ->middleware('permission:delete_orders');
            }); // end of controller


        }); // end of order routes



    }); // end of dashboard routes



}); // End of Group
