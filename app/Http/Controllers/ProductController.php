<?php

namespace App\Http\Controllers;

use App\Http\Requests\productValidate;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        try{
            $product = product::get();
            return response()->json([
                "data"=>$product,
                "message"=>"successfully returned all the products",
                "response"=>200
            ]);
        }catch(\Exception $e){
            return response()->json([
                "data"=>null,
                "message"=>$e->getMessage(),
                "response"=>404
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"=>"required|string|max:80|unique:products",
            "notes"=>"required|string|max:460",
            "price"=>"required|numeric|min:1|max:1000"
        ]);

        if($validator->fails()){
            return response()->json([
                "data"=>null,
                "message"=>$validator->errors()->toJson(),
                "response"=>404
            ])->setStatusCode(400);

        }

        try{
            $product=product::create([
                "name"=>$request->name,
                "notes"=>$request->notes,
                "price"=>$request->price
            ]);

            return response()->json([
                "data"=>$product,
                "message"=>"successfully create product $product->name",
                "response"=>201
            ]);
        }catch(\Exception $e){
            return response()->json([
                "data"=>null,
                "message"=>$e->getMessage(),
                "response"=>400
            ])->setStatusCode(400);
        }
    }

    public function show($id)
    {
        try{
            $product=product::findorfail($id);
            return response()->json([
                "data"=>$product,
                "message"=>"successfully create product $product->name",
                "response"=>200
            ]);

        }catch(\Exception $e){
            return response()->json([
                "data"=>null,
                "message"=>$e->getMessage(),
                "response"=>404
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name"=>"required|string|max:80|unique:products,name,$id",
            "notes"=>"required|string|max:460",
            "price"=>"required|numeric|min:1|max:1000"
        ]);

        if($validator->fails()){
            return response()->json([
                "data"=>null,
                "message"=>$validator->errors()->toJson(),
                "response"=>400
            ])->setStatusCode(400);

        }

        try{
            $product = product::findorfail($id);

            $product->update([
                "name"=>$request->name,
                "notes"=>$request->notes,
                "price"=>$request->price
            ]);

            return response()->json([
                "data"=>$product,
                "message"=>"successfully updated product $product->name",
                "response"=>201
            ]);

        }catch(\Exception $e){
            return response()->json([
                "data"=>null,
                "message"=>$e->getMessage(),
                "response"=>404
            ]);
        }
    }

    function destroy($id)
    {
        try{
        $product = product::findorfail($id)->delete();
        return response()->json([
            "data"=>$product,
            "message"=>"successfully deleted product",
            "response"=>200
        ]);
        }catch(\Exception $e){
            return response()->json([
                "data"=>null,
                "message"=>$e->getMessage(),
                "response"=>404
            ]);
        }
    }

}
