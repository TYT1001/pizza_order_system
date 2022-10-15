<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserlistController extends Controller
{
    public function list(){
        $userList = User::where('role','user')->get();
        // dd($userList->toArray());
        return view('admin.user.list',compact('userList'));
    }
    public function userChangeRole(Request $requset){
        logger($requset->all());
        User::where('id',$requset->userID)->update(['role'=>$requset->role]);
    }
    public function userDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }
    public function userEditPage($id){
        $user = User::where('id',$id)->first();
        // dd($user);
        return view('admin.user.editPage',compact('user'));
    }
    public function userUpdate(Request $request,$id){
        $this->userUpdateValidation($request);
        $data = $this->getUserUpdateData($request);
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            $data['image'] = $fileName;
            $request->file('image')->storeAs('public',$fileName);
        }
        $user = User::where('id',$id)->update($data);
        return redirect()->route('admin#userList')->with(['updateSuccess'=>'Updated Success!!']);
    }
    private function getUserUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'address' => $request->address,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ];
    }
    private function userUpdateValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,jfif|file',
            'address' => 'required',
            'phone' => 'required|min:5'
        ])->validate();
    }
}
