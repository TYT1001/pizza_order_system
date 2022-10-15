<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','history'));
    }
    //pizza details
    public function details($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.layouts.details',compact('pizza','pizzaList'));
    }
    //pizza cart
    public function cart(){
        $cart = Cart::select('products.name','products.image','products.price','carts.*','products.id as product_id',)
        ->where('user_id',Auth::user()->id)
        ->join('products','carts.product_id','products.id')
        ->get();


        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice += $c->price * $c->qty;
        }
        // dd($totalPrice

        return view('user.layouts.cart',compact('cart','totalPrice'));
    }
    //user account update
    public function update(Request $request,$id){
        $this->AccUpdateValidationCheck($request);
        $data = $this->getUpdateData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();


            $data['image'] = $fileName;
            // dd($data);
            $request->file('image')->storeAs('public',$fileName);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#accountDetail')->with(['updateSuccess'=>'User Profile Update Success!']);

    }
    //user password change
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $dbPassword = User::where('id',Auth::user()->id)->select('password')->first()->password;//hash value
        $clientPassword = $request->oldPassword;//plain text
        if(Hash::check($clientPassword,$dbPassword)){
            $data = [
                'password'=> Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);


            return redirect()->route('user#home')->with(['successPasswordChange'=>'Success Password Change!']);
        };

        return back()->with(['notMatch'=>'Old password is not correct!']);
    }
    public function addCartHome($id){
        Cart::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$id,
            'qty'=>1,
            'create_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        return back();
    }

    public function filter($categoryID)
    {
        $pizza = Product::where('category_id',$categoryID)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','history'));
    }

    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->paginate('4');
        // dd($order);
        return view('user.main.history',compact('order'));
    }

    public function contact(){
        return view('user.main.contact');
    }
    public function contactRequest(Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return redirect()->route('user#home')->with(['thanksGiving'=>'Thanks for your suggestion']);
    }
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ];
    }
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|min:5',
        ])->validate();
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

