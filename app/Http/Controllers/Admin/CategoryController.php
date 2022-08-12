<?php

namespace app\Http\Controllers\Admin;


use App\Models\User;
use App\Models\pizza;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // public function index(){
    //     return view('admin.home');
    // }


   


    //category
    public function category(){
        $data = category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                    ->leftjoin('pizzas','pizzas.category_id','categories.category_id')
                    ->groupBy('categories.category_id')
                    ->orderBy('categories.category_id','desc')
        ->paginate(2); 
        // dd($data->toArray());

        return view('admin.category.list')->with(['categoriesData'=> $data] );
    }

    //addCategory
    public function addCategory(){
        return view('admin.category.addCategory');
    }

    // createCategory
    public function createCategory(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $newCategory = [
           'category_name' => $request->name
        ];
        category::create($newCategory);
        return redirect()->route('admin#category')->with(['success'=>'new category name is successfully created']);
    }

    // deleteCategory
    public function categoryDelete($id){
        // dd($id);
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleted'=>'Successfully deleted']);
    }

    // editCategory
    public function categoryEdit($id){
        $data = Category::where('category_id',$id)->first();
        // dd($data->toArray());
        return view('admin.category.editCategory')->with(['name'=> $data]);
    }

    // updateCategory
    public function updateCategory($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData = [
             'category_name' => $request->name
        ];
        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category')->with(['updated'=>'new category name is successfully updated']);
    }

    // searchCategory
    public function searchCategory(Request $request){
        // dd($request->search);
        $searchData = $request->search;
        // if ($request->search == null) {
        //   return redirect()->route('admin#category');
        // }

        $data = category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count') )
                ->leftjoin('pizzas','pizzas.category_id','categories.category_id')
                ->groupBy('categories.category_id')
                ->where('category_name','like','%'.$searchData.'%')
                ->get();
                dd($data->toArray());
                // ->paginate(2);
                // return view('admin.category.list')->with(['categoriesData'=> $data]); 
    }

    //Category Itemn
    public function categoryItem($id, Request $request){
        // dd($id);
       $data = pizza::select('*')
       ->where('pizzas.category_id',$id)
       ->join('categories','categories.category_id','pizzas.category_id')
       ->paginate(2);
    //    dd($data->toArray()['pizza_name']);

       return view('admin.category.categoryItem')->with(['pizzaData' => $data]);
    }
   
    //Category Item Search 
    public function categoryItemSearch(Request $request){
        
        dd($request->all());
    }

    // Category Item Delete
    public function categoryItemDelete($id){
        $pizzaImage = pizza::select('image')->where('pizza_id',$id)->first();  
        $pizzaImageName = $pizzaImage['image'];
            // dd($pizzaImage);
        if(File::exists(public_path().'/uploadedImages/'.$pizzaImageName)){
            File::delete(public_path().'/uploadedImages/'.$pizzaImageName);
        }
        pizza::where('pizza_id',$id)->delete();
        return back()->with(['successDelete'=> 'Successfully Deleted!']);       
    }

    //user
    public function user(){
        return view('admin.user.customer');
    }

    //order
    public function order(){
        return view('admin.order.sort');
    }

    //carrier
    public function carrier(){
        return view('admin.carrier.delivery');
    }

    
}
