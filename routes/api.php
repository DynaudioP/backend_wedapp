<?php

use App\Http\Controllers\Api\V1\CateringController;
use App\Http\Controllers\Api\V1\OrganizersController;
use App\Http\Controllers\Api\V1\VenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// php artisan serve --host=192.168.1.4 --port=8000

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// V1 Routes
Route::prefix('v1')->group(function () {
    Route::get('/venue', [VenueController::class, 'index']);
    Route::get('/venue/all', [VenueController::class, 'getAll']);
    Route::get('/venue/search/{name}',[VenueController::class, 'search']);
    Route::post('/venue', [VenueController::class, 'store']);
    Route::get('/organizers', [OrganizersController::class, 'index']);
    Route::get('/catering', [CateringController::class, 'index']);
});
