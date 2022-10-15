<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){
            $key = request('key');
            $query->where('products.name','like','%'.$key.'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view('admin.product.pizza',compact('pizzas'));
    }
    //Direct Create Page with categories data
    public function createPage()
    {
        $categories = Category::select('id','name')->get();

        return view('admin.product.create',compact('categories'));
    }

    //Create Product
    public function create(Request $request){

        $this->productValidationCheck($request,'create');
        $data = $this->requestedProductData($request);
        // dd($data);
        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product#list')->with(['createdSuccess'=>'Product Created...']);
    }

    //Delete Product
    public function delete($id){
        // dd($id);
        Product::where('id',$id)->delete();
        return back();
    }
    //direct to Product Detail Page
    public function details($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.details',compact('pizza'));

    }
    //direct to Product Edit Page
    public function edit($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        // dd($categories);
        return view('admin.product.edit',compact('pizza','categories'));
    }
    //update edited pizza data
    public function update(Request $request){

        $this->productValidationCheck($request,'update');
        $data = $this->requestedProductData($request);


        if($request->hasFile('pizzaImage')){
            $oldImage = Product::where('id',$request->pizzaId)->first()->image;

            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            // dd($data);
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Updated Success!!']);
    }

    private function requestedProductData($request){
        return [
            'name'=> $request->pizzaName,
            'category_id'=> $request->pizzaCategory,
            'description'=> $request->pizzaDescription,
            'price'=> $request->pizzaPrice,
            'waiting_time'=> $request->pizzaWaiting_time,
        ];
    }
    private function productValidationCheck($request, $action){

        $validationRules = [
                'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
                'pizzaCategory'=>'required',
                'pizzaDescription'=>'required|min:10',
                'pizzaPrice'=>'required',
                'pizzaWaiting_time'=>'required',
        ];
        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,jfif,png' : 'mimes:jpg,jpeg,jfif,png';
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();
    }
}


