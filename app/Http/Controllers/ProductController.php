<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use App\Models\Production;

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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'in:kg,gm,Ltr,ml,piece'],
            'price' => ['required', 'numeric'],
        ];
        //dd($request->all());

        $validator = Validator::make($request->all(),$rols);
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

    protected function addProductionView(){
        $products = Product::where('is_deleted', 0)->get();
        return view('product.addProductionView')->with(compact('products'));
    }

    protected function storeProduction(Request $request){

        $rols = [
            'product_id' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ];
        //dd($request->all());

        $validator = Validator::make($request->all(),$rols);
        if ($validator->fails()) {
			return redirect()->route('add_production')->withInput()->withErrors($validator);
		}
        else{
            try{
                $data = $request->all();
                $production = new Production;
                $production->product_id =  $data['product_id'];
                $production->qty =  $data['qty'];
                $production->date =  $data['date'];
                $production->save();
                return redirect()->route('add_production')->with('success',"Insert successfully");
            }catch(Exception $e){
                return redirect()->route('add_production')->with('error',"operation failed");
            }
        }
    }

    protected function productionList(){
        $productions = Production::join('products','products.id', '=', 'productions.product_id')->where('productions.is_deleted', 0)
        ->select('productions.id','products.name as product_name','productions.qty', 'productions.date')
        ->get();
        return view('product.production')->with(compact('productions'));
    }

}
