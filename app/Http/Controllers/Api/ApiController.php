<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    // data for customers with API
    public function List(){
        $categoryData = category::get();
        $data = [

            'status' => 'success',
            'data' => $categoryData,
        ];

        return  response()->json($data);
    }

    // data create with API
    public function CreateCategory(Request $request){
        // dd($request->category_name);
        $data = [
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        // dd($data);
        $addCatDB = category::create($data);
        $response = [
            'status' => '200 OK',
            'message' => 'Success',
        ];
        return response()->json($response);

    }

    // detail data return from api with POST Method
    public function Detail(Request $request){
        // dd($request->categoryId);
        $id = $request->categoryId;
        $data = category::where('category_id',$id)->first();
        // dd($data->get()->toArray());
        if(!empty($data)){
            $response = [
                'status' => '200',
                'message' => 'success',
                'data' => $data,
            ];
            return response()->json($response);
        }else{
             return response()->json([
                'status' => '200',
                'message' => 'Incorrect Credentails',
             ]);
        }
    }

    // detail data return from api with GET Method
    public function DetailGet(Request $request, $id){
        $id = $id;
        $data = category::where('category_id',$id)->first();
        if (!empty($data)) {
            $response = [
                'status' => '200',
                'message' => 'success',
                'data' => $data,
            ];
            return Response::json($response);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials'
            ]);
        }
    }

    // delete category by GET Method
    public function deleteCategory($id){
        $categoryId = $id;
        $data = category::where('category_id',$categoryId)->first();
        if(!empty($data)){
            category::where('category_id',$categoryId)->delete();
            return Response::json([
                'status' => '200',
                'message' => 'successfully deleted.'
            ]);
        }else{
            return Response::json([
                'status' => '200',
                'message' => 'Incorrect Credentials.'
            ]);
        }
    }
}
