<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        if(auth()->user()->role == "admin"){
             $branch= Branch::where('user_id', auth()->user()->id)->first('id');
             $condition= ['orders.branch_id','=', $branch->id];
            $condition2= [['orders.status','!=', 'cancel']];
        }else if(auth()->user()->role == "sr"){
            $sr = Sr::where('user_id', auth()->user()->id)->first('id');
            $condition= ['orders.sr_id','=', $sr->id];
            $condition2= [['orders.id','!=',0]];
        }else if(auth()->user()->role == "account"){
            $condition= ['orders.id','!=',0];
            $condition2 = [['orders.status', '!=','pending'], ['orders.status', '!=','cancel']];
        }
        else{
            $condition= ['orders.id','!=',0];
            $condition2= [['orders.id','!=',0]];
        }

        // return  $condition2;

        $orders = Order::join('branches', 'orders.branch_id','=','branches.id')
        ->join('srs', 'srs.id', '=', 'orders.sr_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->join('distributors', 'distributors.id', '=', 'orders.distributor_id')
        ->join('users' , 'srs.user_id', '=', 'users.id')
        ->leftJoin('stocks','stocks.product_id','=','products.id')
        ->where([$condition])
        ->where($condition2)
        ->select('orders.id','users.name as sr_name', 'products.name as product_name',    'products.price',
         'distributors.name as distributor_name', 'branches.name as branch_name', 'orders.qty', 'orders.collected_amount', 'orders.paid_amount', 'orders.date', 'orders.status','stocks.qty as available_qty')
         ->orderBy('orders.id','desc')
         ->get();

        // return  $orders;



         return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $branches = Branch::get();

         $sr = Sr::where('user_id', auth()->user()->id)->first('id');
         $distributors = Distributor::where('sr_id', $sr->id)->get();
         $product_information = Product::get();


         return view('order.placeorder',compact('distributors','product_information'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
        $product_id = $request->product_id;
        $distributors_id = $request->distributor_id;
        $qty = $request->request_qty;
        $date = $request->in_date;

        $request->validate([
            "product_id" => ['required','numeric'],
            "distributor_id" => ['required','numeric'],
            "request_qty" => ['required','numeric'],
            'in_date' => ['required', 'date'],
        ]);

        $sr = Sr::where('user_id', auth()->user()->id)->first(['id','branch_id']);
            $orders = new Order;
            $orders->sr_id = $sr->id;
            $orders->branch_id = $sr->branch_id;
            $orders->distributor_id = $distributors_id;
            $orders->product_id = $product_id;
            $orders->qty =  $qty;
            $orders->status = "pending";
            $orders->date =  $date ;
            $orders->collected_amount = 0;
            $orders->paid_amount  = 0;
            $orders->save();
            return back()->with('success', "Order Place successful");
    }

    public function collectPayment($id){

        $order = Order::findOrFail($id);
        return view('Order/collectPayment')->with(compact('order'));

    }

    public function getPayment($id){
        $order = Order::findOrFail($id);
        return view('Order/getPayment')->with(compact('order'));
    }
    public function collectEntry(Request $request){
        //dd($request->all());
        $order = Order::findOrFail($request->order_id);

        $order->collected_amount += $request->collection_amount;
        $order->save();

        $paymentHistory = PaymentHistory::where('order_id',$order->id)->first();

        $paymentHistory = new PaymentHistory;

        $paymentHistory->order_id = $order->id;
        $paymentHistory->collected_amount = $request->collection_amount;
        $paymentHistory->paid_amount = 0;
        $paymentHistory->date = $order->date;
        $paymentHistory->save();

        return back();
    }


  public function getEntry(Request $request){
        //dd($request->all());
        $order = Order::findOrFail($request->order_id);

        $order->paid_amount += $request->get_amount;
        $order->save();

        $paymentHistory = PaymentHistory::where('order_id',$order->id)->first();

        $paymentHistory = new PaymentHistory;

        $paymentHistory->order_id = $order->id;
        $paymentHistory->collected_amount = 0;
        $paymentHistory->paid_amount = $request->get_amount;
        $paymentHistory->date = $order->date;
        $paymentHistory->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    protected function changeStatus(Request $request){

            $orders = Order::find($request->id);
            $product_id= $orders->product_id;
            $branch_id=  $orders->branch_id;
            $orders_qty = $orders->qty;


            $stock = Stock::where('product_id', $product_id)->where('branch_id', $branch_id)->first();

            if(($request->data== 'delivered') && ($orders->qty > $stock->qty)){
                session()->flash('qty', 'Quantity not available');
           }
           else{
                $orders->status = $request->data;
                $orders->update();
                if($request->data== 'delivered'){
                    $stock->qty -= $orders_qty;
                    $stock->update();
                }
           }
    }
}
