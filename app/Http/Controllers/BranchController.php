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
        return view('branch.index',compact('all_branches'));
    }

    protected function addBranchForm(){
        return view('branch.addBranchForm');
    }

    protected function addBranch(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:factory,wirehouse'],
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

    public function editBranch($id){

                 $branch = Branch::find($id);
                //  return $branch;

                return view('branch.edit_branch',compact('branch'));

    }

    public function updateBranch(Request $request, $id){
                    // return $request;
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'type' => ['required', 'string', 'in:factory,wirehouse'],
                    ]);
                    $branch_name = $request->name;
                    $branch_type = $request->type;
                    $user_id = $request->user_id;

                    $branch =Branch::find($id);
                    $branch->name = $branch_name;
                    $branch->user_id = $user_id;
                    $branch->type = $branch_type;
                    $branch->update();



                    return redirect()->route('branches')->with('success',"Updated Successful");

    }
}
