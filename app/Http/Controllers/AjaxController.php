<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function pizzaList(Request $request){
        if($request->status == 'ascend'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data,200);
    }
    //Add to Cart
    public function addCart(Request $request){

        $data = $this->getRequestData($request);
        Cart::create($data);
        $response = [
            "message" => "Add to cart complete",
            "status" => "success"
        ];
        return response()->json($response,200);
        }

    public function order(Request $request){
        logger($request->all());
        $total=0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id'=> $item['user_id'],
                'product_id'=>  $item['product_id'],
                'order_code'=>  $item['order_code'],
                'qty'=>  $item['qty'],
                'total'=>  $item['total'],
            ]);
            $total += $data->total;
        }

        logger($total);

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' =>  $data->order_code,
            'total_price' => $total+10000,
        ]);

        return response()->json(['success'=>'true','message'=>'order complete'],200);
    }

    public function clearCart(){
        logger('click');
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    public function specificProduct(){

    }

    public function clearSpecificProduct(Request $request){


        Cart::where('user_id',Auth::user()->id)->where('id',$request->orderID)->delete();

    }

    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productID)->first();
        $updateViewCount = ['view_count'=> $pizza->view_count + 1];
        Product::where('id',$request->productID)->update($updateViewCount);
    }

    private function getRequestData($request){
        return [
            'user_id' => $request->userID,
            'product_id' => $request->productID,
            'qty' => $request-> count,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }
    // private function orderList($request){
    //     return [
    //         'user_id' => $request->user_id,
    //         'product_id' => $request->product_id,
    //         'qty' => $request->qty,
    //         'total' => $request->total,
    //         'order_code' =>  $request->order_code,
    //     ];
    // }

}
