<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //profile
     public function profile(){
        $userID = auth()->user()->id; //2
        $ID =User::where('id',$userID)->first();
        // dd($userID);
        // dd($ID->toArray());        
        return view('admin.profile.index')->with(['userID' => $ID]);
    }
    //update profile
    public function profileUpdate($id, Request $request){
        
        $updateData = [
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $userData = User::where('id',$id)->update($updateData);
        // dd($userData->toArray());
        return back()->with(['updateSuccess'=>'Success ! Profile is up to date right now....']);
    }


    //password change and confirm

    public function passwordChange(){

        return view('admin.profile.passwordChange');
    }

    public function checkPassword($id, Request $request){
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',

        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        $userdata= User::where('id',$id)->first()->toArray();
        $databasepassword = $userdata['password'];        
        if (Hash::check($oldpassword, $databasepassword)) {
            if($newpassword != $confirmpassword){
                return back()->with(['newpasswordError' => 'Incorrect Credentials....']);
            }else{
                if(strlen($newpassword) < 6 || strlen($confirmpassword) < 6){
                    return back()->with(['passwordLengthError' => 'update password character must be at least 6....']);
                }else{
                    $hashpassword =  Hash::make($newpassword);
                    $data = [
                        'password' => $hashpassword,
                    ];
                    User::where('id',$id)->update($data);
                    return redirect()->route('admin#profile')->with(['successChanged'=> 'password change process finished...']);
                }
            }
        }else{
            return back()->with(['oldpasswordError' => 'Incorrect Credentials....']);
        }
    }
}
