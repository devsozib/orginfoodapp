<?php

namespace App\Http\Controllers;

use App\Models\RawProduct;
use Illuminate\Http\Request;

class RawProductController extends Controller
{
    protected function rawProduct(){
        $raw_products = RawProduct::get();
        return view('raw_products.index',compact('raw_products'));
    }

    protected function addRawProduct (){
        return view('raw_products.create');
    }

    protected function storeRawProduct(Request $request){
        $request->validate([
            "name" => ["required"],
        ]);
        $rawProduct = new RawProduct;
        $rawProduct->name = $request->name;
        $rawProduct->unit = "kg";
        $rawProduct->save();
        return back()->with('success', "Insert Successful");
    }
}
