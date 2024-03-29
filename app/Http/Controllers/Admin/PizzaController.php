<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\pizza;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
     //pizza type
     public function pizza(){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $pizzaData = pizza::orderBy('pizza_id','desc')->paginate(2);
        // dd($pizzaData->toArray());

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
        $typeData = Type::get();
        return view('admin.pizza.create')->with(['categoryData'=>$categoryData, 'typeData'=>$typeData]);
    }

     //pizza search
     public function pizzaSearch(Request $request){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $searchData = $request->search;
        $searchWord = $searchData;
        Session::put('searchData',$searchWord);
        $data = pizza::where('pizza_name','like','%'.$searchData.'%')->paginate(2);
        // dd($request->all());
        $data->appends($request->all());
        if(count($data) == 0){
            $fileNumber = 0;
        }else{
            $fileNumber = 1;
        }
        return view('admin.pizza.type')->with(['pizzaData'=>$data,'fileNumber'=> $fileNumber]);
    }


    //pizzaDownload
    public function pizzaDownload(){
        if (Session::has('searchData')) {
            $sessionSearchWord = Session::get('searchData');
            $data = pizza::where('pizza_name','like','%'.$sessionSearchWord.'%')->get();
        }else{
            $data = pizza::orderBy('pizza_id','desc')->get();
        }
            $csvExporter = new \Laracsv\Export();

            $csvExporter->build($data, [
                'pizza_id' => 'Id',
                'pizza_name' => 'Pizza name',
                'price' => 'Normal price',
                'discount_percentage' => 'Discount percentage',
                'quantity' => 'Instock',
                'created_at' => 'Created at',
                'updated_at' => 'Updatede at',
            ]);

            $csvReader = $csvExporter->getReader();
            $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

            $filename = 'pizzaList19822.csv';

            return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

    }

    //pizza insert
    public function pizzaInsert(Request $request){
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'ps' => 'required',
            'discountPercentage' => 'required',
            'oldNew' => 'required',
            'stockItem' => 'required',
            'category' => 'required',
            'type' => 'required',
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
        $discount_price = $request->price * ($request->discountPercentage/100);
        // dd($discount_price);
        // dd($name);


        $data = [
            'pizza_name' => $request->name,
            'image' => $name,
            'price' => $request->price,
            'publish_status' => $request->ps,
             'discount_price' => $discount_price,
            'discount_percentage' => $request->discountPercentage,
            'new'=>$request->oldNew,
            'quantity' => $request->stockItem,
            'category_id' => $request->category,
            'type' => $request->type,
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
        $categoryData = category::get();
        $typeData = Type::get();
        return view('admin.pizza.edit')->with(['data'=>$data,'categoryData'=>$categoryData, 'typeData' => $typeData]);
    }



    //pizza update
    public function pizzaUpdate($id,Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'ps' => 'required',
            'state' => 'required',
            'discount_percentage' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'bg' => 'required',
            'wt' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

    $discount_price = ($request->price) * ($request->discount_percentage/100);
    // dd($discount_price);
    $data = [
        'pizza_name' => $request->name,
        'new' => $request->name,
        'price' => $request->price,
        'discount_percentage' => $request->discount_percentage,
        'quantity' => $request->quantity,
        'publish_status' => $request->ps,
        'discount_price' => $discount_price,
        'category_id' => $request->category_id,
        'type' => $request->type,
        'buy_one_get_one' => $request->bg,
        'waiting_time' => $request->wt,
        'description' => $request->desc,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
    if (isset($request->image)) {
        $data['image'] = $request->image;
    //delete  update image
        $pData = pizza::where('pizza_id', $id)->first();
        $oldImg = $pData['image'];
        if(File::exists(public_path().'/uploadedImages/'.$oldImg)){
            File::delete(public_path().'/uploadedImages/'.$oldImg);
        }
        $file = $request->file('image');
                $uniqueId = uniqid();
                $name = $uniqueId.'_Adminppt_'. $file->getClientOriginalName();
                $file->move(public_path().'/uploadedImages/',$name);
                $data['image'] = $name;
    }
//update data
    pizza::where('pizza_id',$id)->update($data);
    return redirect()->route('admin#pizza')->with(['updated'=>'successfully updated!']);

    }
    //pizza details
    public function pizzaDetail($id){
        $data= pizza::where('pizza_id',$id)->first();
        $categoryData = category::get();
        // dd($categoryData);
        return view('admin.pizza.detail')->with(['data'=>$data,'categoryData'=>$categoryData]);
    }

}
