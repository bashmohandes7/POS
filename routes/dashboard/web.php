<?php


use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'dashboard', 'as'=>'dashboard.'], function (){
    Route::get('index', [DashboardController::class, 'index'])->name('welcome');
}); // end of dashboard_files routes
