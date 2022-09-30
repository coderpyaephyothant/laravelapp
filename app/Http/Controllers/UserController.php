<?php

namespace App\Http\Controllers;

use App\Cart;
use Carbon\Carbon;
use App\Models\Type;
use App\Models\pizza;
use App\Models\category;
use App\Models\SaleOrder;
use App\Models\SendMessage;
use Illuminate\Http\Request;
use App\Models\SaleOrderDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Translation\Provider\Dsn;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

use function Symfony\Component\String\b;

class UserController extends Controller
{   //Index
    public function index(){
        $totalQty = Session::get('cart');

       $pizzaData =  pizza::get();
    //    dd($pizzaData->toArray());
       $categoryData = category::get();
       $public = $pizzaData->toArray();
        $count = count($public);


    if(count($pizzaData) == 0){
        $Number = 0;
    }else{
        $Number = 1;
    }
        return view('customer.home')->with(['pizzas'=>$pizzaData, 'category'=>$categoryData  , 'Number'=>$Number ,'totalQty'=>$totalQty   ]);
    }

    public function products(){
        // dd('hello');
        return view('customer.products');
    }

    //Message
    public function sendMessage (Request $request){
        if (Auth::check()) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $messageData = $this->message($request);
        // dd($messageData);

            SendMessage::create($messageData);
        return back()->with(['sent' => 'Thanks you for message!']);

        }else{
            return back()->with(['sent'=>'Incorrect Credentials... Please Sign In or Register first...']);
        }

    }

    //For Message
    private function message($request){
        return [
            'author_id' => auth()->user()->id,
            'title' => $request->title,
            'message' => $request -> message,
        ];
    }

    //pizza Deatils
    public function pizzaDetails( $id){
       $data =  pizza::where('pizza_id',$id)->get();
       return view('customer.pizzaDetail')->with(['data'=>$data]);

    }

    //addToCart  //ui add to cart


    // public function addToCart(Request $request,$id){

    //     $pizza = pizza::where('pizza_id',$id)->first();
    //     $dataBaseQty = $pizza->quantity; //for dataBase
    //     $pizzaQuantity =  $request->quantity ? $request->quantity : 1 ;  //one error please check!!!!!!!!!!!!!!!!!!
    //     $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($itemsInThe);
    //     $cart->add($pizza,$pizza->pizza_id,$pizzaQuantity);


    //     $yourQuantity = $cart->items[$id]['quantity'];
    //     if ($yourQuantity > $dataBaseQty) {
    //        return back()->with(['outOcStock'=>'out of stock now...']);
    //     }
    //     $request->Session()->put('cart',$cart);
    //     // dd($cart->totalPrice);
    //     $success = $pizza->pizza_name. '   is successfully added to the Cart!';
    //     return redirect()->route('user#index')->with(['success'=>$success]);

    // }

    // //order List
    // public function orderList(Request $request){
    //    $categoryData = category::get();
    //    $pizzaData =  pizza::get();



    //     $itemsInThe = Session::get('cart');
    //     // $user_id = auth()->user()->id;
    //     $cart = new Cart($itemsInThe);
    //     // dd(auth()->user()->id);
    //     $c = $cart->items;
    //     if ($cart->items != null) {
    //     return view('customer.orderList', ['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty'=>$cart->totalQuantity]);

    //     }else{
    //         // dd($cart);
    //         return view('customer.orderList')->with(['totalQty'=>'no data','pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice]);

    //     }

    //     // if(! Session::has('cart') ) {
    //     //     return view('customer.orderList')->with(['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice,'totalQty'=>'no data']);
    //     // }
    // }

        //checkout or odrder submit
        public function checkout(){
            if (Auth::check()) {
                if (Session::get('cart')!= null) {

                    $itemsInThe = Session::get('cart');
                    $cart = new Cart($itemsInThe);
                    // dd($cart);
                    $usrId = auth()->user()->id;
                    $totalPrice = $cart->totalPrice;
                    $totalQuantity = $cart->totalQuantity;
                                                            //for into sale_order Table
                    $dataForSaleOrder = [
                        'user_id' => $usrId,
                        'total_price' => $totalPrice,
                        'total_quantity' => $totalQuantity,
                    ];
                                                            //insert into sale_order Table
                     $sale = SaleOrder::create($dataForSaleOrder);
                                                            //for sale_order_details

                     $saleOrderId = $sale->id;              //sale order id
                    foreach ($cart->items as $key => $value) {
                     $productId = $value['item']['pizza_id']; //product_id ('pizza_id)
                     $quantity = $value['quantity'];        //product quantity
                     $PizzaDetails = pizza::where('pizza_id',$productId); //choose pizza details By ID
                     $qutny =  $PizzaDetails->first()->toArray();
                     $pizzaQtny = $qutny['quantity'];
                     $calculateQty =  $pizzaQtny - $quantity; // substract orderQuantity from Database Quantity
                     $CalculatedQuntyForDatabse = [
                        'quantity' => $calculateQty,
                     ];
                     pizza::where('pizza_id',$productId)->update($CalculatedQuntyForDatabse); //update pizza quantity By ID
                    $dataFOrSaleOrderDetails = [
                        'sale_order_id' => $saleOrderId,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ];
                    $orderDetails = SaleOrderDetails::create($dataFOrSaleOrderDetails); //insert into sale_order_details table
                     }
                    session()->forget('cart');

                    return redirect()->route('user#uishop')->with(['success'=>'Thanks for your ordeder!']);


                }else{
                    return back();
                }
            } else{
                return back()->with(['please' => 'Incorrect credentials.LogIn or Register now!']);
            }


        }


    // //quantity Update
    // public function quantityUpdate(Request $request, $id){

    //     $validator = Validator::make($request->all(), [
    //         'quantity' => 'required|numeric|min:1'
    //     ]);

    //     if ($validator->fails()) {
    //         return back()
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }
    //     if(Session::has('cart')){
    //     $pizzaId = $id;
    //     $product = pizza::where('pizza_id',$id)->first();
    //     $dataBaseQty = $product->quantity;

    //     $quantity = $request->quantity;

    //     $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($itemsInThe);
    //     $cart->update($pizzaId,$quantity,$product);
    //     $yourQty = $cart->items[$id]['quantity'];
    //     if ($quantity > $dataBaseQty){
    //         return back()->with(['outOcStock'=>'out of stock now...']);

    //     }

    //     $request->session()->put('cart', $cart);
    //     return back()->with(['success'=> 'successfully updated']);
    //     }else{
    //     return back()->with(['fail'=> 'Incorrect Credentials']);

    //     }
    // }

    //orderitem delete
    public function deleteOrderItem(Request $request,$id){

       $pizzaId = $id;
       $toDeletePizza = pizza::where('pizza_id',$id)->first();
       $name = $toDeletePizza->pizza_name;
    //    $toDeletePizzaName =
       $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($itemsInThe);

        $cart->remove($pizzaId,$toDeletePizza);


        $request->session()->put('cart', $cart);
        return back()->with(['deleted'=> $name.' is Successfully deleted']);

        // if ($remove == 0) {
        // $request->session()->forget('cart');
        // return back();

        // }



    }

    // cartClear
    // public function clearCart(){
    //     // dd(Session::get('cart'));
    //     ;
    //     if (Session::get('cart') == null) {
    //         return back()->with(['inc'=> 'Incorrect Credentials...']);
    //     }else{

    //     // $itemsInThe = Session::get('cart');
    //     // $cart = new Cart($itemsInThe);
    //     $items = session()->forget('cart');
    //     return redirect()->route('user#index');
    //     }


    // }



    //choose pizza by category Name
    public function chooseByCatName($id){
            $categoryData = category::get();

            $data = pizza::where('category_id',$id)
            ->get();
            if(count($data) == 0){
                $Number = 0;
            }else{
                $Number = 1;
            }
        return view('customer.home')->with(['pizzas'=>$data , 'category'=>$categoryData  , 'Number'=>$Number]);

            // dd($data->toArray());
    }

    //search By Price
    public function searchByPrice(Request $request){
        // dd($request->all());
        $minimumPrice = $request->min;
        $maximumPrice = $request->max;
        $categoryData = category::get();

        $data = pizza::select('*');
        if (!is_null($minimumPrice) && is_null($maximumPrice)) {
            $choose = $data->where('price' , '>=', $minimumPrice);


        } elseif (is_null($minimumPrice) && !is_null($maximumPrice)) {
            $choose = $data->where('price' , '<=', $maximumPrice);


        } elseif (is_null($minimumPrice) && is_null($maximumPrice)) {
            return redirect()->route('user#index');



        } elseif (!is_null($minimumPrice) && !is_null($maximumPrice)) {
            $choose = $data->where('price' , '<=' , $maximumPrice)
                            ->where( 'price','>=', $minimumPrice);


        }
            $pizzaData =  $choose->get();
            // dd($pizzaData->toArray());

          if ($pizzaData == '' || $pizzaData == 'null' || count($pizzaData) == 0) {
            $Number = 0;
          }
          else{
            $Number = 1;
        }
                return view('customer.home')->with(['pizzas'=>$pizzaData, 'category'=>$categoryData  , 'Number'=>$Number]);
    }

    //Search By Date
    public function searchByDate(Request $request){

        $from = $request->from;
        $to = $request->to;
        $categoryData = category::get();
        $data = pizza::select('*');
        if (!is_null($from) && is_null($to)) {
            $choose = $data->whereDate('created_at' , '>=', $from);
        } elseif (is_null($from) && !is_null($to)) {
            $choose = $data->whereDate('created_at' , '<=', $to);
        } elseif (is_null($from) && is_null($to)) {
            return redirect()->route('user#index');

        } elseif (!is_null($from) && !is_null($to)) {
            $choose = $data->whereDate('created_at' , '<=' , $to)
                            ->whereDate( 'created_at','>=', $from);
        }
        $pizzaData =  $choose->get();
        if ($pizzaData == '' || $pizzaData == 'null' || count($pizzaData) == 0) {
            $Number = 0;
          }
          else{
            $Number = 1;
        }
                return view('customer.home')->with(['pizzas'=>$pizzaData, 'category'=>$categoryData  , 'Number'=>$Number]);
        // dd($pizzaData->toArray());
    }


    //order Data
    public function orderData(){
        return view('customer.addToCart');
    }

    //UI

    //ui update

    public function uiupdate(){
       $categoryData =  category::get();
                                // dd($categoryData->toArray());

       $pizzaData = pizza::get();
       $typeData = Type::get();

       $categories = $categoryData->toArray();
       $pizzas = $pizzaData->toArray();
       $types = $typeData->toArray();
    //    dd($pizzas);
        return view('customer.uiupdate')->with(['catData'=>$categories, 'pizzaData' => $pizzas, 'typeData'=>$types]);
    }

    //uishop
    public function uishop(){

        $categoryData =  category::join('pizzas','categories.category_id', '=', 'pizzas.category_id')
                                    ->select('*',DB::raw('COUNT(pizzas.category_id)as count') )
                                    ->groupBy('categories.category_id')->get();
        $pizzaForAll = pizza::get(); //for sale off;
       $pizzasForPaginate = pizza::paginate(8);
    //    dd($pizzaData->total());
       $typeData = Type::join('pizzas','types.type_id', '=', 'pizzas.type')
       ->select('*',DB::raw('COUNT(pizzas.type)as count') )
       ->groupBy('types.type_id')->get();
    //    dd($typeData->toArray());
       $categories = $categoryData->toArray();
       $types = $typeData->toArray();
        return view('customer.uishop')->with(['catData'=>$categories, 'pizzaData'=>$pizzaForAll, 'pizzaForPaginate' => $pizzasForPaginate, 'typeData'=>$types]);
    }

    //ui filter
    public function uifilter($id, Request $request){
        $categoryData =  category::join('pizzas','categories.category_id', '=', 'pizzas.category_id')
        ->select('*',DB::raw('COUNT(pizzas.category_id)as count') )
        ->groupBy('categories.category_id')->get();
        $pizzaForAll = pizza::get(); //for sale off;
        $pizzasForPaginate = pizza::paginate(8);
        //    dd($pizzaData->total());
        $typeData = Type::join('pizzas','types.type_id', '=', 'pizzas.type')
        ->select('*',DB::raw('COUNT(pizzas.type)as count') )
        ->groupBy('types.type_id')->get();
        //    dd($typeData->toArray());
        $categories = $categoryData->toArray();
        $types = $typeData->toArray();

        $pizzaForAll = pizza::get();

        $list = pizza::paginate(8);
        // dd($inthis);
        if ($id == 5) {
            $list = pizza::paginate(8);
            $inthis = 5;
        }


        if ($id == 1) {
            $today = Carbon::today();
            $lastWeek = $today->subWeek();
            $pdata = pizza::select('*');
            $choose = $pdata->whereDate('created_at' , '>=', $lastWeek);

            $list = $choose->paginate(8);
            $inthis = 1; //the pizza should be greater than last month! For lastest new pizzas!


            //for Carbon ------ ----- ------ ----- ----
            //https://www.digitalocean.com/community/tutorials/easier-datetime-in-laravel-and-php-with-carbon
            //--------- -----

        }

        if ($id == 4) {
            $today = Carbon::today();
            $lastMonth = $today->subMonth();
            $pdata = pizza::select('*');
            $choose = $pdata->whereDate('created_at' , '>=', $lastMonth);

            $list = $choose->paginate(8);
            $inthis = 4;
        }
        if ($id == 2) {
            $pdata = pizza::select('*');
            $choose = $pdata->orderBy('price' , 'desc');
            $list = $choose->paginate(8);
            $inthis = 2;
        }
        if ($id == 3) {
            $pdata = pizza::select('*');
            $choose = $pdata->orderBy('price' , 'asc');
            $list = $choose->paginate(8);
            $inthis = 3;
        }


        return view('customer.uishop')->with(['catData'=>$categories, 'pizzaData'=>$pizzaForAll, 'pizzaForPaginate' => $list, 'typeData'=>$types, 'inthis'=>$inthis]);

}

    //ui search
    public function uisearch(Request $request){
        // dd('you search');
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }

        $categoryData =  category::join('pizzas','categories.category_id', '=', 'pizzas.category_id')
                                    ->select('*',DB::raw('COUNT(pizzas.category_id)as count') )
                                    ->groupBy('categories.category_id')->get();
        $typeData = Type::join('pizzas','types.type_id', '=', 'pizzas.type')
                                    ->select('*',DB::raw('COUNT(pizzas.type)as count') )
                                    ->groupBy('types.type_id')->get();

        $categories = $categoryData->toArray();
        $types = $typeData->toArray();

        $userSearch = $request->name;
        // $pdata = pizza::select('*')->get();
        // dd($pdata->toArray());
        // dd($userSearch);
        Session::put('userSearch',$userSearch);


        $public = pizza::join('categories', 'pizzas.category_id' ,'=', 'categories.category_id')
                            ->join('types', 'type' , '=', 'types.type_id')
                            // ->select('pizzas.pizza_name','pizzas.price','categories.category_name','types.type_name','pizzas.description')
                            ->where('publish_status',1)
                            ->where(function ($query) use($userSearch) {
                                $query->orwhere('pizzas.pizza_name','like','%'.$userSearch.'%')
                                ->orwhere('pizzas.price','like','%'.$userSearch.'%')
                                ->orwhere('pizzas.description','like','%'.$userSearch.'%')
                                ->orwhere('categories.category_name','like','%'.$userSearch.'%')
                                ->orwhere('types.type_name','like','%'.$userSearch.'%');

                            })
                            ->orderBy('pizzas.pizza_name' , 'asc')
                            ->paginate(8);
                            $public->appends($request->all()); //its important
                            // dd($public->toArray());
                            return view('customer.uiproducts')->with(['pizzaForPaginate'=> $public,'catData'=>$categories,'typeData'=>$types]);


    }



    public function uilinkopenType($id){
        $categoryData =  category::join('pizzas','categories.category_id', '=', 'pizzas.category_id')
                                    ->select('*',DB::raw('COUNT(pizzas.category_id)as count') )
                                    ->groupBy('categories.category_id')->get();
        $typeData = Type::join('pizzas','types.type_id', '=', 'pizzas.type')
                                    ->select('*',DB::raw('COUNT(pizzas.type)as count') )
                                    ->groupBy('types.type_id')->get();

        $categories = $categoryData->toArray();
        $types = $typeData->toArray();
        $typeId = $id;
        $pizzas = pizza::where('type',$typeId)
        ->orderBy('pizza_name' , 'asc')
        ->paginate(8);
        return view('customer.uiproducts')->with(['pizzaForPaginate'=> $pizzas,'catData'=>$categories,'typeData'=>$types]);

    }
    public function uilinkopenCat($id){
        $categoryData =  category::join('pizzas','categories.category_id', '=', 'pizzas.category_id')
                                    ->select('*',DB::raw('COUNT(pizzas.category_id)as count') )
                                    ->groupBy('categories.category_id')->get();
        $typeData = Type::join('pizzas','types.type_id', '=', 'pizzas.type')
                                    ->select('*',DB::raw('COUNT(pizzas.type)as count') )
                                    ->groupBy('types.type_id')->get();

        $categories = $categoryData->toArray();
        $types = $typeData->toArray();
        $catId = $id;
        $pizzas = pizza::where('category_id',$catId)
        ->orderBy('pizza_name' , 'asc')
        ->paginate(8);

        return view('customer.uiproducts')->with(['pizzaForPaginate'=> $pizzas,'catData'=>$categories,'typeData'=>$types]);


    }

    //UI Detail
    public function uidetail($id){
        $pizzaId = $id;
        //FOR LATEST
            $today = Carbon::today();
            $lastMonth = $today->subMonth();
            $pdata = pizza::select('*');
            $pizzadata = $pdata->whereDate('created_at' , '>=', $lastMonth)->get();
            $pizzas = $pizzadata->toArray();
            // dd($pizzas);
            //LATEST

        $data = pizza::where('pizza_id',$pizzaId)
                ->join('categories', 'pizzas.category_id' ,'=', 'categories.category_id')
                ->join('types', 'type' , '=', 'types.type_id')
                ->select('*',DB::raw('COUNT(pizzas.type)as count') )
                ->groupBy('types.type_id')

                // ->select('pizzas.pizza_name','pizzas.image','pizzas.price','categories.category_name','types.type_name','pizzas.description')
                ->get();
        $mainDetail = $data->toArray();
        $typeId = $mainDetail[0]['type'];
        $sameTypePizzas = pizza::where('type',$typeId)->get();
        $sameTypes = $sameTypePizzas->toArray();
        // dd($sameCats);
        return view('customer.uidetail')->with(['mainDetail' => $mainDetail, 'sameTyps'=>$sameTypes , 'pizzas'=>$pizzas]);
    }

    //ui cart
    public function uicart(){
        return view('customer.uiShoppingCart');
    }

    //ui add to cart
    public function addToCart(Request $request,$id){
        // dd('this is add to cart');
        // dd($request->quantity);
        $pizza = pizza::where('pizza_id',$id)->first();
        $dataBaseQty = $pizza->quantity; //for dataBase
        $pizzaQuantity =  $request->quantity ? $request->quantity : 1 ;  //(solved !)one error please check!!!!!!!!!!!!!!!!!!
        $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($itemsInThe);
        $cart->add($pizza,$pizza->pizza_id,$pizzaQuantity);


        $yourQuantity = $cart->items[$id]['quantity'];
        if ($yourQuantity > $dataBaseQty) {
           return back()->with(['outOcStock'=>'out of stock now...']);
        }
        $request->Session()->put('cart',$cart);
        // dd($cart->totalPrice);
        // dd(Session::get('cart'));
        $success = $pizza->pizza_name. '   is successfully added to the Cart!';
        return redirect()->route('user#uishop')->with(['success'=>$success]);

    }

     // ui order List
     public function orderList(Request $request){
        $categoryData = category::get();
        $pizzaData =  pizza::get();



         $itemsInThe = Session::get('cart');
         // $user_id = auth()->user()->id;
         $cart = new Cart($itemsInThe);
         // dd(auth()->user()->id);
         if ($cart->items != null) {
            // dd($cart);
         return view('customer.uiShoppingCart', ['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty'=>$cart->totalQuantity]);

         }else{
             // dd($cart);
             return view('customer.uiShoppingCart')->with(['totalQty'=>'no data','pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice]);

         }

         // if(! Session::has('cart') ) {
         //     return view('customer.orderList')->with(['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice,'totalQty'=>'no data']);
         // }
     }

    //  test ui quantity

    // public function quantityUpdatetest(){
    //     dd('this is a test');
    // }

    
      //ui  quantity Update
    public function quantityUpdate(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if(Session::has('cart')){
        $pizzaId = $id;
        $product = pizza::where('pizza_id',$id)->first();
        $dataBaseQty = $product->quantity;

        $quantity = $request->quantity;
            // dd($quantity);
        $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($itemsInThe);
        $cart->update($pizzaId,$quantity,$product);
        $yourQty = $cart->items[$id]['quantity'];
        if ($quantity > $dataBaseQty){
            return back()->with(['outOcStock'=>'out of stock now...']);

        }

        $request->session()->put('cart', $cart);
        return back()->with(['success'=> 'successfully updated']);
        }else{
        return back()->with(['fail'=> 'Incorrect Credentials']);

        }
    }

    // cartClear
    public function clearCart(){
        // dd(Session::get('cart'));
        ;
        if (Session::get('cart') == null) {
            return back()->with(['inc'=> 'Incorrect Credentials...']);
        }else{

        // $itemsInThe = Session::get('cart');
        // $cart = new Cart($itemsInThe);
        $items = session()->forget('cart');
        return redirect()->route('user#uishop');
        }


    }

    public function testing(){
        dd('testing');
    }
}
