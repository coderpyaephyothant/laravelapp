<?php

use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');
});

//admin panel
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function(){
    
    Route::get('profile','CategoryController@profile')->name('admin#profile');

    //admin->category
    Route::get('category','CategoryController@category')->name('admin#category');
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('createCategory', 'CategoryController@createCategory')->name('admin#createCategory'); 
    Route::get('categoryDelete/{id}','CategoryController@categoryDelete')->name('admin#categoryDelete');
    Route::get('categoryEdit/{id}','CategoryController@categoryEdit')->name('admin#categoryEdit');
    Route::post('updateCategory/{id}','CategoryController@updateCategory')->name('admin#updateCategory');
    Route::post('category','CategoryController@searchCategory')->name('admin#searchCategory');


    //admin->pizza
    Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
    Route::get('pizzaCreate','PizzaController@pizzaCreate')->name('admin#pizzaCreate');
    Route::post('pizzaCreate','PizzaController@pizzaInsert')->name('admin#pizzaInsert');
    Route::post('pizzaSearch','PizzaController@pizzaSearch')->name('admin#pizzaSearch');
    Route::get('pizzaDelete/{id}','PizzaController@pizzaDelete')->name('admin#pizzaDelete');
    Route::get('pizzaEdit/{id}','PizzaController@pizzaEdit')->name('admin#pizzaEdit');
    Route::post('pizzaUpdate/{id}','PizzaController@pizzaUpdate')->name('admin#pizzaUpdate');
    Route::get('pizzaDetail/{id}','PizzaController@pizzaDetail')->name('admin#pizzaDetail');





    Route::get('user','AdminController@user')->name('admin#user');
    Route::get('order','AdminController@order')->name('admin#order');
    Route::get('carrier','AdminController@carrier')->name('admin#carrier');

});

Route::group(['prefix'=>'user'],function(){
    Route::get('/','UserController@index')->name('user#index');
});
