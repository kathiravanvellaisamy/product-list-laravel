<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
         $product = Product::all();

         $data = [
            'status' => 200,
            'products'=> $product
         ];

         return response()->json($data,200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'product_name'=> 'required',
            'description' => 'required',
            'price'=> 'required',
            'brand' => 'required',
            'category'=> 'required',
            'stock'=> 'required',
            'rating' => 'required'
        ]);

        if($validator->fails()){
            $data= [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data,422);
        }
        else{
            $product =new Product;

            $product->product_name=$request->product_name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->brand=$request->brand;
            $product->category=$request->category;
            $product->stock=$request->stock;
            $product->rating=$request->rating;

            $product->save();

            $data = [
                'status'=>200,
                'message'=> "Product has been uploaded!"
            ];

            return response()->json($data,200);
        }
    }
     public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'product_name'=> 'sometimes',
            'description' => 'sometimes',
            'price'=> 'sometimes',
            'brand' => 'sometimes',
            'category'=> 'sometimes',
            'stock'=> 'sometimes',
            'rating' => 'sometimes'
        ]);

        if($validator->fails()){
            $data= [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data,422);
        }
        else{
            $product = Product::find($id);

            $product->product_name=$request->product_name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->brand=$request->brand;
            $product->category=$request->category;
            $product->stock=$request->stock;
            $product->rating=$request->rating;

            $product->update();

            $data = [
                'status'=>200,
                'message'=> "Product has been Updated Successfully!"
            ];

            return response()->json($data,200);
        }
    }

    public function delete($id){
            $product = Product::find($id);
            $product->delete();
            $data = [
                'status'=> 200,
                'message' => "Product has been Removed from list"
            ];

            return response()->json($data,200);
    }

}
