<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'columns'], function () {
    Route::get('/', 'App\Http\Controllers\API\ColumnsController@index')->name('columns.list');
    Route::post('/', 'App\Http\Controllers\API\ColumnsController@store')->name('columns.store');
});
Route::group(['prefix' => 'cards'], function () {
    Route::post('/', 'App\Http\Controllers\API\CardsController@store')->name('cards.store');
    Route::post('/{id}', 'App\Http\Controllers\API\CardsController@update')->name('cards.update');
});
