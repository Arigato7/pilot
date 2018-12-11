<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::get('/s', [
    'as' => 'api.search',
    'uses' => 'Api\SearchController@materialSearch'
]);

Route::get('/material-types', [
    'as' => 'api.materialTypes',
    'uses' => 'Api\MaterialTypeController@getAllMaterialTypes'
]);

Route::post('/material-type/{id}/delete', [
    'as' => 'api.materialTypeDelete',
    'uses' => 'Api\MaterialTypeController@deleteMaterialType'
]); */
