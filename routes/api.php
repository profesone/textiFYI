<?php

use App\Http\Controllers\Api\V1\Admin\ClientApiController;
use App\Http\Controllers\Api\V1\Admin\KeywordApiController;
use App\Http\Controllers\Api\V1\Admin\TextifyiNumberApiController;
use App\Http\Controllers\Api\V1\Admin\TextResponseApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Textifyi Numbers
    Route::apiResource('textifyi-numbers', TextifyiNumberApiController::class);

    // Client
    Route::apiResource('clients', ClientApiController::class);

    // Keywords
    Route::apiResource('keywords', KeywordApiController::class, ['only' => ['index']]);

    // Text Response
    Route::apiResource('text-responses', TextResponseApiController::class);
});
