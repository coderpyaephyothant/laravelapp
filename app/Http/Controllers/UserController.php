<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\pizza;
use App\Models\category;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetails;
use App\Models\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Symfony\Component\Translation\Provider\Dsn;

class UserController extends Controller
{   //Index
    public function index(){
        $totalQty = Session::get('cart');
        
       $pizzaData =  pizza::get();
       
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

    //Message
    public function sendMessage (Request $request){
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

    //addToCart
    

    public function addToCart(Request $request,$id){
        $pizza = pizza::where('pizza_id',$id)->first();
        $dataBaseQty = $pizza->quantity;
        // dd($dataBaseQty);
        // if ($request->quantity) {
        //     $pizzaQuantity = $request->quantity;
        // }
        $pizzaQuantity =  $request->quantity ? $request->quantity : 0 ;
        $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($itemsInThe);
        $cart->add($pizza,$pizza->pizza_id,$pizzaQuantity);   
        $yourQuantity = $cart->items[$id]['quantity'];
        // dd($yourQuantity);
        if ($yourQuantity > $dataBaseQty) {
           return back()->with(['outOcStock'=>'out of stock now...']);
        }   
        $request->Session()->put('cart',$cart);
        // dd($cart->totalPrice);
        $success = $pizza->pizza_name. '   is successfully added to the Cart!';
        return redirect()->route('user#index')->with(['success'=>$success]);
        
    }

    //order List
    public function orderList(Request $request){
       $categoryData = category::get();
       $pizzaData =  pizza::get();
        
        

        $itemsInThe = Session::get('cart');
        // $user_id = auth()->user()->id;
        $cart = new Cart($itemsInThe);
        // dd(auth()->user()->id);
        // dd($cart->totalPrice);
        // foreach ($cart->items as $key => $value) {
        //    dd($value['item']['pizza_name']);
        // }
        if ($cart->items != null) {
        return view('customer.orderList', ['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty'=>$cart->totalQuantity]);
           
        }else{
            // dd($cart);
            return view('customer.orderList')->with(['totalQty'=>'no data','pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice]);

        }
        
        // if(! Session::has('cart') ) {
        //     return view('customer.orderList')->with(['pizzas' => $cart->items, 'totalPrice' => $cart->totalPrice,'totalQty'=>'no data']);
        // }
    }

        //checkout or odrder submit
        public function checkout(){
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

                return redirect()->route('user#index')->with(['success'=>'Thanks for your ordeder!']);
    
            
            }else{
                return back();
            }
        }


    //quantity Update
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

    //orderitem delete
    public function deleteOrderItem(Request $request,$id){

       $pizzaId = $id;
       $toDeletePizza = pizza::where('pizza_id',$id)->first();
       $itemsInThe = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($itemsInThe);
        $cart->remove($pizzaId,$toDeletePizza);
        $request->session()->put('cart', $cart);
        return back();

        // if ($remove == 0) {
        // $request->session()->forget('cart');
        // return back();

        // }



    }

    //cartClear
    public function clearCart(){
        // dd(Session::get('cart'));
        ;
        if (Session::get('cart') == null) {
            return back();
        }else{
            
        // $itemsInThe = Session::get('cart');
        // $cart = new Cart($itemsInThe);
        $items = session()->forget('cart');
        return redirect()->route('user#index');
        }
        
      
    }



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
}
