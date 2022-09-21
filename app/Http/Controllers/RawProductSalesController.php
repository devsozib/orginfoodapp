<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Consumer;
use App\Models\RawProduct;
use App\Models\FactoryStock;
use Illuminate\Http\Request;
use App\Models\RawProductSale;
use App\Models\ConsumerAccount;

class RawProductSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawProducts = RawProductSale::join('raw_products', 'raw_products.id','=','raw_product_sales.raw_product_id')
        ->join('consumers','consumers.id','=','raw_product_sales.consumer_id')
        ->join('branches','branches.id','=','raw_product_sales.branch_id')
        ->select('raw_products.name as proName', 'consumers.name as consumerName','branches.name as branch_name','raw_product_sales.qty','raw_product_sales.total_amount','raw_product_sales.date')
        ->get();
        // return $rawProducts;
        return view('raw_product_sale.index',compact('rawProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rawProducts = FactoryStock::join('raw_products','factory_stocks.raw_product_id','=','raw_products.id')->where('factory_stocks.qty', '>' ,0)
        ->select('raw_products.name as proName', 'factory_stocks.raw_product_id as id')
        ->get();
        $branch = Branch::where('user_id', auth()->user()->id)->first();
        $consumers = Consumer::where('branch_id',$branch->id)->get();
        return view('raw_product_sale.create',compact('rawProducts','consumers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $raw_product_id = $request->raw_product_id;
         $consumer_id = $request->consumer_id;
         $date = $request->date;
         $quantity = $request->qty;
         $collection_amount = $request->collection_amount;

         $request->validate([
            'raw_product_id' => ['required','numeric'],
            'consumer_id'=>['required','numeric'],
            'date'=>['date','required'],
            'qty' =>['required','numeric'],
         ]);
         $branch = Branch::where('user_id', auth()->user()->id)->first();

         $rawProduct = RawProduct::where('id',$raw_product_id)->first('price');
         $factoryStock = FactoryStock::where('raw_product_id',$raw_product_id)->where('qty','>',0)->first();
         //  return $factoryStock;

         $total_price = $quantity* $rawProduct->price;
         if($factoryStock){
            $sale = new RawProductSale;
            $sale->raw_product_id = $raw_product_id;
            $sale->consumer_id = $consumer_id;
            $sale->branch_id = $branch->id;
            $sale->date = $date;
            $sale->qty = $quantity;
            $sale->total_amount = $total_price;
            $sale->save();
            $factoryStock->qty -= $quantity;
            $factoryStock->update();
         }else{
            return redirect()->back()->with('warning','You have no available stock');
         }

         $consumerAccount = ConsumerAccount::where('consumer_id',$consumer_id)->orderBy('id','desc')->first();

         $adjustment_balance = 0;

         if($consumerAccount){
            $adjustment_balance = $consumerAccount->adjustment_balance;
         }

         $updateAdjustmentBalance =  $adjustment_balance + $total_price;

         $consumerAcc = new ConsumerAccount;
         $consumerAcc->consumer_id =   $consumer_id;
         $consumerAcc->branch_id = $branch->id;
         $consumerAcc->status = '0';
         $consumerAcc->amount = $total_price;
         $consumerAcc->adjustment_balance = $updateAdjustmentBalance;
         $consumerAcc->date = $date;
         $consumerAcc->save();
         if( $collection_amount  > 0){
             $consumerAccForPayment = new ConsumerAccount;
             $consumerAccForPayment->consumer_id =   $consumer_id;
             $consumerAccForPayment->branch_id = $branch->id;
             $consumerAccForPayment->status = '1';
             $consumerAccForPayment->amount =  $collection_amount;
             $consumerAccForPayment->adjustment_balance = $updateAdjustmentBalance - $collection_amount;
             $consumerAccForPayment->date = $date;
             $consumerAccForPayment->save();
         }

         return redirect()->back()->with('success', 'Raw Product Sale Success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
