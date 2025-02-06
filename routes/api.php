<?php

use App\Http\Controllers\Music\GenreController;
use App\Http\Controllers\Music\InterpreterController;
use App\Http\Controllers\Music\MusicController;
use App\Http\Controllers\Music\StyleController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Service\ServiceMusicController;
use App\Http\Controllers\Service\ServiceTypeController;
use App\Models\Service\ServiceMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

function crudApi($route, $class)
{
    $pathRoute = '/' . $route;
    $idRoute = $pathRoute . '/{id}';

    Route::post($pathRoute, [$class, 'index'])->middleware('auth:api');
    Route::get($idRoute, [$class, 'id'])->middleware('auth:api');
    Route::put($pathRoute, [$class, 'save'])->middleware('auth:api');
    Route::delete($idRoute, [$class, 'delete'])->middleware('auth:api');
}

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

foreach ($folders as $prefix => $routes) {

    Route::group([
        'middleware' => 'api',
        'prefix' => $prefix
    ], function () use ($routes) {
        foreach ($routes as $route => $class) {
            crudApi($route, $class);
        }
    });
}
