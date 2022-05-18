<?php


use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::group(['middleware'=>'auth','prefix'=>'dashboard', 'as'=>'dashboard.'], function (){

        // Dashboard Routes
        Route::get('index', [DashboardController::class, 'index'])->name('welcome');

        // Users Routes
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index')
            ->middleware('permission:read_users');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create')
            ->middleware('permission:create_users');

        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit'])
            ->name('users.edit')
            ->middleware('permission:update_users');

        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');

        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy')
            ->middleware('permission:delete_users');

    }); // end of dashboard routes



}); // End of Group
