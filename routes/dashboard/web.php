<?php
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomePageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Video_HomeController;
use App\Http\Controllers\Dashboard\InstructionController;
use App\Http\Controllers\Dashboard\Levels\LevelController;
use App\Http\Controllers\Dashboard\Videos\VideosController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
Route::middleware('auth')->prefix('dashdoard')->name('dashboard.')->group(function () {

 #----------------------------Start DashboardRoutes -----------------------------------------------------------------------##
 Route::get('check/', [DashboardController::class, 'index'])->name('index');
 #----------------------------End DashboardRoutes -------------------------------------------------------------------------##

 #----------------------------Start homepageRoutes ------------------------------------------------------------------------##
  Route::resource('homepage',HomePageController::class)->except('show');

  Route::resource('videohome',Video_HomeController::class)->except('show');
 #----------------------------End homepageRoutes --------------------------------------------------------------------------##

 #----------------------------Start LevelsRoutes --------------------------------------------------------------------------##
  Route::resource('levels',LevelController::class)->except('show');
 #----------------------------End LevelsRoutes ----------------------------------------------------------------------------##

  #----------------------------Start VideosRoutes -------------------------------------------------------------------------##
  Route::resource('videos',VideosController::class)->except('show');
 #----------------------------End VideosRoutes ----------------------------------------------------------------------------##

#----------------------------Start instructions --------------------------------------------------------------------##
Route::resource('instructions', InstructionController::class);

#----------------------------End instructions -----------------------------------------------------------------------##




});
});














