<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    //passwrd change page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //change password
    public function passwordChange(Request $request){
        $this->passwordValidationCheck($request);
        $dbPassword = User::where('id',Auth::user()->id)->select('password')->first()->password;    //hash value
        $clientPassword = $request->oldPassword;    //plain text
        if(Hash::check($clientPassword,$dbPassword)){
            $data = [
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('category#list')->with(['successPasswordChange'=>'Success Password Change!']);
        };
        return back()->with(['notMatch'=>'Old password is not correct!']);
    }

    public function details() {
        return view('admin.account.details');
    }

    public function edit(){
        // $userInfo = User::where('id',$id)->first();
        return view('admin.account.edit');
    }
    //
    public function update($id , Request $request){
        $this->AccUpdateValidationCheck($request);
        $data = $this->getUpdateData($request);
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            $data['image'] = $fileName;
            $request->file('image')->storeAs('public',$fileName);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateInfoSuccess'=>'Admin Info Updated Success']);
    }

    // admin List
    public function list(){
        $admin = User::when(request('key'),function($query){
            $key = request('key');
            $query->orWhere('name','like','%'.$key.'%')
                ->orWhere('email','like','%'.$key.'%')
                ->orWhere('gender','like','%'.$key.'%')
                ->orWhere('address','like','%'.$key.'%')
                ->orWhere('phone','like','%'.$key.'%');
        })->where('role','admin')->orderBy('created_at','desc')->paginate(3);
        // dd($admin->toArray());
        $admin->appends(request()->all());
        // dd($admin);
        return view("admin.account.list",compact('admin'));
    }
    // delete admin
    public function delete($id){
         User::where('id',$id)->delete();
         return back()->with(['deleteSuccess'=>'Delete Success!']);
    }
    // direct to role change page
    public function roleChangePage($id){
        $data = User::where('id',$id)->first();
        // dd($data);
        return view('admin.account.roleChangePage',compact('data'));
    }
    // update role
    public function updateRole(Request $request,$id){
        $updatedRole = $this->requestedUpdateData($request);
        User::where('id',$id)->update($updatedRole);
        return redirect()->route('admin#list')->with(['changeRoleSuccess'=>'role change success!']);
    }
    public function changeRole(Request $request){
        logger($request->all());
        User::where('id',$request->adminID)->update([
            'role'=>$request->role
        ]);
    }
    private function requestedUpdatedata($request){
        return [
            'role'=> $request->role
        ];
    }
    private function AccUpdateValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender' => 'required',
            'address'=>'required',
            'image' => 'mimes:jpg,jpeg,png,jfif|file'
        ])->validate();
    }
    private function getUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'image' => $request->image,
            'updated_at' => Carbon::now()
        ];
    }
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
}
