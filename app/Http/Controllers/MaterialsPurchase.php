<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\VendorAccount;
use Illuminate\Support\Facades\Validator;

class MaterialsPurchase extends Controller
{
   public function purchase(){
       $vendors = Vendor::get();
      return view('materials.index', compact('vendors'));
   }

   public function store(Request $request){


    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'vendor_id' => ['required', 'numeric'],
        'qty' => ['required', 'numeric','min:1'],
        'price' => ['required', 'numeric','min:1'],
        'date' => ['required'],

    ];

    $validator = Validator::make($request->all(),$rules);


    if ($validator->fails()) {
        return redirect('purchase_materials')
        ->withInput()
        ->withErrors($validator);
    }else{
        try{
            $material = new Material;
            $material->vendor_id = $request->vendor_id;
            $material->name = $request->name;
            $material->qty = $request->qty;
            $material->price =$request->price;
            $material->date = $request->date;
            $material->save();

            $vendor_account = VendorAccount::where('vendor_id',$request->vendor_id)->orderBy('id','desc')->first();
            $adjustment_balance = 0;
            if($vendor_account){
              $adjustment_balance = $vendor_account->adjustment_balance;
            }

            $total_price = $request->qty*$request->price;
            $updateAdjustment = $adjustment_balance + $total_price;


            $vendorAcc = new VendorAccount;
            $vendorAcc->vendor_id = $request->vendor_id;
            $vendorAcc->status = "0";
            $vendorAcc->amount = $request->qty*$request->price;
            $vendorAcc->adjustment_balance = $updateAdjustment;
            $vendorAcc->date = $request->date;
            $vendorAcc->save();

            if($request->payment_amount > 0){
                $vendorAccForPayment = new VendorAccount;
                $vendorAccForPayment->vendor_id = $request->vendor_id;
                $vendorAccForPayment->status = "1";
                $vendorAccForPayment->amount = $request->payment_amount;
                $vendorAccForPayment->adjustment_balance = $updateAdjustment- $request->payment_amount;
                $vendorAccForPayment->date = $request->date;
                $vendorAccForPayment->save();
         }







            return redirect()->route('purchase_materials')->with('success',"Insert successfully");
        }catch(Exception $e){

        }

    }
   }

   protected function getList(){
    $materials_list = Material::orderBy('id')->get();
    return view('materials.list', compact('materials_list'));
   }


   protected function purchaseHistory(Request $request,$id){
            $purchaseHistory = VendorAccount::join('vendors','vendors.id',"=","vendor_accounts.vendor_id")
            ->where('vendor_accounts.vendor_id',$id)
            ->get();
            // return $purchaseHistory;

            return view('materials.purchase_history', compact('purchaseHistory'));
   }

   protected function duePayment($id){
    $vendor_id = $id;
    return view('materials.due_payment',compact('vendor_id'));
   }

   protected function makeDuePayment(Request $request){
    // return $request->all();
         $request->validate([
            "amount"=>['required','numeric'],
            "date"  =>['required','date']
         ]);

         $vendor_account_last_status = VendorAccount::where('vendor_id',$request->vendor_id)->get()->last();
         $vendor_acc_adjustment_last_value = $vendor_account_last_status->adjustment_balance;

         $vendorAcc = new VendorAccount;

         $vendorAcc->vendor_id = $request->vendor_id;
         $vendorAcc->status = "1";
         $vendorAcc->amount = $request->amount;
         $vendorAcc->adjustment_balance =$vendor_acc_adjustment_last_value-$request->amount;
         $vendorAcc->date = $request->date;
         $vendorAcc->save();

         return redirect()->route('due_payment',$request->vendor_id)->with('success',"Insert successfully");

   }
}
