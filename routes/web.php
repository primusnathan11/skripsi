<?php

use App\Http\Controllers\QrController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UKMController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceControlller;
use App\Http\Controllers\WebTransactionController;
use App\Http\Controllers\PlantingController;
use App\Http\Controllers\TreetypeController;
use App\Http\Controllers\TagController;
use App\Models\WebTransaction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/haloo', function () {
    $c = 3 > 7;
    print_r($c);
    echo "haloo";
});

Route::get('/qrcode', [QrController::class, 'index']);
Route::get('/qrcode-convert', [QrController::class, 'convert']);


// Route::get('', [UserController::class, 'index']);


Route::prefix('dashboard')
    ->controller(DashboardController::class)
    ->group(function (){
        Route::get('/','index');
    });







Route::prefix('payment')
    ->controller(WebTransactionController::class)
    ->group(function (){
        Route::get('/manage','getManage');
        Route::get('/add','add');
        Route::post('/store', 'checkout')->name('store.payment');
        Route::post('/save-transaction', 'saveTransaction');
        Route::get('/running/{id}', 'running');
        Route::post('/get-status', 'getStatus');
        // Route::delete('/destroy', 'destroy')->name('destroy.donation');
    });

// Route::prefix('newsletter')
//     ->controller(NewsController::class)
//     ->group(function (){
//         Route::get('/','index')->name('news');
//         Route::get('/add','add');
//         Route::get('/edit/{id}','edit')->name('edit.news');
//         Route::put('/edit/{id}','update')->name('update.news');
//         Route::post('/store', 'store')->name('store.news');
//         Route::delete('/{id}','destroy')->name('delete.news');
//     });





Route::controller(LandingController::class)
    ->group(function (){
        Route::get('/','index');
        Route::get('/news/{id}', 'detailNews')->name('detail.news');
        Route::get('/blog','getBlog')->name('get.blog');
        Route::get('/blog/{id}','detailNews')->name('detail.blog');
    });

Route::controller(AboutController::class)
    ->group(function (){
        Route::get('/about','index');

    });
Route::controller(DonateController::class)
    ->group(function (){
        Route::get('/donate','index');
        Route::get('/donate/{id}', 'detail');
        Route::get('/donate-payment/{id}', 'payment');
    });
Route::controller(ArtikelController::class)
    ->group(function (){
        Route::get('/artikel','index');
    });
Route::controller(ContactController::class)
    ->group(function (){
        Route::get('/contact','index');
    });
Route::controller(ServiceControlller::class)
    ->group(function (){
        Route::get('/service','index');
    });
Auth::routes();

