<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use App\Models\WholeSeller;
use Illuminate\Http\Request;
use App\Models\WholeSellerOrder;

class WholeSellerController extends Controller
{
    public function index(){

        if(auth()->user()->role == "admin"){
            $branch= Branch::where('user_id', auth()->user()->id)->first('id');
            $condition= ['whole_seller_orders.branch_id','=', $branch->id];
            $condition2= [['whole_seller_orders.status','!=', 'cancel']];
       }else if(auth()->user()->role == "whole_seller"){
           $whole_seller = WholeSeller::where('user_id', auth()->user()->id)->first('id');
           $condition= ['whole_seller_orders.whole_seller_id','=', $whole_seller->id];
           $condition2= [['whole_seller_orders.id','!=',0]];
       }else if(auth()->user()->role == "account"){
           $condition= ['whole_seller_orders.id','!=',0];
           $condition2 = [['whole_seller_orders.status', '!=','pending'], ['whole_seller_orders.status', '!=','cancel']];
       }
       else{
           $condition= ['whole_seller_orders.id','!=',0];
           $condition2= [['whole_seller_orders.id','!=',0]];
       }

       $orders = WholeSellerOrder::join('branches', 'whole_seller_orders.branch_id','=','branches.id')
       ->join('whole_sellers', 'whole_sellers.id', '=', 'whole_seller_orders.whole_seller_id')
       ->join('products', 'products.id', '=', 'whole_seller_orders.product_id')
       ->join('grades','products.grade_id', '=', 'grades.id')
       ->join('users' , 'whole_sellers.user_id', '=', 'users.id')
       ->where([$condition])
       ->where($condition2)
       ->select('whole_seller_orders.id','users.name as whole_seller_name', 'products.name as      product_name', 'branches.name as branch_name', 'whole_seller_orders.qty', 'whole_seller_orders.date', 'whole_seller_orders.status','grades.name as grade_name','products.price')
       ->get();



        return view('order.whole_sellers_orders',compact('orders'));
    }
    public function create()
    {
        //  $branches = Branch::get();
        // $sr = Sr::where('user_id', auth()->user()->id)->first('id');
        // $distributors = Distributor::where('sr_id', $sr->id)->get();
        // $product_information = Product::join('grades','products.grade_id','=','grades.id')
        // ->select('products.id as product_id','products.name as product_name','grades.name as   grade_name')
        // ->get();
         $wholeSeller = WholeSeller::where('user_id', auth()->user()->id)->first('id');
         $product_information = Product::join('grades','products.grade_id','=','grades.id')
         ->select('products.id as product_id','products.name as product_name','grades.name as   grade_name')
         ->get();


         return view('order.whole_seller_place_order',compact('product_information'));
    }

    public function store(Request $request)
    {
            $product_id = $request->product_id;
            $qty = $request->request_qty;
            $date = $request->in_date;

            $request->validate([
                "product_id" => ['required','numeric'],
                "request_qty" => ['required','numeric'],
                'in_date' => ['required', 'date'],
            ]);

        $wholeSeller = WholeSeller::where('user_id', auth()->user()->id)->first(['id','branch_id']);
            $orders = new WholeSellerOrder;
            $orders->whole_seller_id = $wholeSeller->id;
            $orders->branch_id = $wholeSeller->branch_id;
            $orders->product_id = $product_id;
            $orders->qty =$qty ;
            $orders->status = "pending";
            $orders->date =  $date;
            $orders->save();
            return back()->with('success', "Order Place successful");

    }

    protected function changeStatus(Request $request){

        $orders = WholeSellerOrder::find($request->id);
        $product_id= $orders->product_id;
        $branch_id=  $orders->branch_id;
        $orders_qty = $orders->qty;


        $stock = Stock::where('product_id', $product_id)->where('branch_id', $branch_id)->first();

        if($request->data== 'delivered' && $orders->qty > $stock->qty){
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
