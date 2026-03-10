<?php

use App\Http\Controllers\Api\CountriesApiController;
use Illuminate\Support\Facades\Route;

Route::get('/countries', [CountriesApiController::class, 'all']);
Route::get('/countries/{name}', [CountriesApiController::class, 'one']);
