<?php

use App\Http\Controllers\GeneralViewController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['web']], function () {
    Route::get('/', [GeneralViewController::class, 'index'])->middleware('user');
    
    Route::get('/login', [GeneralViewController::class, 'login'])->name('login');
    Route::get('/logout', [GeneralViewController::class, 'logout'])->middleware('user');
    Route::get('/{project}', [GeneralViewController::class, 'project'])->middleware('user');
    Route::get('/{project}/{lampu}', [GeneralViewController::class, 'lampu'])->middleware('user');
    
});

