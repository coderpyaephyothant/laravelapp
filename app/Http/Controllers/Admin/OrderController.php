<?php

namespace app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaleOrder;

class OrderController extends Controller
{
    public function order(){
        $saleOrderData = SaleOrder::join('users','user_id' ,'=','users.id')
        ->select('sale_orders.*','users.*','sale_orders.id as saleId','users.id as userId')
        ->paginate(4);
        // dd($saleOrderData);
        return view('admin.order.sort')->with(['saleOrders'=>$saleOrderData]);
    }

    public function orderDetails($id, Request $request){
        dd($id);
        dd('this is order details page')
        ;
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
        // dd($saleOrderData->toArray());
        return view('admin.order.sort')->with(['saleOrders'=>$saleOrderData]);
    }
}
