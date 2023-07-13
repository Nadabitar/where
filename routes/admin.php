<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\{
    BannerController,
    BrandController,
    CategorisController,
    PlacesController,
};
// Route::Post('/logout' , [LoginController::class , 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::post('/login', [AdminController::class, 'store'])->name('adminLoginPost');

    Route::group(['middleware' => 'adminAuth'], function () {
        Route::get('/admin', [AdminController::class , 'index'] )->name('admin');

    });
});

Route::group(['middleware' => ['auth'] , 'prifex' => 'admin'] , function(){

    //Section Banner--------------------------------------
    Route::prefix('region')->controller(RegionController::class)->group(function () {
        Route::get('/' ,  'show')->name('region.All');
        Route::get('/show_craete_page' ,  'create')->name('region.Add');
        Route::post('/store' ,  'store')->name('region.store');
        Route::post('/status' , 'regionStatus')->name('region.status');
        Route::get('/region_edit/{id}' , 'edit')->name('region.edit');
        Route::Post('/region_update/{id}' , 'update')->name('region.update');
        Route::get('/region_delete/{id}' , 'destroy')->name('region.delete');
    });


    //Section category--------------------------------------
    Route::prefix('category')->controller(CategorisController::class)->group(function () {
        Route::get('/' , [CategorisController::class ,  'show'])->name('category.All');
        Route::get('/show_craete_page' , [CategorisController::class ,  'create'])->name('category.Add');
        Route::post('/store' , [CategorisController::class ,  'store'])->name('category.store');
        Route::post('/status' , [CategorisController::class , 'categoyStatus'])->name('category.status');
        Route::get('/category_edit/{id}' , [CategorisController::class , 'edit'])->name('category.edit');
        Route::Post('/category_update/{id}' , [CategorisController::class , 'update'])->name('category.update');
        Route::get('/category_delete/{id}' , [CategorisController::class , 'destroy'])->name('category.delete');

        Route::post('/{id}/child', 'getChildByParentId')->name('category.child.By.Parent');
    });
     //Section Brand--------------------------------------
    Route::prefix('brand')->controller(BrandController::class)->group(function () {
        Route::get('/' ,  'index')->name('brand.All');
        Route::get('/show_craete_page' ,  'show')->name('brand.Add');
        Route::post('/store' ,  'store')->name('brand.store');
        Route::post('/status' , 'brandStatus')->name('brand.status');
        Route::get('/brand_edit/{id}' , 'edit')->name('brand.edit');
        Route::Post('/brand_update/{id}' , 'update')->name('brand.update');
        Route::get('/brand_delete/{id}' , 'destroy')->name('brand.delete');
    });

     //Section Product--------------------------------------
    Route::prefix('Place')->group(function () {
        Route::get('/' ,  [PlacesController::class,'show'])->name('Place.All');
        Route::get('/show_craete_page' ,  [PlacesController::class,'create'])->name('Place.Add');
        // Route::post('/store' , [PlacesController::class, 'store'])->name('Place.store');
        Route::post('/status' , [PlacesController::class,'placeStatus'])->name('Place.status');
        Route::get('/place_edit/{id}' , [PlacesController::class,'edit'])->name('Place.edit');
        Route::Post('/place_update/{id}' , [PlacesController::class,'update'])->name('Place.update');
        Route::get('/place_delete/{id}' ,[PlacesController::class, 'destroy'])->name('Place.delete');
        Route::get('/view/place/{id}' , [PlacesController::class, 'view'])->name('Place.view');
    });

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/' ,  'index')->name('users.All');
        Route::get('/show_craete_page' ,  'show')->name('users.Add');
        Route::post('/store' ,  'store')->name('users.store');
        Route::post('/status' , 'usersStatus')->name('users.status');
        Route::get('/users_edit/{id}' , 'edit')->name('users.edit');
        Route::Post('/users_update/{id}' , 'update')->name('users.update');
        Route::get('/users_delete/{id}' , 'destroy')->name('users.delete');
        Route::get('/view/users/{id}' ,  'view')->name('users.view');
    });
});


// Route::get('/notFound' , function ()
// {
//     return view('errors.404');
// })->name('404');

