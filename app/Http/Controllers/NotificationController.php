<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\Stock;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function index(){
        return view('notification.index');
     }

     public function forNotificationData(){

        $products = Product::get();
        $branch = Branch::get();

        // return $products;

        return response()->json([$products, $branch]);
     }

     public function sendNotification(Request $request){
             $product_id = $request->notification['product_id'];
             $branch_id = $request->notification['branch_id'];
             $qty = $request->notification['qty'];
             $in_need_date = $request->notification['in_need_date'];

             $notification = new Notification;


             $sr = Sr::where('user_id', auth()->user()->id)->first('id');
             $notification->product_id = $product_id;
             $notification->branch_id = $branch_id;
             $notification->sr_id = $sr->id;
             $notification->request_quantity = $qty;
             $notification->status = '1';
             $notification->in_need_date = $in_need_date;
             $notification->save();

             return response()->json(['success'=>"Notification Send success"]);
     }

     public function seeYourSendingRequest(){

             $sr = Sr::where('user_id',auth()->user()->id)->first('id');
             if($sr){
                $condition = ['srs.id',$sr->id];
             }else{
                $condition = ['srs.id','!=',0];
             }

         $notifications = Notification::join('srs','srs.id','=','sr_id')
                                       ->join('products','notifications.product_id','=','products.id')
                                       ->join('branches','notifications.branch_id','=','branches.id')
                                       ->join('users','srs.user_id','=','users.id')
                                       ->where([$condition])
                                       ->where('status',1)
                                       ->select('users.name as sr_name','products.name as product_name','branches.name as  branch_name','notifications.request_quantity','notifications.in_need_date','products.id as product_id')
                                       ->orderBy('notifications.id','desc')
                                       ->get();
        return view('notification.list',compact('notifications'));
     }

     public function addStockForRequest($id){
          $stocks = Stock::join('products','products.id','=','stocks.product_id')
          ->join('notifications','notifications.product_id','=','products.id')
          ->where('stocks.product_id',$id)
          ->select('products.name as product_name', 'stocks.qty as qty','notifications.request_quantity')
          ->first();

          return view('notification.addStock',compact('stocks'));
     }


}
