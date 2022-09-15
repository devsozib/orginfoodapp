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
        ->whereNot('users.role','super_admin')
        ->get();
        return view('users.index',compact('users'));

    }

    protected function create(){
        $branches = Branch::where('is_deleted', 0)->get();
        // return $branches;
        $branches_for_sr = Branch::where('is_deleted', 0)->where('type','wirehouse')->get();
        return view('users.create')->with(compact('branches','branches_for_sr'));
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

    public function editUser($id){
        //   return $id;
          $users= User::where('id',$id)->first('role');
        //   return $users->role;
          if($users->role == 'admin'){
              $admin = User::where('id',$id)->first();
            //   return $admin->id;
              return view('users.admin_edit',compact('admin'));
          }else if($users->role == 'sr'){
            $sr = User::join('srs','users.id','=','srs.user_id')
            ->where('users.id',$id)
            ->select('users.id','users.name as srs_name', 'users.email','srs.address', 'srs.phone','srs.user_id','srs.branch_id')->first();

            return view('users.sr_edit',compact('sr'));
          }
          else{
              return redirect()->back()->with('error','You are hit illegal route');
          }
    }

    public function updateAdmin(Request $request, $id){
                $request->validate([
                    'name'=>'required','string','max:255',
                    'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                    'password' => 'required', 'string', 'min:8',
                    ]);
                    $name = $request->name;
                    $email = $request->email;
                    $password = $request->password;

                    $admin = User::find($id);
                    $admin->name = $name;
                    $admin->role = 'admin';
                    $admin->email = $email;
                    $admin->password = Hash::make($password);
                    $admin->update();
                return redirect()->route('users')->with('success','Update Success');
    }

    public function updateSr(Request $request, $id){
            $request->validate([
                'name'=>'required','string','max:255',
                'address' => 'required', 'string',
                'phone' => 'required', 'string',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                'password' => 'required', 'string', 'min:8',
                ]);

                   $name = $request->name;
                   $email = $request->email;
                   $address = $request->address;
                   $phone = $request->phone;
                   $password = $request->password;
                   $branch_id = $request->branch_id;
                   $sr_form_user  = User::find($id);

                   $sr_form_user->name = $name;
                   $sr_form_user->email = $email;
                   $sr_form_user->password = Hash::make($password);
                   $sr_form_user->update();
                   $sr = Sr::where('user_id', $id)->first();

                   $sr->user_id = $id;
                   $sr->branch_id = $branch_id;
                   $sr->address = $address;
                   $sr->phone = $phone;
                   $sr->update();

                   return redirect()->route('users')->with('success', 'Updated Success');

    }
}
