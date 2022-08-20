<?php

namespace app\Http\Controllers\Admin;

use App\Models\User;
use App\Models\SaleOrder;
use Illuminate\Http\Request;
use App\Models\SaleOrderDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order(){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
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

    //orderSearch

    public function orderSearch(Request $request){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $searchData = $request->search;
        Session::put('searchData',$searchData);
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

    //orderDownload
    public function orderDownload(){
        if (Session::has('searchData')) {
            $searchWord = Session::get('searchData');
            $data = SaleOrder::join('users','user_id' ,'=','users.id')
            ->select('sale_orders.*','users.*','sale_orders.id as saleId','users.id as userId')
            ->Orwhere('users.name','like','%'.$searchWord.'%')
            ->Orwhere('sale_orders.total_price','like','%'.$searchWord.'%')
            ->Orwhere('users.name','like','%'.$searchWord.'%')
            ->Orwhere('sale_orders.id','like','%'.$searchWord.'%')
            ->get(); 
        }else{
            $data = SaleOrder::orderBy('sale_orders.id','desc')
            ->join('users','user_id' ,'=','users.id')
            ->select('sale_orders.*','users.*','sale_orders.id as saleId','users.id as userId')
            ->get();
        }
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($data, [
            'saleId' => 'Sale Id', 
            'name' => 'User Name',
            'total_quantity' => 'Quantity',
            'total_price' => 'Total Price',
            'created_at' => 'Ordered Date',
        ]);
        
        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'orders.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }


    //orderDetail
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
