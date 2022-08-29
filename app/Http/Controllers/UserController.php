<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Branch;
use App\Models\Sr;



class UserController extends Controller
{





    protected function index(){
        $users = User::leftJoin('branches', 'branches.user_id','=','users.id')
        ->select('users.id','users.name as user_name','users.email','users.role','branches.name as branch_name')
        ->get();
        return view('users.index',compact('users'));

    }

    protected function create(){
        $branches = Branch::where('is_deleted', 0)->get();
        // $branches_for_sr = Branch::where('is_deleted', 0)->where('type','wirehouse')->get();
        return view('users.create')->with(compact('branches'));
    }

    protected function storeAdmin(Request $request){

        $request->validate([
            'name'=>'required','string','max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8',
             ]);


             $user = new User;
             $user->name = $request->name;
             $user->email = $request->email;
             $user->role = 'admin';
             $user->password = Hash::make($request->password);
             $user->save();

             $branch = Branch::where('id', $request->branch_id)->first();
             $branch->user_id = $user->id;
             $branch->update();
             return redirect()->route('create_user')->with('success',"Insert successfully");
    }

    protected function storeSR(Request $request){

        $request->validate([
            'name'=>'required','string','max:255',
            'branch_id'=>'required','numeric',
            'address' => 'required', 'string',
            'phone' => 'required', 'string',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8',
             ]);

             $user = new User;
             $user->name = $request->name;
             $user->email = $request->email;
             $user->role = 'sr';
             $user->password = Hash::make($request->password);
             $user->save();
             $sr = new Sr;
             $sr->user_id =  $user->id;
             $sr->branch_id =  $request->branch_id;
             $sr->address =$request->address;
             $sr->phone =$request->phone;

             $sr->save();
             return redirect()->route('create_user')->with('success',"Insert successfully");
    }

    protected function createUser($data){
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user->id;
    }

}
