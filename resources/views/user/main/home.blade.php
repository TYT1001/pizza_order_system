@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <label class="text-dark font-bold" for="price-all"><strong>Categories</strong></label>
                        </div>
                        <a href="{{route('user#home')}}" class="text-dark text-decoration-none">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label>All</label>
                            </div>
                        </a>
                        @foreach ($categories as $cat)
                        <a href="{{route('user#filter',$cat->id)}}" class="text-dark text-decoration-none">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label>{{$cat->name}}</label>
                            </div>
                        </a>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->


                {{-- <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->

            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="row mb-4">
                            <div class="col-3 d-flex align-items-center">
                                <div class="mx-3">
                                    <a href="{{route('user#cart')}}" class="text-dark">
                                        <i class="fas fa-cart-shopping fa-xl"></i>
                                        <span class="badge rounded-pill badge-notification bg-warning text-dark">{{count($cart)}}</span>
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <a href="{{route('user#history')}}" class="text-dark">
                                        <i class="fa-sharp fa-solid fa-clock-rotate-left"></i>
                                        <span class="badge rounded-pill badge-notification bg-warning text-dark">{{count($history)}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-center">
                                    @if(session('successPasswordChange'))

                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>{{session('successPasswordChange')}}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                    @endif
                                    @if(session('thanksGiving'))

                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{session('thanksGiving')}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    @endif
                            </div>


                            <div class="col-4 d-flex justify-content-end">
                                <div>
                                        <select name="sorting" id="sortingOption" class="form-control btn btn-dark rounded shadow-sm text-light py-2">
                                            <option value="" class="text-warning">Choose One Option</option>
                                            <option value="ascend" class="text-warning">Ascending</option>
                                            <option value="descend" class="text-warning">Descending</option>
                                        </select>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="container">
                        <div class="row d-flex" id="dataList">
                            @if (count($pizza) != null)
                                @foreach ($pizza as $p)
                                    <div class="product-item bg-light mb-3 bg-warning col-3 mx-4 " style="height:300px">
                                        <div class="product-img position-relative overflow-hidden d-flex align-items-center h-50">
                                            <img class="img-fluid " src="{{asset('storage/'.$p->image)}}" alt="" style='width:30%;left:35%;position:relative;'>
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#addCartHome',$p->id)}}" id="cart"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#details',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{$p->price}} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="w-100">
                                    <h3 class="text-center">no pizza in this category!!</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>

            $(document).ready(function(){

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

            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();
                console.log($eventOption);
                if($eventOption == 'ascend'){
                    $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/pizzaList',
                    data: {'status': 'ascend'},
                    dataType: 'json',
                    success: function(res){
                        $list = '';
                        for($i=0;$i<res.length;$i++){
                            $list += `
                                    <div class="product-item bg-light mb-3 bg-warning col-3 mx-4 " style="height:300px">
                                        <div class="product-img position-relative overflow-hidden d-flex align-items-center h-50">
                                            <img class="img-fluid " src="{{asset('storage/${res[$i].image}')}}" alt="" style='width:30%;left:35%;position:relative;'>
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#addCartHome',$p->id)}}" id="cart"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#details',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${res[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${res[$i].price} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                    `
                        }
                        $('#dataList').html($list);
                    }
                    })
                }else{
                    $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/pizzaList',
                    data: {'status': 'descend'},
                    dataType: 'json',
                    success: function(res){
                        $list = '';
                        for($i=0;$i<res.length;$i++){
                            $list += `
                            <div class="product-item bg-light mb-3 bg-warning col-3 mx-4 " style="height:300px">
                                        <div class="product-img position-relative overflow-hidden d-flex align-items-center h-50">
                                            <img class="img-fluid " src="{{asset('storage/${res[$i].image}')}}" alt="" style='width:30%;left:35%;position:relative;'>
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#addCartHome',$p->id)}}" id="cart"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#details',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${res[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${res[$i].price} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>

                                    `
                        }
                        $('#dataList').html($list);
                    }
                    })
                }
            })
        })
    </script>
@endsection

