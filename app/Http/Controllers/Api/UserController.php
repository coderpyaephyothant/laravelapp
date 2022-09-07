<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function List(){
        $usersData = User::where('role','user')->get();
        $data = $usersData->toArray();
        return Response::json([
            'status' => '200',
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function detailUser(Request $request){
        $userId = $request->user_id;
        $userData = User::where('id',$userId)
                        ->where('role','user')->first();

        if ($userData) {
            $data = $userData->toArray();
           return Response::json([
            'status' => '200',
            'message' => 'success',
            'data' => $data,
           ]);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentails.. Please Try Again...',
            ]);
        }

    }

    public function createUser(Request $request){

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
        $password = Hash::make($request->password); //checked.
        $phone = $request->phone;
        $address = $request->address;
        $role = 'user';


        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'phone' => $phone,
            'role' => $role,
        ];



        User::create($data);
        return Response::json([
            'status' => '200',
            'message' => 'Successfully Created',
        ]);





    }

    public function updateUser(Request $request){
        $userId = $request->userId;
        $name = $request -> name;
        $email = $request->email;
        $password = $request->password;
        $address = $request->address;
        $phone = $request->phone;

        if ($userId) {
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
           $dbUser =  User::where('id',$userId)->first();
           if ($dbUser) {
            $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'address' => $address,
            'phone' => $phone,
            ];

            User::where('id',$userId)->update($data);
            return Response::json([
                'status' => '200',
                'message' => 'successfully updated',
            ]);


           }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials...',
            ]);
           }
        }
    }

    public function deleteUser(Request $request){
        $userId = $request->userId;
        $deleteId = User::where('id',$userId)->first();
        if ($deleteId) {
            User::where('id',$userId)->delete();
            return Response::json([
                'status' => '200',
                'message' => 'succesfully deleted..'
            ]);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect credentails..',
            ]);
        }

    }

    public function 


}
