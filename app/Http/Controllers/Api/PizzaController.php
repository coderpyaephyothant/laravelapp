<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\pizza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PizzaController extends Controller
{
    //pizza data show with Api
    public function List(){
        $data = pizza::select('pizzas.*','categories.category_name')
                ->join('categories','categories.category_id','pizzas.category_id')
                ->get();
        $pizzas = $data->toArray();
       if (!empty($pizzas)) {
        return Response::json([
            'status' => '200',
            'message' => 'success',
            'data' => $pizzas,
        ]);
       }else{
        return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentials',
        ]);
       }

    }
    // pizza create with Api
    public function createPizza(Request $request){
        $detail = $request->all();
        $number = count($detail);
       if ($number != 0) {
        $discount_price = $request->price * ($request->discount_percentage/100);

        $data = [

            'pizza_name' => $request->new_pizza_name,
            'image' => $request->image,
            'price' => $request->price,
            'publish_status' => $request->publish_status,
            'discount_price' => $discount_price, //it has been declared first state !!!!!!
            'discount_percentage' => $request->discount_percentage,
            'new'=>$request->old_new,
            'quantity' => $request->stockItem,
            'category_id' => $request->category,
            'buy_one_get_one' => $request->buy_one_get_one,
            'waiting_time' => $request->waiting_time,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
        pizza::create($data);

        return Response::json([
            'status' => '200',
            'message' => 'successfully added',
            'data' => $data,
        ]);
       }else{
        return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentials..',
        ]);
       }
}

    //pizza detail show with Api
    public function detailPizza(Request $request){
        $detail = $request->all();
        $number = count($detail);
        if ($number != 0) {
            $pizzaId = $request->pizza_id;
            $pizza_detail = pizza::where('pizza_id',$pizzaId)->first();
            if ($pizza_detail) {
                return Response::json([
                    'status' => '200',
                    'message' => 'success',
                    'data' => $pizza_detail,
                ]);
            }
        }

            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials',
            ]);



    }

    // pizza detail show with Api
    public function detailGet($id, Request $request){
        $pizzaId = $id;
        $data = pizza::where('pizza_id', $pizzaId)->first();
        if ($data) {
            return Response::json([
                'status' => '200',
                'message' => 'success',
                'data' => $data,
            ]);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials...',
            ]);
        }

    }
    //pizza delete with POST Api
    public function pizzaDelete(Request $request){
        $detail = $request->all();
        $number = count($detail);
        if ($number != 0) {
            $pizzaId = $request->pizzaId;
            $data = pizza::where('pizza_id',$pizzaId)->first();
            if($data){
                pizza::where('pizza_id',$pizzaId)->delete();
                return Response::json([
                    'status' => '200',
                    'message' => 'success',
                ]);
            }
        }

        return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentails...',
        ]);

    }

    //pizza delete with GET Api
    public function deleteGet($id, Request $request){
        $pizzaId = $id;
        $deletePizza = pizza::where('pizza_id',$pizzaId)->first();
        dd($deletePizza);
        if(!empty($deletePizza)){
            pizza::where('pizza_id',$pizzaId)->delete();
            return Response::json([
                'status' => '200',
                'message' => 'success',
            ]);
        }
        return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentials...',
        ]);
    }

    //pizza update
    public function pizzaUpdate(Request $request){

        $id = $request->pizzaId;
        $data = pizza::where('pizza_id',$id)->first();
        if (!empty($data)) {
            $name = $request->pizza_name == null ? $data->pizza_name : $request->pizza_name;
            $image =$request->image;

            $price = $request->price == null ? $data->price : $request->price;
            $publish_status = $request->publish_status == null ? $data->publish_status : $request->publish_status;
            $discount_percentage = $request->discount_percentage == null ? $data->discount_percentage : $request->discount_percentage;
            if (empty($request->discount_percentage) || empty($request->price)) {
                $discount_price = $data->discount_price;
            } else {
                $discount_price = $request->price * ($request->discount_percentage/100);
            }
            $new = $request->new == null ? $data->new : $request->new;
            $quantity = $request->quantity == null ? $data->quantity : $request->quantity;
            $category_id = $request->category_id == null ? $data->category_id : $request->category_id;
            $buy_one_get_one = $request->buy_one_get_one == null ? $data->buy_one_get_one : $request->buy_one_get_one;
            $waiting_time = $request->waiting_time == null ? $data->waiting_time : $request->waiting_time;
            $description = $request->description == null ? $data->description : $request->description;



            $forDb = [

                'pizza_name' => $name,
                'price' => $price,
                'publish_status' => $publish_status,
                'discount_price' => $discount_price, //it has been declared first state !!!!!!
                'discount_percentage' => $discount_percentage,
                'new'=>$new,
                'quantity' => $quantity,
                'category_id' => $category_id,
                'buy_one_get_one' => $buy_one_get_one,
                'waiting_time' => $waiting_time,
                'description' => $description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ];

            if (isset($request->image)) {
                $file = $image;
                $uniqueId = uniqid();
                $name = $uniqueId.'_AdminPyaePhyoThant_'.$file->getClientOriginalName();
                $forDb['image'] = $name;
            }

            if(isset($forDb['image'])){
                $file->move(public_path().'/uploadedImages/',$name);
                if(File::exists(public_path().'/uploadedImages/'.$data->image)){
                    File::delete(public_path().'/uploadedImages/'.$data->image);
                }



            }
            pizza::where('pizza_id',$id)->update($forDb);

             return response()->json([
                'status' => '200',
                'message' => 'successfully Updated',
                'data' => $forDb,
             ]);
        }else{
            return response()->json([
                'status' => '200',
                'message' => 'Incorrect Credentials.... ',

             ]);
        }


    }
}
