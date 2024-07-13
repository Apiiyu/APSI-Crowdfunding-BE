<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CampaignController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    /*
    |--------------------------------------------------------------------------
    | Master Data Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'master-data'], function () {
        /*
        |--------------------------------------------------------------------------
        | Campaigns Routes
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'campaigns'], function () {
            Route::get('/', [CampaignController::class, 'index']);
            Route::get('/{id}', [CampaignController::class, 'show']);
            Route::post('/', [CampaignController::class, 'store']);
            Route::put('/{id}', [CampaignController::class, 'update']);
            Route::delete('/{id}', [CampaignController::class, 'destroy']);
        });

        /*
        |--------------------------------------------------------------------------
        | Categories Routes
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{id}', [CategoryController::class, 'show']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });

        /*
        |--------------------------------------------------------------------------
        | Organizations Routes
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'organizations'], function () {
            Route::get('/', [OrganizationController::class, 'index']);
            Route::get('/{id}', [OrganizationController::class, 'show']);
            Route::post('/', [OrganizationController::class, 'store']);
            Route::put('/{id}', [OrganizationController::class, 'update']);
            Route::delete('/{id}', [OrganizationController::class, 'destroy']);
        });

        /*
        |--------------------------------------------------------------------------
        | Users Routes
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/profile', [UserController::class, 'profile']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::post('/', [UserController::class, 'store']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Invoices Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', [InvoiceController::class, 'index']);
        Route::get('/{id}', [InvoiceController::class, 'show']);
        Route::post('/', [InvoiceController::class, 'store']);
        Route::put('/{id}', [InvoiceController::class, 'update']);
        Route::delete('/{id}', [InvoiceController::class, 'destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| Campaigns Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'campaigns'], function () {
    Route::get('/', [CampaignController::class, 'index']);
    Route::get('/{id}', [CampaignController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Categories Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Organizations Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'organizations'], function () {
    Route::get('/', [OrganizationController::class, 'index']);
    Route::get('/{id}', [OrganizationController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Invoices Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'invoices'], function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::get('/{id}', [InvoiceController::class, 'show']);
});