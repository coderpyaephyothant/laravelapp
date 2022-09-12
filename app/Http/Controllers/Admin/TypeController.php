<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    //type
    public function type(){
        if (Session::has('searchData')) {
            Session::forget('searchData');

        }
        $data = Type::select('types.*',DB::raw('COUNT(pizzas.type) as count'))
                    ->leftjoin('pizzas','pizzas.type','types.type_id')
                    ->groupBy('types.type_id')
                    ->orderBy('types.type_id','desc')
        ->paginate(5);
        return view('admin.type.type')->with(['typesData'=> $data] );
    }

    //create
    public function createType(){
        return view('admin.type.createType');
    }

    //new
     public function newType(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $newType = [
           'type_name' => $request->name
        ];
        Type::create($newType);
        return redirect()->route('admin#type')->with(['success'=>'new type menu is successfully created']);
    }
     //Type Itemn
     public function typeItem($id, Request $request){
        // dd($id);
       $data = pizza::select('*')
       ->where('pizzas.type',$id)
       ->join('types','types.type_id','pizzas.type')
       ->paginate(2);
       return view('admin.type.typeItem')->with(['pizzaData' => $data]);
    }
    // Type Item Delete
    public function typeItemDelete($id){
        $pizzaImage = pizza::select('image')->where('pizza_id',$id)->first();
        $pizzaImageName = $pizzaImage['image'];
            // dd($pizzaImage);
        if(File::exists(public_path().'/uploadedImages/'.$pizzaImageName)){
            File::delete(public_path().'/uploadedImages/'.$pizzaImageName);
        }
        pizza::where('pizza_id',$id)->delete();
        return back()->with(['successDelete'=> 'Successfully Deleted!']);
    }
        //TypeDownLoad

        public function typeDownload(){

            if (Session::has('searchData')) {
               $searchWord=  Session::get('searchData');
               $data = Type::select('types.*',DB::raw('COUNT(pizzas.type)as count') )
               ->leftjoin('pizzas','pizzas.type','types.type_id')
               ->groupBy('types.type_id')
               ->where('type_name','like','%'.$searchWord.'%')
               ->get();
            //    dd($data->toArray());

            }else{
                $data = Type::select('types.*',DB::raw('COUNT(pizzas.type) as count'))
                ->leftjoin('pizzas','pizzas.type','types.type_id')
                ->groupBy('types.type_id')
                ->orderBy('types.type_id','desc')
                ->get();
            }


                $csvExporter = new \Laracsv\Export();

                $csvExporter->build($data, [
                    'type_id' => 'Id',
                    'type_name' => 'Type name',
                    'count' => 'Qyantity',
                    'created_at' => 'Created at',
                    'updated_at' => 'Updatede at',
                ]);

                $csvReader = $csvExporter->getReader();
                $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

                $filename = 'typeMenuList19822.csv';

                return response((string) $csvReader)
                    ->header('Content-Type', 'text/csv; charset=UTF-8')
                    ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

        }

         // searchType
    public function searchType(Request $request){
        if (Session::has('searchData')) {
            Session::forget('searchData');

        }
        // dd($request->search);
        $searchData = $request->search;
        // if ($request->search == null) {
        //   return redirect()->route('admin#category');
        // }
        Session::put('searchData',$searchData);

        $data = Type::select('types.*',DB::raw('COUNT(pizzas.type)as count') )
                ->leftjoin('pizzas','pizzas.type','types.type_id')
                ->groupBy('types.type_id')
                ->where('type_name','like','%'.$searchData.'%')
                ->paginate(5);
                // dd($data->toArray());
                // ->paginate(2);
                return view('admin.type.type')->with(['typesData'=> $data]);
    }

}
