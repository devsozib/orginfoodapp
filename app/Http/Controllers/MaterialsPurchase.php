<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Material;
use Illuminate\Http\Request;
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
        'status' => ['required', 'string','in:due,paid'],
        'date' => ['required'],
    ];

    $validator = Validator::make($request->all(),$rules);
    //   var_dump($request->vendor_id);
    //   exit();
    //   dd($validator->errors());
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
            $material->price = $request->price;
            $material->date = $request->date;
            $material->status = $request->status;
            $material->save();

            return redirect()->route('purchase_materials')->with('success',"Insert successfully");
        }catch(Exception $e){

        }

    }
   }

   protected function getList(){
    $materials_list = Material::orderBy('id')->get();
    return view('materials.list', compact('materials_list'));
   }
}
