<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteUserController extends Controller
{
    //get all products
    public function productList(){
        $data = Product::orderBy('created_at','desc')->get();
        return response()->json($data,200);
    }
    //get all categories
    public function categoryList(){
        $data = Category::orderBy('created_at','desc')->get();
        return response()->json($data,200);
    }
    //get all contact data
    public function contactList(){
        $data = Contact::orderBy('created_at','desc')->get();
        return response()->json($data,200);
    }
    //create category
    public function createCategory(Request $requset){
        $data = $this->getCategoryData($requset);
        $response = Category::create($data);
        return response()->json($response,200);
    }
    //create contact
    public function createContact(Request $requset){
        $data = $this->getContactData($requset);
        $response = Contact::create($data);
        return response()->json($response,200);
    }
    //delete contact
    public function deleteContact($id){
        $data = Contact::where('id',$id)->first();
        // dd($data);
        if(isset($data)){
            Contact::where('id',$id)->delete();
            return response()->json(['status'=>'true','message'=>'delete success'],200);
        }
        return response()->json(['status'=>'false','message'=>'there is no contact match with this id'],404);
    }
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();
        // dd($data);
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>'true','message'=>'delete success'],200);
        }
        return response()->json(['status'=>'false','message'=>'there is no category match with this id'],404);
    }

    public function contactDetails($id){
        $data = Contact::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status'=>'success','contact'=> $data],200);
        }
        return response()->json(['status'=>'fail','contact'=> 'there is no contact!'],500);
    }

    public function contactUpdate(Request $request){

        $dbsource = Contact::where('id',$request->id)->first();
        if(isset($dbsource)){
            $data = $this->getContactData($request);
            Contact::where('id',$request->id)->update($data);
            return response()->json(['status'=>'success','contact'=> $data],200);
        }

        return response()->json(['status'=>'fail','contact'=> 'there is no contact!'],500);
    }

    private function getCategoryData($request){
        return [
            'name'=> $request->name,
            'created_at'=> Carbon::now()
        ];
    }

    private function getContactData($request){
        return [
            'name'=> $request->name,
            'email'=> $request->email,
            'message' => $request->message,
            'created_at'=> Carbon::now()
        ];
    }

}
