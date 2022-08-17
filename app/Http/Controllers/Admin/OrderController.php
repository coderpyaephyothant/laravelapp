<?php

namespace app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetails;
use App\Models\User;

class OrderController extends Controller
{
    public function order(){
        $saleOrderData = SaleOrder::orderBy('sale_orders.id','desc')
        ->join('users','user_id' ,'=','users.id')
        ->select('sale_orders.*','users.*','sale_orders.id as saleId','users.id as userId')
        ->paginate(4);    
        if(count($saleOrderData) > 0){
            $number = 1;
        }else{
            $number = 0;
        }
        return view('admin.order.sort')->with(['saleOrders'=>$saleOrderData , 'number'=>$number]);
    }


    public function orderSearch(Request $request){
        $searchData = $request->search;
        
        $saleOrderData = SaleOrder::join('users','user_id' ,'=','users.id')
        ->select('sale_orders.*','users.*','sale_orders.id as saleId','users.id as userId')
        ->Orwhere('users.name','like','%'.$searchData.'%')
        ->Orwhere('sale_orders.total_price','like','%'.$searchData.'%')
        ->Orwhere('users.name','like','%'.$searchData.'%')
        ->Orwhere('sale_orders.id','like','%'.$searchData.'%')
        ->paginate(4); 
        $saleOrderData->append($request->all());
        if(count($saleOrderData) > 0){
            $number = 1;
        }else{
            $number = 0;
        }
        // dd($saleOrderData->toArray());
        return view('admin.order.sort')->with(['saleOrders'=>$saleOrderData , 'number'=>$number]);
    }

    public function orderDetail($id, Request $request){
        //sale order data
        $order = SaleOrder::where('id',$id)
                                ->get();
        $orderIdData = $order->toArray();
        //user data from users with id
        $userID= $orderIdData[0]['user_id'];
        $userData = User::where('id',$userID)->get();
        $user=$userData->toArray();

        //sale order details data with data binding 
        $saleData = SaleOrderDetails::where('sale_order_id',$id)
                                    ->select('*','pizzas.*','sale_order_details.quantity as sale_quantity')
                                    ->join('pizzas','pizza_id','product_id')
                                    ->join('sale_orders','sale_orders.id','sale_order_id')
                                    ->get()
        ;
        $data = $saleData->toArray();



        return view('admin.order.orderDetail')->with([ 'orderId'=>$orderIdData, 'user'=>$user,'data'=>$data])
        ;
    }
}
