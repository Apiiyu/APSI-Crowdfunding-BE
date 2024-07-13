<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'authentication'], function () {
  Route::get('login', [AuthController::class, 'index'])->name('login');
  Route::get('register', [AuthController::class, 'register'])->name('register');
  Route::post('login', [AuthController::class, 'login'])->name('login.action');
});


Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::get('/', [StaterkitController::class, 'home'])->name('home');
  Route::get('home', [StaterkitController::class, 'home'])->name('home');

  /*
  |--------------------------------------------------------------------------
  | Master Data Routes
  |--------------------------------------------------------------------------
  */
  Route::group(['prefix' => 'master-data'], function () {
    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'users'], function () {
      Route::get('/', [UserController::class, 'index'])->name('users.index');
      Route::get('/{id}', [UserController::class, 'show']);
      Route::post('/', [UserController::class, 'store'])->name('users.store');
      Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
      Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.delete');
    })->name('users');

    /*
    |--------------------------------------------------------------------------
    | Campaigns Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'campaigns'], function () {
      Route::get('/', [CampaignsController::class, 'index'])->name('campaigns.index');
      Route::get('/{id}', [CampaignsController::class, 'show']);
      Route::post('/', [CampaignsController::class, 'store'])->name('campaigns.store');
      Route::put('/{id}', [CampaignsController::class, 'update'])->name('campaigns.update');
      Route::delete('/{id}', [CampaignsController::class, 'destroy'])->name('campaigns.delete');
    })->name('campaigns');

    /*
    |--------------------------------------------------------------------------
    | Categories Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'categories'], function () {
      Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
      Route::get('/{id}', [CategoriesController::class, 'show']);
      Route::post('/', [CategoriesController::class, 'store'])->name('categories.store');
      Route::put('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
      Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.delete');
    })->name('categories');

    /*
    |--------------------------------------------------------------------------
    | Organizations Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'organizations'], function () {
      Route::get('/', [OrganizationsController::class, 'index']);
      Route::get('/{id}', [OrganizationsController::class, 'show']);
      Route::post('/', [OrganizationsController::class, 'store'])->name('organizations.store');
      Route::put('/{id}', [OrganizationsController::class, 'update'])->name('organizations.update');
      Route::delete('/{id}', [OrganizationsController::class, 'destroy'])->name('organizations.delete');
    })->name('organizations');

    /*
    |--------------------------------------------------------------------------
    | Payment Methods Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'payment-methods'], function () {
      Route::get('/', [PaymentMethodsController::class, 'index']);
      Route::get('/{id}', [PaymentMethodsController::class, 'show']);
      Route::post('/', [PaymentMethodsController::class, 'store'])->name('payment-methods.store');
      Route::put('/{id}', [PaymentMethodsController::class, 'update'])->name('payment-methods.update');
      Route::delete('/{id}', [PaymentMethodsController::class, 'destroy'])->name('payment-methods.delete');
    })->name('payment-methods');

  });

  /*
  |--------------------------------------------------------------------------
  | Invoices Routes
  |--------------------------------------------------------------------------
  */
  Route::group(['prefix' => 'invoices'], function () {
    Route::get('/', [InvoicesController::class, 'index'])->name('invoices');
    Route::get('show/{id}', [InvoicesController::class, 'show'])->name('invoices.show');
    Route::get('print/{id}', [InvoicesController::class, 'print'])->name('invoices.print');
  });
});

// Route Components
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
