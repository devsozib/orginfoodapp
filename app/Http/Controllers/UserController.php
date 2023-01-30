<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Branch;
use App\Models\Sr;
use App\Models\WholeSeller;

class UserController extends Controller
{

    protected function index(){
        $users = User::leftJoin('branches', 'branches.user_id','=','users.id')
        ->select('users.id','users.name as user_name','users.email','users.role','branches.name as branch_name')
        ->whereNot('users.role','super_admin')
        ->get();

        return view('users.index',compact('users'));

    }
  public function allAdmin(){
    $users = User::leftJoin('branches', 'branches.user_id','=','users.id')
    ->select('users.id','users.name as user_name','users.email','users.role','branches.name as branch_name')
    ->where('users.role','admin')
    ->get();


    return view('users.admins',compact('users'));
  }

  public function allSrs(){
            $srs = User::join('srs','srs.user_id','=','users.id')
            ->join('branches','srs.branch_id','=','branches.id')
            ->select('users.id','users.name as user_name','branches.name as branch_name','users.email','srs.phone as phone')
            ->get();
            return view('users.srs',compact('srs'));
  }
    protected function wholeSellers(){
         $whole_sellers = User::join('whole_sellers', 'whole_sellers.user_id','=','users.id')
        ->join('branches','branches.id','=','whole_sellers.branch_id')
        ->select('users.id','users.name as user_name','users.email','users.role','branches.name as branch_name')
        ->where('users.role','whole_seller')
        ->get();
        return view('users.whole_sellers',compact('whole_sellers'));
    }
    protected function create($user_type=null){
        $branches = Branch::where('is_deleted', 0)->get();
        // return $branches;
        $branches_for_sr = Branch::where('is_deleted', 0)->where('type','wirehouse')->get();
        return view('users.create',compact('branches','branches_for_sr','user_type'));
    }

    protected function storeAdmin(Request $request){
        //   return $request->all();
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
             return redirect()->route('all_admin')->with('success',"Admin Insert successfully");
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
             return redirect()->route('all_srs')->with('success',"SR Insert successfully");
    }

    protected function storeWholeSeller(Request $request){

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
             $user->role = 'whole_seller';
             $user->password = Hash::make($request->password);
             $user->save();
             $whole_seller = new WholeSeller;
             $whole_seller->user_id =  $user->id;
             $whole_seller->branch_id =  $request->branch_id;
             $whole_seller->address =$request->address;
             $whole_seller->phone =$request->phone;

             $whole_seller->save();
             return redirect()->route('whole_sellers')->with('success',"Whole Seller Insert successfully");
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
          else if($users->role == 'whole_seller'){
            $whole_sellers = User::join('whole_sellers','users.id','=','whole_sellers.user_id')
            ->where('users.id',$id)
            ->select('users.id','users.name as whole_seller_name', 'users.email','whole_sellers.address', 'whole_sellers.phone','whole_sellers.user_id','whole_sellers.branch_id')->first();
            return view('users.edit_whole_sellers',compact('whole_sellers'));
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

    public function updateWholeSeller(Request $request, $id){
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
               $whole_form_user  = User::find($id);

               $whole_form_user->name = $name;
               $whole_form_user->email = $email;
               $whole_form_user->password = Hash::make($password);
               $whole_form_user->update();
               $whole_seller = WholeSeller::where('user_id', $id)->first();

               $whole_seller->user_id = $id;
               $whole_seller->branch_id = $branch_id;
               $whole_seller->address = $address;
               $whole_seller->phone = $phone;
               $whole_seller->update();

               return redirect()->route('users')->with('success', 'Updated Success');

}

}
