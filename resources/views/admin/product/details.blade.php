@extends('admin.layouts.master')
@section('title','Password Change Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2">
                @if(session('updateInfoSuccess'))

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <div class="text-center"><strong>{{session('updateInfoSuccess')}} </strong></div>
                                <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                    @endif
                <div class="card py-3">
                    <div class="container mx-2">

                        <button class="btn btn-dark" onclick="history.back()">
                            <i class="fa-solid fa-arrow-left"></i>  Back
                        </button>
                    </div>
                    <div class="card-body">

                        <h3 class="text-center d-block title-2"><u>Pizza Info</u></h3>
                        <div class="d-flex flex-column align-items-center mt-4">
                        <div class=" title-2 d-block"><span class="mx-2">{{$pizza->name}}<small> ({{$pizza->category_name}})</small></span></div>
                        @if ($pizza->image==null)

                                <img src="{{asset('image/default_image.png')}}" alt="{{$pizza->name}}" class="img-thumbnail shadow-sm h-50"/>

                            @else

                                <img src="{{asset('storage/'.$pizza->image)}}" alt="{{$pizza->name}}"a  class="img-thumbnail shadow-sm my-3 " style="width:250px"/>

                        @endif




                                <div class="f-1 mb-2 "><article class="mx-2">{{$pizza->description}}</article></div>
                                <div class="f-1 mx-3 mb-2 d-flex align-items-start flex-column">

                                    <div><span class='col-6'>Price</span><span class="col-6" >{{$pizza->price}}</span></div>
                                    <div><span class='col-6'>WaitingTime</span><span class="col-5" >{{$pizza->waiting_time}}</span></div>

                                </div>

                            </div>


                    </div>
                    {{-- <div class="mt-2 d-flex justify-content-center">
                        <a href="{{route('admin#edit')}}">
                            <button class="btn btn-dark"><i class="fa fa-pen-to-square"></i> Edit Profile</button>
                        </a>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
