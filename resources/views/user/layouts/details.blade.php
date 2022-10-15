@extends('user.layouts.master')
@section('title','details page')
@section('content')
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30" style="object-fit: cover">
            <img src="{{asset('storage/'.$pizza->image)}}" alt=""s style="height:370px">
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <div class="d-flex justify-content-between">

                    <h3>{{$pizza->name}}</h3><small><i class="fas fa-eye"></i>{{$pizza->view_count + 1}}</small>
                </div>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>

                </div>
                <div class="d-flex align-items-center">
                    <h3 class="font-weight-semi-bold mb-4 me-3">{{$pizza->price}} kyats </h3>
                </div>

                <p class="mb-4">{{$pizza->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" id="orderCount" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" id="addCart">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{Auth::user()->id}}" id="userID">
                    <input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{$pizza->id}}" id="productID">

                    <button class="btn btn-primary px-3" type="button" id="cart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $list)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <div style="height:180px" class="d-flex align-items-center justify-content-center">
                                    <img class="img-fluid" src="{{asset('storage/'.$list->image)}}" style="width:50%" >
                                </div>

                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#details',$list->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$list->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$list->price}} kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
</div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            //increase view count
            $.ajax({
                    type:'get',
                    dataType: 'json',
                    url: 'http://localhost:8000/user/ajax/increase/viewCount',
                    data: {'productID': $('#productID').val()},
                })

            //click add to cart button
            $('#cart').click(function(){

                $source = {
                    'userID' : $('#userID').val(),
                    'productID' : $('#productID').val(),
                    'count' : $('#orderCount').val()
                }
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/addCart',
                    data: $source,
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 'success'){
                            window.location.href = 'http://localhost:8000/user/home';
                        }
                    }
                })
            });
        })

    </script>
@endsection
