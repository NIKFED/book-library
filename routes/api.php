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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('book', \App\Http\Controllers\Rest\BookController::class, [
    'only' => ['index', 'show', 'store', 'update', 'destroy']
]);

Route::post('dictionaries', [\App\Http\Controllers\DictionaryController::class, 'getGroup']);

Route::post('dictionary/{dictionaryName}', [\App\Http\Controllers\Rest\DictionaryController::class, 'store']);
Route::put('dictionary/{dictionaryName}/{id}', [\App\Http\Controllers\Rest\DictionaryController::class, 'update']);
Route::delete('dictionary/{dictionaryName}/{id}', [\App\Http\Controllers\Rest\DictionaryController::class, 'destroy']);

Route::get('category/{categoryId}/books', [\App\Http\Controllers\Rest\CategoryController::class, 'getBooksWithCategoryId']);