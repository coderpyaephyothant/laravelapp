<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Middleware\CustomerCheckMiddleware;
use App\Http\Controllers\Admin\UserMessageController;

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
    if (Auth::check()) {

            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }

    }
    return view('welcome');
})->name('user#home');

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
Route::group(['prefix'=>'admin', 'namespace'=>'Admin','middleware'=>AdminCheckMiddleware::class],function(){

    Route::get('profile','AdminController@profile')->name('admin#profile');
    Route::post('profile/{id}','AdminController@profileUpdate')->name('admin#profileUpdate');
    Route::get('passwordChange','AdminController@passwordChange')->name('admin#passwordChange');
    Route::post('passwordChange/{id}','AdminController@checkPassword')->name('admin#checkPassword');


    //admin->category
    Route::get('category','CategoryController@category')->name('admin#category');
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('createCategory', 'CategoryController@createCategory')->name('admin#createCategory');
    Route::get('categoryDelete/{id}','CategoryController@categoryDelete')->name('admin#categoryDelete');
    Route::get('categoryEdit/{id}','CategoryController@categoryEdit')->name('admin#categoryEdit');
    Route::post('updateCategory/{id}','CategoryController@updateCategory')->name('admin#updateCategory');
    Route::get('category/search','CategoryController@searchCategory')->name('admin#searchCategory');
    Route::get('categoryItem/{id}','CategoryController@categoryItem')->name('admin#categoryItem');
    // Route::get('categoryItemsearch','CategoryController@categoryItemSearch')->name('admin#categoryItemSearch');
    Route::get('categoryItemDelete/{id}','CategoryController@categoryItemDelete')->name('admin#categoryItemDelete');
    Route::get('category/download','CategoryController@categoryDownload')->name('admin#categoryDownload');


    //admin->type
    Route::get('type','TypeController@type')->name('admin#type');
    Route::get('createType','TypeController@createType')->name('admin#createType');
    Route::post('newType','TypeController@newType')->name('admin#newType');
    Route::get('typeItem/{id}','TypeController@typeItem')->name('admin#typeItem');
    Route::get('typeItemDelete/{id}','TypeController@typeItemDelete')->name('admin#typeItemDelete');
    Route::get('type/download','TypeController@typeDownload')->name('admin#typeDownload');
    Route::get('type/search','TypeController@searchType')->name('admin#searchType');





    //admin->pizza
    Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
    Route::get('pizzaCreate','PizzaController@pizzaCreate')->name('admin#pizzaCreate');
    Route::post('pizzaCreate','PizzaController@pizzaInsert')->name('admin#pizzaInsert');
    Route::get('pizzaSearch','PizzaController@pizzaSearch')->name('admin#pizzaSearch');
    Route::get('pizzaDelete/{id}','PizzaController@pizzaDelete')->name('admin#pizzaDelete');
    Route::get('pizzaEdit/{id}','PizzaController@pizzaEdit')->name('admin#pizzaEdit');
    Route::post('pizzaUpdate/{id}','PizzaController@pizzaUpdate')->name('admin#pizzaUpdate');
    Route::get('pizzaDetail/{id}','PizzaController@pizzaDetail')->name('admin#pizzaDetail');
    Route::get('pizza/download', 'PizzaController@pizzaDownload')->name('admin#pizzaDownload');

    //admin->user
    Route::get('userList','UserController@userList')->name('admin#userList');
    Route::get('userList/userListDownload','UserController@userListDownload')->name('admin#userListDownload');
    Route::get('adminList','UserController@adminList')->name('admin#adminList');
    Route::get('adminList/download','UserController@adminListDownload')->name('admin#adminListDownload');
    Route::get('userList/search','UserCOntroller@userListSearch')->name('admin#userListSearch');
    Route::get('adminList/Search','UserController@adminListSearch')->name('admin#adminListSearch');
    Route::get('userDelete/{id}','UserController@userDelete')->name('admin#userDelete');
    Route::get('addUsers','UserController@addUsers')->name('admin#addUsers');
    Route::post('addUsers','UserController@createUsers')->name('admin#createUsers');


    // admin->messages
    Route::get('userMessage','UserMessageController@index')->name('admin#message');
    Route::get('userMessageId/{id}','UserMessageController@messageId')->name('admin#userMessageId');
    Route::get('messageSearch','UserMessageController@messageSearch')->name('admin#messageSearch');


    //admin->order
    Route::get('order','OrderController@order')->name('admin#order');
    Route::get('order/orderDownload','OrderController@orderDownload')->name('admin#orderDownload');
    Route::get('order/search','OrderController@orderSearch')->name('admin#orderSearch');
    Route::get('orderDetal/{id}','OrderController@orderDetail')->name('admin#orderDetail');






    Route::get('carrier','AdminController@carrier')->name('admin#carrier');

});


//customer Users
Route::group(['prefix'=>'user'],function(){
    Route::get('/home','UserController@index')->name('user#index');
    Route::get('/products','UserController@products')->name('user#products');
    Route::post('sendMessage','UserController@sendMessage')->name('user#sendMessage');
    Route::get('pizzaDetail/{id}','UserController@pizzaDetails')->name('user#pizzaDetails');
    Route::get('chooseByCatName/{id}','UserController@chooseByCatName')->name('user#chooseByCatName');
    Route::post('/home','UserController@searchByPrice')->name('user#searchByPrice');
    Route::post('/home/date','UserController@searchByDate')->name('user#searchByDate');
    Route::get('uiupdate','UserController@uiupdate')->name('user#uiupdate');

    //I solved same post method and same route error By using Laravel HTTP redirect method from Laravel Documents. 6:25pm july31/22

    // cart
    Route::post('addToCart/{id}','UserController@addToCart')->name('user#addToCart');
    Route::get('orderList','UserController@orderList')->name('user#orderList');
    Route::post('quantityUpdate/{id}', 'UserController@quantityUpdate')->name('user#quantityUpdate');
    Route::get('deleteOrderItem/{id}','UserController@deleteOrderItem')->name('user#deleteOrderItem');
    Route::get('checkout','UserController@checkout')->name('user#checkout');
    Route::get('clearCart','UserController@clearCart')->name('user#cartClear');
});

