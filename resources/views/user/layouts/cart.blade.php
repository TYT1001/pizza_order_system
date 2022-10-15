@extends('user.layouts.master')
@section('title','Cart Page')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover mb-0 text-center" id="dataTable">
                    <thead class="thead-dark text-center">
                        <div class="">
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th >Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </div>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $c)
                        <tr>
                            <td>
                                <img src="{{asset('storage/'.$c->image)}}" alt="" style="width: 50px;">
                            </td>
                            <td class="align-middle text-center">{{$c->name}}</td>
                                <input type="hidden" name="" value="{{$c->id}}" id="orderID">
                                <input type="hidden" name="" value="{{$c->user_id}}" id="userID">
                                <input type="hidden" name="" value="{{$c->product_id}}" id="productID">
                            <td class="align-middle text-center" id='price'>{{$c->price}}</td>

                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn d-flex align-items-center">
                                        <button class="btn btn-sm btn-primary btn-minus rounded" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                        <input type="text" class="form-control border-0 text-center bg-transparent" value="{{$c->qty}}" id="qty">

                                    <div class="input-group-btn d-flex align-items-center">
                                        <button class="btn btn-sm btn-primary btn-plus rounded">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center" id='total'>{{($c->price)*($c->qty)}} kyats</td>
                            <td class="align-middle text-center"><button class="btn btn-sm btn-danger btnRemove rounded"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{$totalPrice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">10000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice + 10000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-2" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-2" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script src="{{asset('js/cart.js')}}"></script>
@endsection

