<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['userLogin']], function () {
    //admin
    Route::group(['middleware' => 'authAdmin', 'prefix'=> 'admin'], function () {
        
    });

    //user
    Route::group(['middleware'=> 'authUser', 'prefix' => 'user'], function () {
        
    });
});

Route::get('/', HomeComponent::class)->name('home.index');

require __DIR__.'/auth.php';
