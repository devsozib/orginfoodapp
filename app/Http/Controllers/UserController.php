<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function index(){
        $users = User::get();
        return view('users.index',compact('users'));

    }

    protected function create(){
        return view('users.create');
    }

    protected function store(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string','in:super_admin,admin,sr,account'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'branch_id' => ['required', 'numeric'],
        ];

        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			// return redirect('add_branch_form')
			// ->withInput()
			// ->withErrors($validator);
		}
        else{
            $data = $request->all();
            \App\Models\Branch::where('id',$data['branch_id'])->first();
        }
    }
}
