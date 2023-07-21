<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    CategorisController,
    PlacesController,
    PromoController,
    RegionController,
    ServiceController,  
    MapController
};

use App\Http\Controllers\subscriber\SubscriberController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/info', [HomeController::class, 'index'])->middleware('auth')->name('info');
Route::get('/dashboard' , [SubscriberController::class , 'index'])->middleware('auth')->name('subscriber.dashboard');
Auth::routes();


Route::prefix('subscriber')->group(function(){
    Route::post('/category/{id}' , [CategorisController::class , 'get_cat_by_parent'] );
    Route::post('/region/{id}' , [RegionController::class , 'get_street_by_region'] );
    Route::post('/place/add' , [PlacesController::class , 'store'])->name('Place.store');

    Route::prefix('service')->controller(serviceController::class)->group(function(){
        Route::get('/service/page' , [serviceController::class , 'index'])->name('Service.all');
        Route::get('/service/show' , [serviceController::class , 'show'])->name('Service.show');
        Route::post('/service/form/{id}' , [serviceController::class , 'store'])->name('Service.store');
        Route::get('/service/show/update/{id}' , [serviceController::class , 'edit'])->name('Service.show.update.form');
        Route::get('/service/update/{id}' , [serviceController::class , 'edit'])->name('Service.update');
        Route::get('/service/delete/{id}' , [serviceController::class , 'destroy'])->name('Service.delete');
    });

    Route::prefix('Advertising')->controller(PromoController::class)->group(function ()
    {
        Route::get('/page' , [PromoController::class , 'index'])->name('Advertising');
        Route::post('/save/{id}' , [PromoController::class , 'store'])->name('Advertising.save');
        Route::get('/drop/{id}' , [PromoController::class , 'index'])->name('Advertising.drop');
    });
});

Route::get('/map',  [MapController::class , 'index'])->name('map');
