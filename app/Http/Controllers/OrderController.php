<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //OrderList Page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')->leftJoin('users','users.id','orders.user_id')->orderBy('created_at','desc')->paginate(5);
        // dd($order);
        return view("admin.order.list",compact('order'));
    }
    //Sort with order status
    public function orderStatus(Request $request){
        logger($request->all());
        if($request->order_status == null){
            $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->get();
        }else{
            $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->where('orders.status',$request->order_status)
                    ->get();
        }
        return view("admin.order.list",compact('order'));
    }
    public function statusChange(Request $request){

        logger($request->all());
        Order::where('id',$request->orderID)->update([
            'status' => $request->status
        ]);
        $order = Order::select('orders.*','users.name as user_name')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->where('orders.status',$request->status)
                    ->get();
        return response()->json($order,200);

    }
    public function orderInfo($orderCode){

        $orderList = OrderList::select('order_lists.*','users.name as user_name','users.*','products.name as product_name','products.image','products.price as each_price')
                    ->LeftJoin('users','users.id','order_lists.user_id')
                    ->LeftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();

                    $finalSum = 0;
        for($i=0; $i<count($orderList); $i++){
            $finalSum += $orderList[$i]->each_price*$orderList[$i]->qty;
        }
        $finalSum += 10000;

        return view('admin.order.orderListDetails',compact('orderList','finalSum'));
    }
}
