<?php

namespace App\Http\Controllers;

use App\Models\Stock;

use App\Models\Branch;

use App\Models\Product;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    protected function addProductionView(){
        $products = Product::where('is_deleted', 0)->get();
        return view('product.addProductionView')->with(compact('products'));
    }

    protected function storeProduction(Request $request){

        $rols= [
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
                $branch_id = Branch::where('user_id', auth()->user()->id)->first();

                $stock_check = Stock::where('branch_id',$branch_id->id)->where('product_id', $request->product_id)->first();

             //For Production Table
                $data = $request->all();
                $production = new Production;
                $production->product_id =  $data['product_id'];
                $production->branch_id =  $branch_id->id;
                $production->qty =  $data['qty'];
                $production->date =  $data['date'];
                $production->save();

              //For Stock Table
                if($stock_check){
                    $stock_check->qty += $request->qty;
                    $stock_check->update();
                  }else{
                    $stockData = new Stock;
                    $stockData->branch_id = $branch_id->id;
                    $stockData->product_id = $request->product_id;
                    $stockData->qty = $request->qty;
                    $stockData->save();
                  }

                return redirect()->route('add_production')->with('success',"Insert successfully");



            }catch(Exception $e){
                return redirect()->route('add_production')->with('error',"operation failed");
            }
        }
    }

    protected function productionList(){
        if(auth()->user()->role == 'admin'){
            $branch_id = Branch::where('user_id', auth()->user()->id)->first('id');
            $condition = ['branch_id', '=', $branch_id->id];
        }else{
            $condition = ['branch_id', '!=', 0];
        }
        $productions = Production::join('products','products.id', '=', 'productions.product_id')
        ->where([$condition])
        ->where('productions.is_deleted', 0)
        ->select('productions.id','products.name as product_name','productions.qty', 'productions.date')
        ->get();
        return view('product.production')->with(compact('productions'));
    }

}
