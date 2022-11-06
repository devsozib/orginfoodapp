<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use App\Models\FactoryStock;
use App\Models\StockinHistory;
use App\Models\Notification;
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
    public function rawProductStock(){
          if(auth()->user()->role =="admin"){
            $branch = Branch::where('user_id',auth()->user()->id)->first();
            $condition = ['branch_id',$branch->id];
          }else{
            $condition = ['branch_id','!=',0];
          }

          $factoryStock = FactoryStock::join('raw_products','raw_products.id','=','factory_stocks.raw_product_id')
          ->join('branches','branches.id','=','factory_stocks.branch_id')
          ->where([$condition])
          ->select('raw_products.name as product_name','branches.name as branch_name','factory_stocks.qty','raw_products.unit')
          ->get();
          return view('stock.rawProductStock',compact('factoryStock'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::get();
        $products = Product::get();
        return view('stock.create', compact('products','grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $product_id = $request->product_id;
         $qty = $request->qty;

        $request->validate([
            'product_id'=>'required','numeric',
            'qty' => 'required', 'numeric'
        ]);

        $branch = Branch::where('user_id', auth()->user()->id)->first('id');
        $product = Product::where('id', $product_id)->first();

        if($branch){
            $stock_check = Stock::where('branch_id',$branch->id)->where('product_id', $product_id)->first();

            if($stock_check){
                $stock_check->qty +=  $qty;
                $stock_check->update();
                //return back()->with('success', "Updated successful");
            }else{
                $stockData = new Stock;
                $stockData->branch_id = $branch->id;
                $stockData->product_id = $product_id;
                $stockData->qty = $qty;
                $stockData->price = $qty*$product->price;
                $stockData->save();

            }

            $stockinHistory = new StockinHistory;
            $stockinHistory->branch_id = $branch->id;
            $stockinHistory->product_id = $product_id;
            $stockinHistory->qty = $qty;
            $stockinHistory->save();

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

    public function stockForSrRequest(Request $request){
        //   return $request->all();

        $newStockQty = $request->new_stock_qty;
        $stock_id = $request->stock_id;
        $request_qty = $request->request_qty;
        $notification_id = $request->notification_id;


        $stock = Stock::where('id',$stock_id)->first();
        $notification = Notification::where('id',$notification_id)->first();
        if($newStockQty >= $request_qty){
            $stock->qty += $newStockQty;
            $stock->update();
            $notification->status = '0';
            $notification->update();
            return redirect()->back()->with('success','New stock quantity added success');
        }else{
            $stock->qty += $newStockQty;
            $stock->update();
            return redirect()->back()->with('success','New stock quantity added success');
        }

    }


}
