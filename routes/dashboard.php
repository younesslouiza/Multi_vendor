<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashbordController;
use App\Models\Categorie;
use illuminate\Support\Facades\Route;

//create controller 

Route::group([

    'middleware' => ['auth'],
    'as' => 'dashboard.', //name the route is dashboard/..../...
    'prefix' => 'dashboard', // replace dashboard/categories to /categories

], 
function () {

    Route::get('/profile',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');


    Route::get('/', [DashbordController::class, 'index'])
        ->name('dashboard');

    Route::get('/categories/trash',[CategoriesController::class, 'trash'])
        ->name('categories.trash');

    Route::put('/categories/{category}/restore',[CategoriesController::class, 'restore'])
        ->name('categories.restore');

    Route::delete('/categories/{category}/force-delete',[CategoriesController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::resource('/categories', CategoriesController::class);

    Route::resource('/products', ProductsController::class);

    
});

/*
Route::middleware('auth')
    ->as('dashboard.')
    ->prefix('dashboard')
    ->group(function(){
        Route::get('/', [DashbordController::class, 'index'])
        ->name('dashboard');

        Route::resource('/categories', CategoriesController::class);
});
*/
