<?php

use App\Events\placeCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CategorisController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Places;
use Illuminate\Support\Facades\Auth;

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
Route::middleware('auth:sanctum')->prefix('/user')->group( function () {
    // return Auth::user();

    Route::get('/get/all/cat' , [CategorisController::class , 'index']);
    Route::post('/get/child/cat' , [CategorisController::class , 'get_cat_by_parent']);
    Route::get('/get/promo' , [PromoController::class , 'getPromoUrl']);
    Route::post('/searchByPlaceName' , [PlacesController::class , 'searchByPlaceName']);
    Route::post('/searchPlaceByCategory' , [PlacesController::class , 'searchPlaceByCategory']);
    Route::post('/searchByName' , [CategorisController::class , 'searchByName']);
    Route::post('/update/profile' , [UserController::class , 'update']);

    Route::prefix('saved')->group(function(){
        Route::Post('/store' ,  [SavedController::class , 'store']);
        Route::get('/all' ,  [SavedController::class , 'index']);
        Route::post('/is' ,  [SavedController::class , 'userIsSeved']);
        Route::post('/is/service' ,  [SavedController::class , 'userServiceIsSaved']);
        Route::post('/unSaved' ,  [SavedController::class , 'destroy']);
    });
    
    Route::prefix('place')->group(function(){
        Route::post('/get' , [PlacesController::class,'index']);
        Route::post('/get/services' , [ServiceController::class,'getServices']);
        Route::post('/get/byCategory' , [PlacesController::class,'getPlaceByCat']);
        Route::post('/filter' , [PlacesController::class , 'filter']);
        Route::post('/filterByName' , [PlacesController::class , 'filterPlaceName']);
        Route::get('/get/max/rating' , [PlacesController::class , 'getMaxRatingPlace']);
    });

    Route::post('/add/comment' , [CommentController::class , 'store']);
    Route::post('/destroy/comment' , [CommentController::class , 'destroy']);
    Route::post('/update/comment' , [CommentController::class , 'update']);
    Route::post('/get/comment' , [CommentController::class , 'index']);
    Route::get('/all/comment' , [CommentController::class , 'show']);


    Route::prefix('auth')->group(function(){
        Route::get('/change' ,[HomeController::class , 'changePassword']);
        Route::post('/update' ,[HomeController::class , 'updatePassword']);
        Route::post('/logout' , [HomeController::class , 'logout']);
    });
});

Route::prefix('auth')->group(function(){
    Route::post('/login' , [HomeController::class , 'login']);
    Route::post('/logout/{token?}' , [HomeController::class , 'logout']);
    Route::post('/register' , [HomeController::class , 'register']);
});

// Route::post('/uploadimg' ,function(){
//     Places::where('place_id',$id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
// });


Route::get('/get/all/region' , [RegionController::class , 'index']);
Route::post('/get/street' , [RegionController::class , 'get_streets_by_region']);



Route::get('/update' , [PlacesController::class , 'update']);