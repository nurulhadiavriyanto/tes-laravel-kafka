<?php

use App\Http\Controllers\Api\ClubController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('club')->name('club')->group(function () {
    Route::get('/', [ClubController::class, 'get'])->name('get');
    Route::post('/', [ClubController::class, 'create'])->name('create');
});