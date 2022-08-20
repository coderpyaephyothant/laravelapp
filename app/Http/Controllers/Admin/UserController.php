<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{   
    
    //userList
    public function userList(){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $userRole = User::where('role','user')->paginate(4);
        return view('admin.user.userList')->with(['userRole'=>$userRole]);
    }

    //userListDownload
    public function userListDownload(){
        if (Session::has('searchData')) {
            $searchWord = Session::get('searchData');
            $data = User::where('role', 'user')
                ->where(function ($query) use($searchWord) {
                $query->orWhere('name','Like','%'.$searchWord.'%')
                ->orWhere('email','Like','%'.$searchWord.'%')
                ->orWhere('address','Like','%'.$searchWord.'%')
                ->orWhere('phone','Like','%'.$searchWord.'%');
                    
            })
            ->get();
        }else{
            $data = User::where('role','user')->get();
        }
            $csvExporter = new \Laracsv\Export();
                    
            $csvExporter->build($data, [
                'id' => 'Id',
                'name' => 'Name',
                'email' => 'Email',
                'address' => 'Address',
                'phone' => 'Phone'
            ]);
            
            $csvReader = $csvExporter->getReader();
            $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

            $filename = 'userList.csv';

            return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    //userSearch
    public function userListSearch(Request $request){
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $searchWord = $request->table_search;
        Session::put('searchData',$searchWord);
       $response =  $this->search($request,$request->table_search,'user');       
        return view('admin.user.userList')->with(['userRole'=>$response]);
    }
    //private function for search
    private function search($request,$key,$role){
        // dd($request);
        $searchData = User::where('role', $role)
                        ->where(function ($query) use($key) {
                            $query->orWhere('name','Like','%'.$key.'%')
                            ->orWhere('email','Like','%'.$key.'%')
                            ->orWhere('address','Like','%'.$key.'%')
                            ->orWhere('phone','Like','%'.$key.'%');
                                
                        })
                        ->paginate(4);
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
        if (Session::has('searchData')) {
            Session::forget('searchData');
        }
        $adminRole = User::where('role','admin')->paginate(4);
        return view('admin.user.adminList')->with(['adminRole'=>$adminRole]);
    }

    
    //AdminListSearch
    public function adminListSearch(Request $request){
        if(Session::has('searchData')){
            Session::forget('searchData');
        }
        $searchWord = $request->table_search;
        Session::put('searchData',$searchWord);
        $response = $this->search($request,$request->table_search,'admin');
        return view('admin.user.adminList')->with(['adminRole'=>$response]);
    }

    //userDelete
    public function userDelete($id){
        // dd($id);
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Deleted!']);
    }

    //adminLIstDownload
    public function adminListDownload(){
        if (Session::has('searchData')) {
            $searchWord = Session::get('searchData');
            $data = User::where('role', 'admin')
            ->where(function ($query) use($searchWord) {
            $query->orWhere('name','Like','%'.$searchWord.'%')
            ->orWhere('email','Like','%'.$searchWord.'%')
            ->orWhere('address','Like','%'.$searchWord.'%')
            ->orWhere('phone','Like','%'.$searchWord.'%');
                
        })
        ->get();
        }else{
            $data = User::where('role','admin')->get();
            }
            $csvExporter = new \Laracsv\Export();
                    
            $csvExporter->build($data, [
                'id' => 'Id',
                'name' => 'Admin Name',
                'email' => 'Email',
                'address' => 'Address',
                'phone' => 'Phone'
            ]);
            
            $csvReader = $csvExporter->getReader();
            $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

            $filename = 'adminList.csv';

            return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

    }
    
}
