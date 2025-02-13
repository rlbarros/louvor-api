<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Music\GenreController;
use App\Http\Controllers\Music\InterpreterController;
use App\Http\Controllers\Music\MusicController;
use App\Http\Controllers\Music\StyleController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Service\ServiceMusicController;
use App\Http\Controllers\Service\ServiceTypeController;
use Illuminate\Support\Facades\Route;

$folders = [
    'service' => [
        'services' => ServiceController::class,
        'service_types' => ServiceTypeController::class,
        'service_musics' => ServiceMusicController::class
    ],
    'music' => [
        'musics' => MusicController::class,
        'genres' => GenreController::class,
        'styles' => StyleController::class,
        'interpreters' => InterpreterController::class,
    ],
];

function crudApi($route, $class)
{
    $pathRoute = '/' . $route;
    $idRoute = $pathRoute . '/{id}';

    Route::get($pathRoute, [$class, 'index'])->middleware('auth:api');
    Route::get($idRoute, [$class, 'id'])->middleware('auth:api');
    Route::post($pathRoute, [$class, 'save'])->middleware('auth:api');
    Route::delete($idRoute, [$class, 'delete'])->middleware('auth:api');
}

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    //Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    //Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'service'
], function () {
    Route::put('/service_musics', [ServiceMusicController::class, 'suggest'])->middleware('auth:api');
});



foreach ($folders as $prefix => $routes) {

    Route::group([
        'middleware' => 'auth:api',
        'prefix' => $prefix
    ], function () use ($routes) {
        foreach ($routes as $route => $class) {
            crudApi($route, $class);
        }
    });
}
