<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\User;
use App\Models\Branch;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    protected function index(){

        if(auth()->user()->role == 'sr'){
            $condition = ['users.id', auth()->user()->id];
        }
        else{$condition = ['users.id', '!=', 0];}

        if(auth()->user()->role == 'admin'){
            $branch = Branch::where('user_id', auth()->user()->id)->first('id');
            $condition2 = ['srs.branch_id', $branch->id];
        }
        else{$condition2 = ['srs.branch_id', '!=', 0];}

        //dd($condition);

        $get_distributor_details = User::join('srs','srs.user_id','=','users.id')
                                       ->join('distributors','distributors.sr_id', '=','srs.id')
                                       ->where([$condition2])
                                       ->where([$condition])
                                       ->select('users.name as sr_name','distributors.name','distributors.id','distributors.address','distributors.phone')->get();

        //dd( $get_distributor_details);


        return view('distributor.index', compact('get_distributor_details'));
    }

    protected function create(){

       $srS = Sr::join('users','users.id','=','srs.user_id')
       ->select('users.name as sr_name','srs.id')
       ->get();

       return view('distributor.create',compact('srS'));
    }

    protected function store(Request $request){


         $sr = Sr::where('user_id', auth()->user()->id)->first();

         $sr_id = '';
         if($request->sr_id){
            $sr_id = $request->sr_id;
         }else{
            $sr_id= $sr->id;
         }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'sr_id' => ['numeric'],
            'phone' => ['required', 'string', 'max:20'],
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
              $distributor->sr_id = $sr_id;
              $distributor->name = $request->name;
              $distributor->phone = $request->phone;
              $distributor->address = $request->address;
              $distributor->save();
              return back()->with('success',"Insert successfully");
        }
    }

    public function paymentHistory($id){

            $paymentHistories = PaymentHistory::where('order_id',$id)->where('paid_amount','>',0)->get();
            // return $paymentHistories;
            return view('order.paymentHistory',compact('paymentHistories'));



    }
}
