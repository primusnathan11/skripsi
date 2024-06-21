<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\TreeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CarbonController;
use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TransactionController;

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

/**
 * HEALTH CHECK
 */
Route::get('/health', function () {
    return response()->json(['status' => 'OK']);
});

/**
 * AUTH ROUTES
 */
Route::controller(UserController::class)
    ->prefix('auth')
    ->group(
        function () {
            Route::post('/login', 'login');
            Route::post('/register', 'register');
        }
    );

Route::controller(UserController::class)
    ->middleware('auth.jwt')
    ->prefix('auth')
    ->group(
        function () {
            Route::get('/refresh', 'refresh');
            Route::post('/logout', 'logout');
        }
    );

/**
 * USER ROUTES
 */
Route::controller(UserController::class)
    ->middleware('auth.jwt')
    ->prefix('users')
    ->group(
        function () {
            Route::get('/', 'detail');
            Route::get('/detail_distribute_trees', 'getDetailDistributeTrees');
            Route::put('/', 'update');
            Route::put('/edit_password', 'edit_password');
        }
    );

/**
 * CARBON ROUTES
 */
Route::controller(CarbonController::class)
    ->middleware('auth.jwt')
    ->prefix('carbon')
    ->group(
        function () {
            Route::get('/calculator/type', 'get_item_calculator');
            Route::post('/calculator', 'count_carbon_offset');
            Route::get('/', 'carbon_detail');
        }
    );

/**
 * PROJECTS ROUTES
 */
Route::controller(ProjectController::class)
    ->middleware('auth.jwt')
    ->prefix('projects')
    ->group(
        function () {
            Route::get('/', 'getProjectsUser');
            Route::get('/{id}', 'getDetailProject');
        }
    );

/**
 * PRODUCT ROUTES
 */
Route::controller(ProductController::class)
    ->middleware('auth.jwt')
    ->prefix('products')
    ->group(
        function () {
            Route::get('/adopt', 'product_adopt');
            Route::get('/planting', 'product_planting');
            Route::get('/adopt/{id}', 'adopt_detail');
            Route::get('/planting/{id}', 'planting_detail');
        }
    );

/**
 * NEWS ROUTES
 */
Route::controller(NewsController::class)
    ->middleware('auth.jwt')
    ->prefix('news')
    ->group(
        function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'detail');
            Route::post('/store', 'store');
        }
    );

/**
 * TREE ROUTES
 */
Route::controller(TreeController::class)
    ->middleware('auth.jwt')
    ->prefix('trees')
    ->group(
        function () {
            Route::get('/', 'get_tree_user');
            Route::get('/{id}', 'get_detail_tree');
            Route::get('/scan/{code}', 'getDetailTreeFromCode');
        }
    );

/**
 * TRANSACTION ROUTES
 */
Route::middleware('auth.jwt')
    ->controller(TransactionController::class)
    ->prefix('transactions')
    ->group(
        function () {
            // Transaction
            Route::get('/', 'index');
            Route::get('/{id}', 'get_detail');
            Route::get('/payment_methods', 'get_payment_method');
            Route::post('/adopt', 'adopt');
            Route::post('/planting', 'store_planting');

            // Reedem Code
            Route::get('/redeem_code/{code}', 'redeem_code');
            Route::post('/redeem_code', 'use_voucher');
        }
    );

/**
 * Notification
 */
Route::prefix('notifications')
    ->controller(NotificationController::class)
    ->group(function () {
        Route::post("payment", 'payment');
    });

    /**
 * Donations
 */
Route::prefix('donations')
    ->controller(DonationController::class)
    ->group(function () {
        Route::get("/", 'index');
        Route::get("/{id}", 'get_detail_donation');
    });
