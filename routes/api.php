<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\AttributionController;

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

Route::post('register', [UserController::class, 'store']);
Route::post("login", [UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::prefix('computer')->group(function () {
        Route::get("/all/{date}", [ComputerController::class, 'index']);
        Route::post('/', [ComputerController::class, 'store']);
        Route::delete('/{id}', [ComputerController::class, 'destroy']);
    });

    Route::prefix('client')->group(function () {
        Route::get("/all", [ClientController::class, 'index']);
        Route::post('/', [ClientController::class, 'store']);
    });

    Route::prefix('attribution')->group(function () {
        Route::get("/", [AttributionController::class, 'index']);
        Route::post("/", [AttributionController::class, 'store']);
        Route::delete('/{id}', [AttributionController::class, 'destroy']);
    });

    Route::get("logout", [UserController::class, 'logout']);
});
