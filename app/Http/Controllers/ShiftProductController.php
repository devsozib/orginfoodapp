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
       $products = Product::get();
       return view('shift.create', compact('products', 'branches'));
   }




protected  function store(Request $request){

    $request->validate([
        'product_id'=>'required','numeric',
        'branch_id'=>'required','numeric',
        'qty' => 'required', 'numeric'
         ]);

        $stockData = new ShiftProduct;
        $stockData->branch_id = $request->branch_id;
        $stockData->product_id = $request->product_id;
        $stockData->qty = $request->qty;
        $stockData->date= Carbon::now();
        $stockData->save();
        return back()->with('success', "Insert successfully");

}
}
