<?php

use App\Models\category;
use Facade\FlareClient\Http\Response;
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

Route::group([
    'prefix'=>'pizzaCategory','namespace'=>'Api'], function(){
    Route::get('list','ApiController@List');  //data show
    Route::post('createCategory', 'ApiController@CreateCategory'); //data create
    Route::post('categoryDetail','ApiController@Detail'); //data detail show by post method
    Route::get('categoryDetailGet/{id}','ApiController@DetailGet'); // data detail show by get method
    Route::get('categoryDelete/{id}','ApiController@deleteCategory');
});