<?php


use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['prefix'=>'dashboard', 'as'=>'dashboard.'], function (){
        Route::get('index', [DashboardController::class, 'index'])->name('welcome');
    }); // end of dashboard_files routes

});
