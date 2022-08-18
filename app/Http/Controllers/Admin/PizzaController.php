<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\pizza;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
     //pizza type
     public function pizza(){
        $pizzaData = pizza::orderBy('pizza_id','desc')->paginate(2);
        
        // dd(count($pizzaData));
        if(count($pizzaData) == 0){
            $fileNumber = 0;
        }else{
            $fileNumber = 1;
        }
        // dd($fileNumber);
        return view('admin.pizza.type')->with(['pizzaData'=>$pizzaData, 'fileNumber'=> $fileNumber]);
    }

    //pizza create
    public function pizzaCreate(){
        $categoryData = category::get();
        return view('admin.pizza.create')->with(['categoryData'=>$categoryData]);
    }


    //pizza insert
    public function pizzaInsert(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'ps' => 'required',
            'discount' => 'required',
            'category' => 'required',
            'bg' => 'required',
            'wt' => 'required',
            'desc' => 'required',

        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $file = $request->file('image');
        $uniqueId = uniqid();
        $name = $uniqueId.'_Adminthant_'. $file->getClientOriginalName();
        $file->move(public_path().'/uploadedImages/',$name);
        
        // dd($name);


        $data = [
            'pizza_name' => $request->name,
            'image' => $name,
            'price' => $request->price,
            'publish_status' => $request->ps,
            'discount_price' => $request->discount,
            'category_id' => $request->category,
            'buy_one_get_one' => $request->bg,
            'waiting_time' => $request->wt,
            'description' => $request->desc,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        // dd($data);

        pizza::create($data);
        return redirect()->route('admin#pizza')->with(['success'=>'new pizza is successfully created']);
    }

    //pizza search
    public function pizzaSearch(Request $request){
        $searchData = $request->search;
        $data = pizza::where('pizza_name','like','%'.$searchData.'%')->paginate(2);
        dd($request->all());
        $data->appends($request->all());
        if(count($data) == 0){
            $fileNumber = 0;
        }else{
            $fileNumber = 1;
        }
        return view('admin.pizza.type')->with(['pizzaData'=>$data,'fileNumber'=> $fileNumber]);
    }
    
    //pizza Delete
    public function pizzaDelete($id){
        
        $folderImage = pizza::select('image')->where('pizza_id',$id)->first();  
        
        $folderImageName = $folderImage['image'];
            // dd($folderImage);
        if(File::exists(public_path().'/uploadedImages/'.$folderImageName)){
            File::delete(public_path().'/uploadedImages/'.$folderImageName);
        }

        pizza::where('pizza_id',$id)->delete();
        return redirect()->route('admin#pizza')->with(['delete'=>'successfully deleted!']);
    }

    //pizza edit
    public function pizzaEdit($id){
        
        $data = pizza::where('pizza_id',$id)->first();
        // dd($data->toArray());
        $categoryData = category::get();
        
        return view('admin.pizza.edit')->with(['data'=>$data,'categoryData'=>$categoryData]);
    }



    //pizza update
    public function pizzaUpdate($id,Request $request){
        $discount_price = ($request->price) * ($request->discount_percentage/100);
    //    dd($request->toArray());
        if(!empty($request->image)){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'ps' => 'required',
                'discount_percentage' => 'required',
                'quantity' => 'required',
                'category' => 'required',
                'bg' => 'required',
                'wt' => 'required',
                'desc' => 'required',
    
            ]);
     
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $file = $request->file('image');
            $uniqueId = uniqid();
            $name = $uniqueId.'_Adminthant_'. $file->getClientOriginalName();
            $file->move(public_path().'/uploadedImages/',$name);
            $data = [
                'pizza_name' => $request->name,
                'image' => $name,
                'price' => $request->price,
                'discount_percentage' => $request->discount_percentage,
                'publish_status' => $request->ps,
                'discount_price' =>$discount_price,
                'quantity' =>$request->quantity,
                'category_id' => $request->category,
                'buy_one_get_one' => $request->bg,
                'waiting_time' => $request->wt,
                'description' => $request->desc,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            pizza::where('pizza_id',$id)->update($data);
        return redirect()->route('admin#pizza')->with(['updated'=>'successfully updated!']);


        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'ps' => 'required',
                'discount_percentage' => 'required',
                'quantity' => 'required',
                'category' => 'required',
                'bg' => 'required',
                'wt' => 'required',
                'desc' => 'required',
    
            ]);
     
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $data = [
                'pizza_name' => $request->name,
                'price' => $request->price,
                'publish_status' => $request->ps,
                'discount_percentage' => $request->discount_percentage,
                'quantity' =>$request->quantity,
                'discount_price' => $discount_price,
                'category_id' => $request->category,
                'buy_one_get_one' => $request->bg,
                'waiting_time' => $request->wt,
                'description' => $request->desc,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
               
            ];
            // dd($data);
            pizza::where('pizza_id',$id)->update($data);
        return redirect()->route('admin#pizza')->with(['updated'=>'successfully updated!']);
        }      
    }
    //pizza details
    public function pizzaDetail($id){
        $data= pizza::where('pizza_id',$id)->first();
        $categoryData = category::get();
        // dd($categoryData);
        return view('admin.pizza.detail')->with(['data'=>$data,'categoryData'=>$categoryData]);
    }
    
}
