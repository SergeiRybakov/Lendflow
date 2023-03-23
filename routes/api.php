<?php

use App\Http\Controllers\Api\v1\NewYorkTimesController as NytControllerV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('1')
    ->group(function () {
        Route::prefix('nyt')
            ->group(function () {
                Route::get('best-sellers', [NytControllerV1::class, 'actionGet']);
            });
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
