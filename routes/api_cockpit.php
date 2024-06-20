<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APICockpit\TreeController;
use App\Http\Controllers\APICockpit\SettingController;
use App\Http\Controllers\APICockpit\TreeTypeController;

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

Route::controller(SettingController::class)
    ->prefix('setting')
    ->group(
        function () {
            Route::get('/', 'index');
        }
    );

Route::controller(TreeController::class)
    ->prefix('trees')
    ->group(
        function () {
            Route::post('/upload_image', 'upload_image_tree');
            Route::post('/', 'create_tree');
        }
    );

Route::controller(TreeTypeController::class)
    ->prefix('tree_types')
    ->group(
        function () {
            Route::post('/', 'create_tree_type');
            Route::put('/', 'update_tree_type');
            Route::get('/', 'get_tree_type');
            Route::get('/{id}', 'get_tree_type_by_id');
        }
    );
