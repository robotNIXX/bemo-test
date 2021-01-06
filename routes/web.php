<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dump-download', 'App\Http\Controllers\ExportController@download');
Route::get('/{any}', 'App\Http\Controllers\SPAController@index')->where('any', '^(?!api).*');

