<?php


use App\Http\Controllers\StatusesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboards',[DashboardsController::class,'index'])->name('home');

Route::resource('/statuses',StatusesController::class);