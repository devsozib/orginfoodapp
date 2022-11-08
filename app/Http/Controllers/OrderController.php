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
            $condition2= ['orders.id','!=',0];
        }

        //  return  $branch->id;

      $orders = Order::join('branches', 'branches.id','=','orders.branch_id')
        ->join('srs', 'srs.id', '=', 'orders.sr_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->join('grades','products.grade_id', '=', 'grades.id')
        ->join('distributors', 'distributors.id', '=', 'orders.distributor_id')
        ->join('users' , 'users.id', '=', 'srs.user_id')
        ->leftJoin('stocks',function($join){
            $join->on('stocks.product_id','=','orders.product_id')
            ->where('stocks.branch_id', 'orders.branch_id');
        })
        ->where([$condition])
        ->where($condition2)
        ->select('orders.id','users.name as sr_name', 'products.id as product_id', 'products.name as product_name',    'products.price',
         'distributors.name as distributor_name', 'branches.name as branch_name', 'orders.qty', 'orders.collected_amount', 'orders.paid_amount', 'orders.date', 'orders.status','stocks.id as available_qty_id', 'stocks.qty as available_qty','grades.name as grade_name')
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
         $product_information = Product::join('grades','products.grade_id','=','grades.id')
         ->select('products.id as product_id','products.name as product_name','grades.name as   grade_name')
         ->get();

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
        return view('order.getPayment')->with(compact('order'));
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
        // return $request->all();
        $get_amount = $request->get_amount;
        $payment_type = $request->payment_type;
        $date = $request->date;
        $request->validate([
            'get_amount'=>['required'],
            'payment_type'=>['required'],
            'date'=>['date']
        ]);
        $order = Order::findOrFail($request->order_id);

        $order->paid_amount += $get_amount;
        $order->save();

        $paymentHistory = PaymentHistory::where('order_id',$order->id)->first();

        $paymentHistory = new PaymentHistory;

        $paymentHistory->order_id = $order->id;
        $paymentHistory->payment_type = $payment_type;
        $paymentHistory->collected_amount = 0;
        $paymentHistory->paid_amount = $request->get_amount;
        $paymentHistory->date = $date;
        $paymentHistory->save();

        return redirect()->back()->with('success','Payment collection complete');
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
                $orders->delivery_date = date('Y-m-d');
                $orders->update();
                if($request->data== 'delivered'){
                    $stock->qty -= $orders_qty;
                    $stock->update();
                }
           }
    }

    protected function getSRs(Request $request){

            $options = "<option value='' selected>All</option>";
            $branchId = $request->branch_id;
            if(auth()->user()->role == 'admin'){
                $brance = Branch::where('user_id', auth()->user()->id)->first();
                if( !($brance && $brance->type == "wirehouse") ){
                    return abort(404);
                }
                $branchId = $brance->id;
            }
            if($branchId == ""){
                $condition = ['srs.branch_id', '!=', 0];
            }else{$condition = ['srs.branch_id', '=', $branchId];}

            $srs = Sr::join('users', 'users.id', '=', 'srs.user_id')
                        ->where([$condition])
                        ->select('srs.id', 'users.name', 'srs.phone')
                        ->get();

            foreach ($srs as $sr){
                $options .=  "<option value='$sr->id'>$sr->name</option>";
            }
            return $options;

    }

    protected function getDistributors(Request $request){

        $branchId = $request->branch_id;
        $srId = $request->sr_id;
        $options = "<option value='' selected>All</option>";

        if(auth()->user()->role == 'admin'){
            $brance = Branch::where('user_id', auth()->user()->id)->first();
            if( !($brance && $brance->type == "wirehouse") ){
                return abort(404);
            }
            $branchId = $brance->id;
        }
        if(auth()->user()->role == 'sr'){
            $sr = Sr::where('user_id', auth()->user()->id)->first();
            $branchId = $sr->branch_id;
            $srId = $sr->id;
        }

        if($branchId == ""){
            $condition1 = ['branches.id', '!=', 0];
        }else{$condition1 = ['branches.id', '=', $branchId];}

        if($srId == ""){
            $condition2 = ['srs.id', '!=', 0];
        }else{$condition2 = ['srs.id', '=', $srId];}

        // return $condition1;
        $distributors = Distributor::join('srs', 'srs.id', '=', 'distributors.sr_id')
                        ->join('branches', 'branches.id', '=', 'srs.branch_id')
                        ->where('branches.type', 'wirehouse')
                        ->where([$condition1])
                        ->where([$condition2])
                        ->select('distributors.id', 'distributors.name', 'distributors.phone')
                        ->get();

        foreach ($distributors as $key => $distributor) {
            $options .= "<option value='$distributor->id'>$distributor->name</option>";
        }
        return $options;
    }

    protected function salesHistory(){

        if(auth()->user()->role  == 'super_admin'){
            $branches = Branch::where('type', 'wirehouse')->get();
            $products = Product::join('grades','products.grade_id','=','grades.id')
            ->select('products.id as product_id','products.name as product_name','grades.name as   grade_name')
            ->get();
            return view('order.salesHistory', compact('branches', 'products'));
        }

        if(auth()->user()->role  == 'admin' || auth()->user()->role  == 'sr'){
            $products = Product::join('grades','products.grade_id','=','grades.id')
            ->select('products.id as product_id','products.name as product_name','grades.name as   grade_name')
            ->get();
            return view('order.salesHistory', compact('products'));
        }
    }

    protected function salesHistoryTable(Request $request){
        $branchId = $request->branch;
        $srId = $request->sr;
        $distributorId = $request->distributor;
        $productId = $request->product;
        $from = $request->from;
        $to = $request->to;

        if(auth()->user()->role == 'admin'){
            $brance = Branch::where('user_id', auth()->user()->id)->first();
            if( !($brance && $brance->type == "wirehouse") ){
                return abort(404);
            }
            $branchId =  $brance->id;
        }


        if(auth()->user()->role == 'sr'){
            $sr = Sr::where('user_id', auth()->user()->id)->first();
            $branchId = $sr->branch_id;
            $srId = $sr->id;
        }


        if($branchId == ''){
            $condition0 = ['branches.id', '!=', 0];
        }else{
            $condition0 = ['branches.id', '=', $branchId];
        }

        if($srId == ''){
            $condition = ['srs.id', '!=', 0];
        }else{
            $condition = ['srs.id', '=', $srId];
        }
        if($distributorId == ''){
            $condition1 = ['distributors.id', '!=', 0];
        }else{
            $condition1 = ['distributors.id', '=', $distributorId];
        }
        if($productId == ''){
            $condition2 = ['products.id', '!=', 0];
        }else{
            $condition2 = ['products.id', '=', $productId];
        }

        if($from == ''){
            $from = "0000-00-00";
        }
        if($to == ''){
            $to = date('Y-m-d');
        }



        $orders = Order::join('branches', 'orders.branch_id','=','branches.id')
        ->join('srs', 'srs.id', '=', 'orders.sr_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->join('grades','products.grade_id', '=', 'grades.id')
        ->join('distributors', 'distributors.id', '=', 'orders.distributor_id')
        ->join('users' , 'srs.user_id', '=', 'users.id')
        ->where('orders.status', 'delivered')
        ->where([ $condition0])
        ->where([$condition])
        ->where([$condition1])
        ->where([$condition2])
        ->whereBetween('delivery_date',array($from,$to))
        ->select('orders.id','users.name as sr_name', 'products.name as product_name',    'products.price',
         'distributors.name as distributor_name', 'branches.name as branch_name', 'orders.qty', 'orders.collected_amount', 'orders.paid_amount', 'orders.delivery_date as date','grades.name as grade_name')
         ->orderBy('orders.id','desc')
         ->get();


        return view('order.salesHistoryTable', compact('orders'));
    }

    protected function paymentHistoryTable(Request $request){
        //return $request;
        // return 5/0;
        $branchId = $request->branch;
        $srId = $request->sr;
        $distributorId = $request->distributor;
        $productId = $request->product;
        $from = $request->from;
        $to = $request->to;

        if(auth()->user()->role == 'admin'){
            $brance = Branch::where('user_id', auth()->user()->id)->first();
            if( !($brance && $brance->type == "wirehouse") ){
                return abort(404);
            }
            $branchId =  $brance->id;
        }


        if(auth()->user()->role == 'sr'){
            $sr = Sr::where('user_id', auth()->user()->id)->first();
            $branchId = $sr->branch_id;
            $srId = $sr->id;
        }


        if($branchId == ''){
            $condition0 = ['branches.id', '!=', 0];
        }else{
            $condition0 = ['branches.id', '=', $branchId];
        }

        if($srId == ''){
            $condition = ['srs.id', '!=', 0];
        }else{
            $condition = ['srs.id', '=', $srId];
        }
        if($distributorId == ''){
            $condition1 = ['distributors.id', '!=', 0];
        }else{
            $condition1 = ['distributors.id', '=', $distributorId];
        }
        if($productId == ''){
            $condition2 = ['products.id', '!=', 0];
        }else{
            $condition2 = ['products.id', '=', $productId];
        }

        if($from == ''){
            $from = "0000-00-00";
        }
        if($to == ''){
            $to = date('Y-m-d');
        }
        $orders = PaymentHistory::join('orders','orders.id', '=', 'payment_histories.order_id')
                        ->join('branches', 'orders.branch_id','=','branches.id')
                        ->join('srs', 'srs.id', '=', 'orders.sr_id')
                        ->join('products', 'products.id', '=', 'orders.product_id')
                        ->join('grades', 'products.grade_id', '=', 'grades.id')
                        ->join('distributors', 'distributors.id', '=', 'orders.distributor_id')
                        ->join('users' , 'srs.user_id', '=', 'users.id')
                        ->where('payment_histories.paid_amount', '>', 0)
                        ->where('orders.status', 'delivered')
                        ->where([ $condition0])
                        ->where([$condition])
                        ->where([$condition1])
                        ->where([$condition2])
                        ->whereBetween('payment_histories.date',array($from,$to))
                        ->select('payment_histories.id','users.name as sr_name', 'products.name as product_name',    'products.price',
                        'distributors.name as distributor_name', 'branches.name as branch_name', 'orders.qty', 'payment_histories.collected_amount', 'payment_histories.paid_amount', 'payment_histories.date', 'grades.name as grade_name','payment_histories.payment_type')
                        ->orderBy('payment_histories.id','desc')
                        ->get();

                return view('order.paymentHistoryTable', compact('orders'));


    }

    protected function paymentHistory(){

        if(auth()->user()->role  == 'super_admin'){
            $branches = Branch::where('type', 'wirehouse')->get();
            $products = Product::join('grades','products.grade_id','=','grades.id')->select('products.id','products.name as product_name','grades.name as grade_name')->get();
            return view('order.warehousePaymentHistory', compact('branches', 'products'));
        }

        if(auth()->user()->role  == 'admin' || auth()->user()->role  == 'sr'){
            $products = Product::join('grades','products.grade_id','=','grades.id')->select('products.id','products.name as product_name','grades.name as grade_name')->get();
            return view('order.warehousePaymentHistory', compact('products'));
        }
    }
}
