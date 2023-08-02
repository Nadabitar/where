<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    CategorisController,
    CommentController,
    PlacesController,
    PromoController,
    RegionController,
    MapController,
    ServiceController,
    UserController,
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
        Route::Post('/service/update/{id}' , [serviceController::class , 'update'])->name('Service.update');
        Route::get('/service/delete/{id}' , [serviceController::class , 'destroy'])->name('Service.delete');
        Route::get('/new/{id}' , [serviceController::class , 'newService'])->name('Service.new');
        Route::get('/unactive/{id}' , [serviceController::class , 'unActiveService'])->name('Service.unActive');
        Route::get('/status' , [serviceController::class , 'serviceStatus'])->name('Service.status');
        Route::post('/search/name' , [CommentController::class , 'searchServices'])->name('Service.search');
    });

    Route::prefix('Advertising')->controller(PromoController::class)->group(function ()
    {
        Route::get('/page' , [PromoController::class , 'index'])->name('Advertising');
        Route::post('/save/{id}' , [PromoController::class , 'store'])->name('Advertising.save');
        Route::get('/drop/{id}' , [PromoController::class , 'index'])->name('Advertising.drop');
    });

    
    Route::prefix('comments')->controller(PromoController::class)->group(function ()
    {
        Route::get('/All/{id}' , [CommentController::class , 'getCommetsForPlaces'])->name('Comments.All');
        Route::post('/search/name' , [CommentController::class , 'searchCommentsByName'])->name('Comments.search');
    });

    Route::prefix('profile')->controller(PromoController::class)->group(function ()
    {
        Route::get('/show' , [UserController::class , 'show'])->name('Profile.show');
        Route::get('/update/Image' , [UserController::class , 'updateImage'])->name('Profile.update.Image');
        Route::get('/update/PlaceName' , [UserController::class , 'updatePlaceName'])->name('Profile.update.placeName');
        Route::get('/update/PhoneNumber' , [UserController::class , 'updatePhoneNumber'])->name('Profile.update.phoneNumber');
        Route::get('/update/Details' , [UserController::class , 'updateDetails'])->name('Profile.update.Details');
        Route::get('/update/WorkTime' , [UserController::class , 'updateWorkTime'])->name('Profile.update.workTime');
        Route::get('/update/Links' , [UserController::class , 'updateLinks'])->name('Profile.update.links');
        Route::get('/update/category' , [UserController::class , 'updateCategory'])->name('Profile.update.category');
        Route::get('/update/subCategor' , [UserController::class , 'updateSubCategor'])->name('Profile.update.subCategory');
    });
});

Route::get('/map',  [MapController::class , 'index']);
