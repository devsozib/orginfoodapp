<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

          if(auth()->user()->role == 'super_admin'){
              $stocks = Stock::get();
          }else if(auth()->user()->role == 'admin'){
            $branch = Branch::where('user_id', auth()->user()->id)->first();
            $stocks = Stock::where('branch_id', $branch->id)->get();
          }
        //   $stocks = Stock::get();

          return view('stock.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $request->validate([
            'product_id'=>'required','numeric',
            'qty' => 'required', 'numeric'
             ]);

    $branch_id = Branch::where('user_id', auth()->user()->id)->first();

    $stock_check = Stock::where('branch_id',$branch_id->id)->where('product_id', $request->product_id)->first();

          if($stock_check){
            $stock_check->qty += $request->qty;
            $stock_check->update();
            return back()->with('success', "Updated successful");
          }else{
            $stockData = new Stock;
            $stockData->branch_id = $branch_id->id;
            $stockData->product_id = $request->product_id;
            $stockData->qty = $request->qty;
            $stockData->save();
            return back()->with('success', "Insert successfully");
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
