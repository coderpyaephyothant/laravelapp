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
    Route::get('list','CategoryController@List');  //data show
    Route::post('createCategory', 'CategoryController@CreateCategory'); //data create
    Route::post('categoryDetail','CategoryController@Detail'); //data detail show by post method
    Route::get('categoryDetailGet/{id}','CategoryController@DetailGet'); // data detail show by get method
    Route::get('categoryDelete/{id}','CategoryController@deleteCategory'); //data delete by get method
    Route::post('categoryDeletePOST','CategoryController@deletePOST'); //data delete by post method
    Route::post('categoryUpdate','CategoryController@updateGet');//update data by post method
    Route::post('categorySearch','CategoryController@searchCategory'); //search data
});

Route::group([
    'prefix'=>'pizzas','namespace'=>'Api'], function(){
    Route::get('list','PizzaController@List'); // data show
    Route::post('createPizza','PizzaController@createPizza');//data create
    Route::post('detailPizza','PizzaController@detailPizza'); //detail pizza by POST Method
    Route::get('detailGet/{id}','PizzaController@detailGet');//detail pizza by GET Method
    Route::post('pizzaDelete','PizzaController@pizzaDelete');//pizza delete by POST Method
    Route::get('deleteGet/{id}','PizzaController@deleteGet'); //pizza delete by GET Method
    Route::post('pizzaUpdate','PizzaController@pizzaUpdate');//update data by post method

});

Route::group([
    'prefix'=>'users','namespace'=>'Api'], function(){
    Route::get('List', 'UserController@List'); //data show for users
    Route::post('detailUsers','UserController@detailUser'); //detail show of users
    Route::post('createUser','UserController@createUser');//create user with api
    Route::post('updateUser','UserController@updateUser'); //update user with api
    Route::post('deleteUser','UserController@deleteUser'); //delete user with api
})
;

Route::group([
    'prefix'=> 'admins','namespace' => 'Api'], function(){
    Route::get('List', 'AdminController@List'); //data show of admins
    Route::post('detailAdmins', 'AdminController@detailAdmins'); //detail of admins
    Route::post('createAdmins','AdminController@createAdmins'); //create admins with api
    Route::post('updateAdmin','AdminController@updateAdmin'); //update admins with api
    Route::post('deleteAdmin' , 'AdminController@deleteAdmin'); //delete admins wit api
});

Route::group([
    'prefix' => 'orders' , 'namespace' => 'Api'], function(){
        Route::get('List', 'OrderController@List'); //data show for orders with api
    });
