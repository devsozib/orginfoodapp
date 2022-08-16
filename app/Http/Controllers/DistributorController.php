<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\User;
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    protected function index(){
        $distributors = Distributor::get();
        return view('distributor.index', compact('distributors'));
    }

    protected function create(){

        $srS = Sr::get();
       return view('distributor.create',compact('srS'));
    }

    protected function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'sr_id' => ['required', 'numeric'],
            'address' => ['required', 'string'],
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
			return redirect('distributors')
			->withInput()
			->withErrors($validator);
		}
        else{

              $distributor = new Distributor;
            //   $distributor->sr_id = $request->sr_id;
              $distributor->name = $request->name;
              $distributor->address = $request->address;
              $distributor->save();
              return back()->with('success',"Insert successfully");
        }
    }
}
