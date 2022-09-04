<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    //direct category list page
    public function list()
    {
        $categories = Category::when(request('key'),function($p){
            $key = request('key');
            $p->where('name','like','%'.$key.'%');
        })->orderBy('created_at','desc')->paginate(5);
        // dd($categories);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    //create category
     public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        // dd($data);
        Category::create($data);
        return redirect()->route('category#list')->with(['createdSuccess'=>'Category Created...']);
    }

    //delete category
     public function delete($id)
    {
        Category::where('id',$id)->delete();
        return back();
    }

    //edit category
    public function edit($id){
        $category = Category::where('id',$id)->first();
        // dd($category);
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function update(Request $request){

        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        // dd($data);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }



    //category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|min:5|unique:categories,name,'.$request->categoryId,
        ])->validate();
    }

    //request category data
    private function requestCategoryData($request){
        return [
            'name'=> $request->categoryName
        ];
    }
}
