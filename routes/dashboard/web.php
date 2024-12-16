<?php
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DetailsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SubcategoryController;
use App\Http\Controllers\Dashboard\SubSubcategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Category\CategoryController;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
Route::middleware('auth')->prefix('dashdoard')->name('dashboard.')->group(function () {

  Route::get('check/', [DashboardController::class, 'index'])->name('index');


  //CategoryRoutes
//   Route::resource('categories',CategoryController::class)->except('show');



});
});














