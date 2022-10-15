@extends('admin.layouts.master')
@section('title','Order List Page')
@section('content')
     <!-- MAIN CONTENT-->

     <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="mb-3 ms-3">
                <a href="{{route('admin#orderList')}}" class="btn btn-dark text-light"> <i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
            <div class="container-fluid">

                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List Details</h2>

                            </div>
                        </div>

                    </div>

                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Order Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orderList as $ol)
                                <tr class="tr-shadow">
                                    <td style="padding-top:65px">{{$ol->id}}</td>
                                    <td>{{$ol->user_name}}</td>
                                    <td><img src="{{asset('storage/'.$ol->image)}}" alt="" class="img-thumbnail shadow-sm" style="height: 100px"></td>
                                    <td>{{$ol->product_name}}</td>
                                    <td>{{$ol->qty}}</td>
                                    <td>{{$ol->created_at->format('j-F-Y')}}</td>
                                    <td>{{$ol->total}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        </table>



                    </div>
                    <div class="card w-100 p-3 mt-3">
                        <h3 class="text-center">Boucher</h3>
                        <div class="mt-4">


                            <table class="table table-data2 w-75 mb-2">

                                <thead>
                                    <tr class="row">
                                        <th class="col-5">Customer Name</th>
                                        <th class="text-primary col-7">{{$orderList[0]->user_name}}</th>
                                    </tr>
                                    <tr class="row">
                                        <th class="col-5">Address and Phone</th>
                                        <th class="text-primary col-7">{{$orderList[0]->address}} | {{$orderList[0]->phone}}</th>

                                    </tr>
                                    <tr class="row">

                                        <th class="col-12">Order Code <small class="text-primary"><u>{{$orderList[0]->order_code}}</u></small></th>
                                    </tr>
                                    <tr class="row">
                                        <th class="col-12">Order Date <small class="text-primary"><u>{{$orderList[0]->created_at}}</u></small></th>
                                    </tr>

                                </thead>

                            </table>

                            <table class="table table-data2" style="border: 1px solid black">
                                <thead >
                                    <tr>
                                        <th class="col-3">Product Name</th>
                                        <th class="col-3">Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($orderList as $ol)

                                <tr class="tr-shadow">
                                    <td>{{$ol->product_name}}</td>
                                    <td>{{$ol->each_price}}</td>
                                    <td>{{$ol->qty}}</td>
                                    <td>{{$ol->total}}</td>
                                </tr>


                            @endforeach
                                <tr class="tr-shadow">
                                    <td colspan="3" class="text-success"><strong>Final Sum</strong></td>
                                    <td >{{$finalSum}}</td>
                                </tr>
                        </tbody>
                        </table>
                        </div>

                    </div>

                </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

