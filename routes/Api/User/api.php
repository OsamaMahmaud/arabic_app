<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TermController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\LevelController;
use App\Http\Controllers\User\VideoController;
use App\Http\Controllers\User\PackageController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PrivacyController;
use App\Http\Controllers\User\SectionController;
use App\Http\Controllers\User\InstructionController;
use App\Http\Controllers\User\User_Views_Controller;
use App\Http\Controllers\User\LevelContentController;
use App\Http\Controllers\User\Profile\UserProfileController;
use App\Http\Controllers\User\Profile\ContactMessageController;

 Route::middleware(['auth:api'])->group(function () {

      #----------------------------Start levels----------------------------------------------------------------##
      Route::get('levels', [LevelController::class, 'index'])->middleware('check.package.access');
      #----------------------------Start levels----------------------------------------------------------------##

      #----------------------------Start sections---------------------------------------------------------------##
      Route::get('sections/{level_id}', [SectionController::class, 'index']);
      #----------------------------Start sections---------------------------------------------------------------##

      Route::get('/levels/{level_id}/sections/{type}', [VideoController::class, 'getSectionVideos']);
   
      #----------------------------Start instructions----------------------------------------------------------------##
       Route::get('/instructions', [InstructionController::class, 'index']);
      #----------------------------Start instructions----------------------------------------------------------------##


      #----------------------------Start Profile---------------------------------------------------------------------##
      Route::post('/contact', [ContactMessageController::class, 'store']);

      // Route::post('/change-password', [UserProfileController::class, 'changePassword']);
      Route::get('/profile', [UserProfileController::class, 'show']);

      Route::post('/user/profile', [UserProfileController::class, 'updateProfile']);

      Route::get('/user/profile/show', [UserProfileController::class, 'show']);
     
      Route::post('/user/change-photo', [UserProfileController::class, 'changePhoto'])->middleware('auth:sanctum');

       // About
      Route::get('/about', [AboutController::class, 'index']);

      // Terms
      Route::get('/terms', [TermController::class, 'index']);

      // Privacy
      Route::get('/privacy', [PrivacyController::class, 'index']);

      #----------------------------Start Profile---------------------------------------------------------------------##

      #----------------------------Start Payment --------------------------------------------------------------------##
      Route::post('/payment/process', [PaymentController::class, 'paymentProcess']);
      Route::match(['GET', 'POST'], '/payment/callback', [PaymentController::class, 'callBack']);
      Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
      Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
      #----------------------------End Payment ----------------------------------------------------------------------##

      #----------------------------startr User_Views ---------------------------------------------------------------------##
          // تسجيل مشاهدة فيديو
          Route::post('/videos/view', [User_Views_Controller::class, 'markVideoAsViewed']);

          // عرض نسبه  المشاهدة بواسطة المستخدم
          Route::get('/user-progress', [User_Views_Controller::class, 'getAllLevelsProgress']);

      #----------------------------End User_Views ------------------------------------------------------------------------##
      
 });

 #----------------------------Start Payment -------------------------------------------------------------------------##
 Route::post('/payment/process', [PaymentController::class, 'paymentProcess']);
 Route::match(['GET', 'POST'], '/payment/callback', [PaymentController::class, 'callBack']);
 Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
 Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
 #----------------------------End Payment ---------------------------------------------------------------------------##
 
 #----------------------------Start packages ------------------------------------------------------------------------##

 Route::get('/getpackages', [PackageController::class, 'index']);

 #----------------------------End packages --------------------------------------------------------------------------##


 #----------------------------Start homePage ------------------------------------------------------------------------##
  Route::get('slider', [HomeController::class, 'getSliders']);

  Route::get('intro-video', [HomeController::class, 'getIntroVideo']);

 #----------------------------End homePage --------------------------------------------------------------------------##
 

 
 