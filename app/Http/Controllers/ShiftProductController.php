<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use App\Models\ShiftProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShiftProductController extends Controller
{
   protected function index(){

       $shift_product_info = ShiftProduct::get();
       return view('shift.index',["shift_product_info"=> $shift_product_info, ]);
   }

   public function create()
   {
        $branches = Branch::get()->where('type', 'wirehouse');

        $branch = Branch::where('user_id', auth()->user()->id)->first('id');
        $products = Stock::join('products', 'products.id', '=', 'stocks.product_id')
        ->where('stocks.branch_id', $branch->id)
        ->get();

       return view('shift.create', compact('products', 'branches'));
   }




protected  function store(Request $request){

    $request->validate([
        'product_id'=>'required','numeric',
        'branch_id'=>'required','numeric',
        'qty' => 'required', 'numeric'
         ]);
        $branch_id = Branch::where('user_id', auth()->user()->id)->first('id');

        $old_stock_qty = Stock::where('branch_id',$branch_id->id)->where('product_id',$request->product_id)->first();


         if($request->qty <= $old_stock_qty->qty){
            $stockData = new ShiftProduct;
            $stockData->branch_id = $request->branch_id;
            $stockData->product_id = $request->product_id;
            $stockData->qty = $request->qty;
            $stockData->date= Carbon::now();
            $stockData->save();

            $old_stock_qty->qty -= $request->qty;
            $old_stock_qty->update();

            return back()->with('success', "Insert successfully");
         }
         else{
            return back()->withErrors(['qty'=> "Quantity is not available"]);
         }


}
}
