<?php

use App\Http\Controllers\Api\RouteUserController;
use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('product/list',[RouteUserController::class,'productList']);      //READ
Route::get('category/list',[RouteUserController::class,'categoryList']);    //READ
Route::get('contact/list',[RouteUserController::class,'contactList']);  //READ
Route::post('create/category',[RouteUserController::class,'createCategory']);   //CREATE
Route::post('create/contact',[RouteUserController::class,'createContact']);     //CREATE
Route::get('delete/contact/{id}',[RouteUserController::class,'deleteContact']);     //DELETE
Route::get('delete/category/{id}',[RouteUserController::class,'deleteCategory']);   //DELETE
Route::get('contact/list/{id}',[RouteUserController::class,'contactDetails']);  //READ
Route::post('contact/update',[RouteUserController::class,'contactUpdate']);     //UPDATE

// product list
// localhost:8000/api/product/list (GET)

// category list
// localhost:8000/api/category/list (GET)

// contact list
// localhost:8000/api/contact/list (GET)

// contact details
// localhost:8000/api/contact/list/{id} (GET)

// create category
// localhost:8000/api/create/category (Post)

// create contact
// localhost:8000/api/create/contact (POST)

// update contact
// localhost:8000/api/contact/update (POST)
//  body => {
//     'id' : '',
//     'name' : '',
//     'email' : '',
//     'message' : ''
//  }

// delete contact
// localhost:8000/api/delete/contact/{id}

// delete category
// localhost:8000/api/delete/contact/{id}
