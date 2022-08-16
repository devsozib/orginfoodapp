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
        $users = User::get();
        return view('users.index',compact('users'));

    }

    protected function create(){
        $branches = Branch::where('is_deleted', 0)->get();
        return view('users.create')->with(compact('branches'));
    }

    protected function store(Request $request){


        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string','in:admin,sr'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'branch_id' => ['required', 'numeric'],
        ];

        if($request->all()['role'] == 'sr'){
            $rules['address'] = ['required','string', 'max:255'];
            $rules['phone'] = ['required','string', 'max:255'];
        }

        $validator = Validator::make($request->all(),$rules);

        //var_dump($request->all());
        //dd( $validator->errors());

		if ($validator->fails()) {
			return redirect()->route('create_user')->withInput()->withErrors($validator);
		}
        else{
            $data = $request->all();

            if($data['role'] == 'admin'){
                $branch = Branch::where('id',$data['branch_id'])->first();
                if($branch->user_id){
                    return redirect()->route('create_user')->with('branch_id',"This branch is already taken");
                }else{
                    try{

                        $branch->user_id = createUser($data);
                        $branch->update();
                        return redirect()->route('create_user')->with('success',"Insert successfully");
                    }catch(Exception $e){
                        return redirect()->route('create_user')->with('error',"operation failed");
                    }
                }
            }else{
                //dd($data);
                try{


                    $sr = new Sr;
                    $sr->user_id =  createuser($data);
                    $sr->branch_id = $data['branch_id'];
                    $sr->address = $data['address'];
                    $sr->phone = $data['phone'];
                    $sr->save();
                    return redirect()->route('create_user')->with('success',"Insert successfully");
                }catch(Exception $e){
                    return redirect()->route('create_user')->with('error',"operation failed");
                }
            }
        }
    }

    protected function createuser($data){
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user->id;
    }

}
