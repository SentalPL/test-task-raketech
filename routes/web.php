<?php

use App\Http\Controllers\Api\CountriesApiController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'api',
], function () {
    Route::get('/countries', [CountriesApiController::class, 'all']);
    Route::get('/countries/{name}', [CountriesApiController::class, 'one']);
});

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');
