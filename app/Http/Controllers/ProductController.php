<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    protected function index(){
        $products = Product::where('is_deleted', 0)->get();
        return view('product.index')->with(compact('products'));
    }

    protected function addProductView(){
        return view('product.addProductVidew');
    }

    protected function store(Request $request){
        $rols = [
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'in:kg,gm,Ltr,ml'],
            'price' => ['required', 'numeric'],
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('add_product')->withInput()->withErrors($validator);
		}
        else{
            try{
                $data = $request->all();
                $product = new Product;
                $product->name = $data['name'];
                $product->unit = $data['unit'];
                $product->price = $data['price'];
                $product->save();
                return redirect()->route('add_product')->with('success',"Insert successfully");
            }catch(Exception $e){
                return redirect()->route('add_product')->with('error',"operation failed");
            }
        }
    }
}
