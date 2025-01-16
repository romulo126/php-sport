<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\Bot\BallDontLie\BallDontLieService;

use App\Repositories\Sports\Players\Contracts\SportPlayersRepositoryContract;

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

Route::group([
    'namespace' => 'App\Http\Controllers\Api\Users'
], function () {
    Route::post('login', 'LoginController')->name('api.login');
    Route::get('logout', 'LogoutController')->name('api.logout')->middleware('auth:sanctum');
});


Route::group([
    'namespace' => 'App\Http\Controllers\Api\Sports',
    'middleware' => 'auth:sanctum'
], function () {
    Route::group([
        'namespace' => 'Players',
        'prefix' => 'player'
    ], function () {
        Route::get('all', 'GetAllPlayersControll')->name('api.player.all');
        Route::get('id/{id}', 'GetPlayerControll')->name('api.player.get');
        Route::put('id/{id}', 'UpdatePlayerControll')->name('api.player.update');
        Route::post('new', 'CreatePlayerControll')->name('api.player.create');
    });

    Route::group([
        'namespace' => 'Teams',
        'prefix' => 'team'
    ], function () {
        Route::get('all', 'GetAllControll')->name('api.team.all');
        Route::get('id/{id}', 'GetControll')->name('api.team.get');
        Route::put('id/{id}', 'UpdateControll')->name('api.team.update');
        Route::post('new', 'CreateControll')->name('api.team.create');
    });

    Route::group([
        'namespace' => 'Games',
        'prefix' => 'games'
    ], function () {
        Route::get('all', 'GetAllControll')->name('api.game.all');
        Route::get('id/{id}', 'GetControll')->name('api.game.get');
        Route::put('id/{id}', 'UpdateControll')->name('api.game.update');
        Route::post('new', 'CreateControll')->name('api.game.create');
    });
});

Route::group([
    'prefix' => 'adm',
    'namespace' => 'App\Http\Controllers\Api\Sports\Adm',
    'middleware' => ['auth:sanctum', 'adm.ability']
], function () {
    Route::delete('/player/id/{id}', 'Players\DeleatePlayersControll')->name('api.adm.player.deleate');
    Route::delete('/team/id/{id}', 'Teams\DeleateControll')->name('api.adm.team.deleate');
    Route::delete('/game/id/{id}', 'Games\DeleateControll')->name('api.adm.game.deleate');
});