Route::get('/confirm-password', function () {
    return view('login');
    })->middleware('auth');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::middleware(['auth', 'creator'])->prefix('newsletter')->controller(NewsController::class)->group(function (){
        Route::get('/','index')->name('news');
        Route::get('/add','add');
        Route::get('/edit/{id}','edit')->name('edit.news');
        Route::put('/edit/{id}','update')->name('update.news');
        Route::post('/store', 'store')->name('store.news');
        Route::get('/generate', 'generate_news')->name('generate.news');
        Route::delete('/{id}','destroy')->name('delete.news');
});
Route::middleware(['auth', 'staff'])->group(function (){
    Route::prefix('partner')
    ->controller(PartnerController::class)
    ->group(function (){
        Route::get('/','index');
    });
    Route::prefix('company')
    ->controller(CompanyController::class)
    ->group(function (){
        Route::get('/accounts','getAccount')->name('company');
        Route::get('/accounts/add','add')->name('add.company');
        Route::post('/accounts/store','store')->name('store.company');
        Route::get('/accounts/edit/{id}','edit')->name('edit.company');
        Route::put('/accounts/edit/{id}','update')->name('update.company');
        Route::delete('/accounts/{id}','destroy')->name('delete.company');
        Route::get('/projects','getProject')->name('projects');
        Route::get('/projects/add','addProject')->name('add.projects');
        Route::post('/projects/store','storeProject')->name('store.projects');
        Route::get('/projects/edit/{id}','editProject')->name('edit.projects');
        Route::put('/projects/edit/{id}','updateProject')->name('update.projects');
        Route::delete('/projects/{id}','destroyProject')->name('delete.projects');
    });
    Route::prefix('donation')
    ->controller(DonationController::class)
    ->group(function (){
        Route::get('/manage','getManage')->name('get.manage');
        Route::get('/manage/add','add');
        Route::get('/manage/edit/{id}','edit')->name('edit.donation');
        Route::put('/manage/edit/{id}','update')->name('update.donation');
        Route::get('/manage','getManage');
        Route::get('/transaction','getTransaction')->name('get.transaction');
        Route::get('/add','add');
        Route::post('/store', 'store')->name('store.donation');
        Route::post('/filtered', 'filter')->name('filter.donation');
        Route::get('/detail/{id}','getDetail')->name('get.detail');
        Route::put('/update_publish/{id}','update_publish')->name('update.publish');
        Route::put('/update_unpublish/{id}','update_unpublish')->name('update.unpublish');
        Route::put('/update_enable/{id}','update_enable')->name('update.enable.donation');
        Route::put('/update_disable/{id}','update_disable')->name('update.disable.donation');
        Route::delete('/manage/{id}', 'destroy')->name('destroy.donation');

        Route::get('/activity/{id}','getActivity')->name('get.activity');
        Route::get('/activity/add/{id}','addActivity');
        Route::post('/activity/store', 'storeActivity')->name('store.activity');
        Route::get('/activity/edit/{id}','editActivity')->name('edit.activity');
        Route::put('/activity/update/{id}','updateActivity')->name('update.activity');
        Route::get('/activity/sendActivity/{id}/{id_activity}','sendEmail')->name('send.activity');
        Route::delete('/activity/destroy/{id}', 'destroyActivity')->name('destroy.activity');

    });
    Route::prefix('ukm')
    ->controller(UKMController::class)
    ->group(function (){
        Route::get('/','index')->name('ukm');
        Route::get('/add','add');
        Route::post('/store', 'store')->name('store.ukm');
        Route::delete('/{id}','destroy')->name('delete.ukm');
        Route::get('/edit/{id}','edit')->name('edit.ukm');
        Route::put('/edit/{id}','update')->name('update.ukm');
        Route::put('/update_enable/{id}','update_enable')->name('ukm.enable');
        Route::put('/update_disable/{id}','update_disable')->name('ukm.disable');

    });
    Route::prefix('location')
    ->controller(LocationController::class)
    ->group(function (){
        Route::get('/','index')->name('location');
        Route::get('/indexDisabled','indexDisabled')->name('indexDisabled');
        Route::get('/add','add');
        Route::post('/store', 'store')->name('store.location');
        Route::delete('/{id}','destroy')->name('delete.location');
        Route::get('/edit/{id}','edit')->name('edit.location');
        Route::put('/edit/{id}','update')->name('update.location');
        Route::put('/update_enable/{id}','update_enable')->name('update.enable');
        Route::put('/update_disable/{id}','update_disable')->name('update.disable');
    });

Route::prefix('tag')
    ->controller(TagController::class)
    ->group(function (){
        Route::get('/','add')->name('tag');
        Route::post('/print','print')->name('print');
    });
    Route::prefix('plantingpartner')
    ->controller(PlantingController::class)
    ->group(function (){
        Route::get('/','index')->name('plantingpartner');
        Route::get('/add','add');
        Route::get('/edit/{id}','edit')->name('edit.plantingpartner');
        Route::put('/edit/{id}','update')->name('update.plantingpartner');
        Route::post('/store', 'store')->name('store.partner');
        Route::delete('/{id}','destroy')->name('delete.plantingpartner');
        Route::put('/update_enable/{id}','update_enable')->name('plantingpartner.enable');
        Route::put('/update_disable/{id}','update_disable')->name('plantingpartner.disable');
});
Route::prefix('treetype')
    ->controller(TreetypeController::class)
    ->group(function (){
        Route::get('/','index')->name('treetype');
        Route::get('/add','add');
        Route::get('/edit/{id}','edit')->name('edit.treetype');
        Route::put('/edit/{id}','update')->name('update.treetype');
        Route::post('/store', 'store')->name('store.treetype');
        Route::delete('/{id}','destroy')->name('delete.treetype');
        Route::put('/update_enable/{id}','update_enable')->name('enable.treetype');
        Route::put('/update_disable/{id}','update_disable')->name('disable.treetype');
});
    });

    Route::middleware(['auth', 'admin'])->prefix('user')->controller(UserController::class)->group(function (){
        Route::get('/','index')->name('user');
        Route::get('/add','add');
        Route::get('/edit/{id}','edit')->name('edit.user');
        Route::put('/edit/{id}','update')->name('update.user');
        Route::post('/store', 'store')->name('store.user');
        Route::delete('/{id}','destroy')->name('delete.user');
});
