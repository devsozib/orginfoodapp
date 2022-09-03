<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
   protected function index(){
    //    $vendors = Vendor::get();

        if(auth()->user()->role == 'admin') $condition = ['branches.user_id',auth()->user()->id];
        else $condition = ['branches.user_id','!=',0];


       $own_vendors = Vendor::join('branches','branches.id','=','vendors.branch_id')
       ->where([$condition])
       ->select('branches.name as branch_name','vendors.name as vendor_name', 'vendors.address','vendors.id')
       ->get();


       return view('vendors.index', compact('own_vendors'));
   }

   protected function create(){
    $admin = User::where('role', 'admin')->first('id');
    $branch = Branch::where('user_id',$admin->id)->where('type','factory')->get();

    return view('vendors.create',compact('branch'));
   }

   protected function store(Request $request){

    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string'],
        'branch_id' => ['required', 'numeric'],
    ];

    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        return redirect('create_vendors')
        ->withInput()
        ->withErrors($validator);
    }
    else{

        try{
            $vendor = new Vendor;
            $vendor->name      = $request->name;
            $vendor->address   = $request->address;
            $vendor->branch_id = $request->branch_id;
            $vendor->save();

            return redirect()->route('create_vendors')->with('success',"Insert successfully");
        }catch(Exception $e){

        }

    }
   }
}
