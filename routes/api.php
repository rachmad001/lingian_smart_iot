<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers;
use App\Http\Controllers\Be\DataController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [DataController::class, 'login']);

//type => app || project || device || list-devices
Route::get('app/{type}', [DataController::class, 'getApp']);

Route::post('app/project', [DataController::class, 'addProjectApp']);
Route::post('app/device/{project}', [DataController::class, 'addProjectDevice']);
Route::delete('app/{nameProject}', [DataController::class, 'deleteProjectApp']);
