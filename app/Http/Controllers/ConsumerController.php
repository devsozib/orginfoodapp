<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Consumer;
use Illuminate\Http\Request;
use App\Models\RawProductSale;
use App\Models\ConsumerAccount;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
             $branch = Branch::where('user_id',auth()->user()->id)->first('id');
             $condition = ['branch_id', '=' , $branch->id];
        }else{
            $condition = ['branch_id', '!=', 0];
        }



        // $consumers = Consumer::join('branches','consumers.id','=','consumer_accounts.consumer_id')
        // ->where([$condition])
        // ->select('consumers.name','consumers.address','consumers.phone','consumers.id','consumer_accounts.adjustment_balance')
        // ->get();


        $consumers = Consumer::where([$condition])->get();
        // return $consumers;
        return view('consumer.index',compact('consumers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('consumer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $request->validate([
            'name' =>['required','string'],
            'address'=> ['required'],
            'phone'=> ['required','numeric'],
        ]);
        $branch = Branch::where('user_id',auth()->user()->id)->first();
        $consumer = new Consumer;

        $consumer->name = $name;
        $consumer->address = $address;
        $consumer->branch_id =$branch->id;
        $consumer->phone = $phone;

        $consumer->save();
        return redirect()->back()->with('success','Consumer created success');



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

    public function paymentHistory($id){
           $paymentHistory = ConsumerAccount::where('consumer_id',$id)->where('status',1)->get();
           $consumerName = ConsumerAccount::join('consumers','consumers.id', '=' ,'consumer_accounts.consumer_id')->where('consumer_id',$id)->first('consumers.name');

           return view('consumer.paymentHistory',compact('paymentHistory','consumerName'));
    }


    public function salesHistroy($id){
              if(auth()->user()->role == 'admin'){
                $branch = Branch::where('user_id',auth()->user()->id)->first();
                $consumer = Consumer::where('branch_id',$branch->id)->where('id',$id)->first('id');
                $condition = ['consumer_id', $consumer->id];
              }else{
                 $condition =  ['consumer_id', '=', $id];
              }
            //   return $condition;

              $salesHistory = RawProductSale::join('raw_products','raw_product_sales.raw_product_id', '=','raw_products.id')
              ->join('consumers','consumers.id','=','raw_product_sales.consumer_id')
              ->join('branches','branches.id', '=','raw_product_sales.branch_id')
              ->where([$condition])
              ->select('consumers.name as consumerName', 'raw_products.name as proName','raw_products.price','branches.name as branch_name','raw_product_sales.qty','raw_product_sales.total_amount','raw_product_sales.date')
              ->get();

              $consumerName = Consumer::where('id',$id)->first('name');
            //   return $salesHistory;

            return view('consumer.salesHistory',compact('salesHistory','consumerName'));
    }
}
