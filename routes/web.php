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
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('campaigns', [CampaignsController::class, 'index'])->name('campaigns');
    Route::get('payment-methods', [PaymentMethodsController::class, 'index'])->name('payment-methods');
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('organizations', [OrganizationsController::class, 'index'])->name('organizations');
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
