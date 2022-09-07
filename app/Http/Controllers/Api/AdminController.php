<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function List(){

        $data = User::where('role','admin')
                ->get();
        $adminData = $data->toArray();
        return Response::json([
            'status' => '200',
            'message' => 'success',
            'data' => $adminData,
        ]);
    }

    public function detailAdmins(Request $request){
        $adminId = $request->adminId;
        $checkId = User::where('id',$adminId)
                        ->where('role','admin')->first();
                        if($checkId){
                            return Response::json([
                                'staus' => '200',
                                'message' => 'success',
                                'data' => $checkId,
                            ]);
                        }else{
                            return Response::json([
                                'status' => '200',
                                'message' => 'Incorrect Credentails',
                            ]);
                        }

    }

    public function createAdmins(Request $request){
       $name = $request->name;
       $email = $request->email;
       $password =Hash::make( $request->password);
       $phone = $request->phone;
       $address = $request->address;
       $role = 'admin';

       $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'phone' => 'required',
        'address' => 'required'

    ]);

        if ($validator->fails()) {
            return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentials...',
            ]);
        }

        $data = [
           'name' => $name,
           'email' => $email,
           'password' => $password,
           'phone' => $phone,
           'address' => $address,
           'role' => $role,
        ];

        $createAdmin = User::create($data);

        if ($createAdmin) {
            return Response::json([
                'status' => '200',
                'message' => 'Successfully Created',
            ]);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials',
            ]);
        }
    }

    public function updateAdmin(Request $request){
        $adminId = $request->adminId;
        $checkAdmin = User::where('role','admin')
            ->where('id',$adminId)->first();
            if($checkAdmin){
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'phone' => 'required',
                    'address' => 'required'

                ]);

                    if ($validator->fails()) {
                        return Response::json([
                        'status' => '200',
                        'message' => 'Incorrect Credentials...',
                        ]);
                    }
                    $name = $request->name;
                    $email = $request->email;
                    $password = Hash::make($request->password);
                    $address = $request->address;
                    $phone = $request->phone;
                    $data = [
                        'name'=> $name,
                        'email' => $email,
                        'password' => $password,
                        'phone' => $phone,
                        'address' => $address,
                    ];
                    $AdminUpdate = User::where('id',$adminId)
                                    ->where('role','admin')
                                    ->update($data);
                    if($AdminUpdate){
                        return Response::json([
                            'status' => '200',
                            'message' => 'success',
                        ]);
                    }else{
                        return Response::json([
                            'status' => '200',
                            'message' => 'Incorrect Credentials',
                        ]);
                    }
            }else{
                return Response::json([
                    'status' => '200',
                    'message' => 'Incorrect Credentials',
                ]);
            }
    }

    public function deleteAdmin(Request $request){
        $AdminId = $request->adminId;
        $validator = Validator::make($request->all(), [
            'adminId' => 'required',

        ]);

        if ($validator->fails()) {
            return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentials...',
            ]);
        }
        $checkAdmin = User::where('role','admin')
                            ->where('id',$AdminId)->first();
        if ($checkAdmin) {
            User::where('role','admin')
                ->where('id',$AdminId)->delete();
            return Response::json([
                'status' => '200',
                'message' => 'Successfully Deleted',
            ]);
        }
        return Response::json([
            'status' => '200',
            'message' => 'Incorrect Credentails',
        ]);
    }
}
