<?php

namespace app\Http\Controllers\Admin;


use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // public function index(){
    //     return view('admin.home');
    // }


    //profile
    public function profile(){
        $userID = auth()->user()->id; //2
        $ID =User::where('id',$userID)->first();
        // dd($userID);
        // dd($ID->toArray());        
        return view('admin.profile.index')->with(['userID' => $ID]);
    }


    //category
    public function category(){
        $data = category::orderBy('category_id','desc')->paginate(2); 
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
        $searchData = $request->search;
        $data = Category::where('category_name','like','%'.$searchData.'%')->paginate(2);
        return view('admin.category.list')->with(['categoriesData'=> $data]);
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
