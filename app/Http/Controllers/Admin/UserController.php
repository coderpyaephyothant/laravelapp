<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    
    //userList
    public function userList(){
        $userRole = User::where('role','user')->paginate(2);
        return view('admin.user.userList')->with(['userRole'=>$userRole]);
    }
    //userSearch
    public function userListSearch(Request $request){
       $response =  $this->search($request,$request->table_search,'user');       
        return view('admin.user.userList')->with(['userRole'=>$response]);
    }
    private function search($request,$key,$role){
        // dd($request);
        $searchData = User::where('role', $role)
                        ->where(function ($query) use($key) {
                            $query->orWhere('name','Like','%'.$key.'%')
                            ->orWhere('email','Like','%'.$key.'%')
                            ->orWhere('address','Like','%'.$key.'%')
                            ->orWhere('phone','Like','%'.$key.'%');
                                
                        })
                        ->paginate(2);
        $searchData->appends($request->all());
                        return $searchData;
    }

    //add Users / Customers

    public function addUsers(){
        return view('admin.user.addUsers')
        ;
    }

    // create users / Customers
    public function createUsers(Request $request){
    //    dd($request->all());
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone'=>$request->phone,
        'address' => $request->address,

    ];
    User::create($data);
    return back();
    }

    //AdminList
    public function adminList(){
        $adminRole = User::where('role','admin')->paginate(2);
        return view('admin.user.adminList')->with(['adminRole'=>$adminRole]);
    }
    //AdminListSearch
    public function adminListSearch(Request $request){
        $response = $this->search($request,$request->table_search,'admin');
        return view('admin.user.adminList')->with(['adminRole'=>$response]);
    }

    //userDelete
    public function userDelete($id){
        // dd($id);
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Deleted!']);
    }
    
}
