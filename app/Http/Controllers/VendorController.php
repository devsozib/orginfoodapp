<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
   protected function index(){
       $vendors = Vendor::get();



       return view('vendors.index', compact('vendors'));
   }

   protected function create(){
    return view('vendors.create');
   }

   protected function store(Request $request){
    $rules = [
        'name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string'],
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
            $vendor->name = $request->name;
            $vendor->address = $request->address;
            $vendor->save();

            return redirect()->route('create_vendors')->with('success',"Insert successfully");
        }catch(Exception $e){

        }

    }
   }
}
