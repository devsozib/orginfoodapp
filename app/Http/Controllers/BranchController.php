<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    protected function index(){
        $all_branches = Branch::get();
        return view('Branch.index',compact('all_branches'));
    }

    protected function addBranchForm(){
        return view('branch.addBranchForm');
    }

    protected function addBranch(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:factory,outlet_branch'],
        ];

        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_branch_form')
			->withInput()
			->withErrors($validator);
		}
        else{
            $data = $request->all();

            try{
                $branch = new Branch;
                $branch->name = $data['name'];
                $branch->type = $data['type'];
                $branch->save();

                return redirect()->route('add_branch_form')->with('success',"Insert successfully");
            }catch(Exception $e){
                return redirect()->route('add_branch_form')->with('error',"operation failed");
            }

        }
    }
}
