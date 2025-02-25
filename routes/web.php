<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use MasterRO\AccessScreen\Controllers\AccessScreenController;

Route::group([
    'middleware' => config('access-screen.middleware', ['web']),
    'as' => 'access-screen::',
    'prefix' => config('access-screen.uri', 'get-access'),
], function () {

    Route::get('/', [AccessScreenController::class, 'index'])
        ->name('index');

    Route::post('/', [AccessScreenController::class, 'store'])
        ->name('store');
});
