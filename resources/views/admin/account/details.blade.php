@extends('admin.layouts.master')
@section('title','Account Info Page')
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

                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <div class="row py-3">
                        <div class="col-4 offset-1 d-flex align-items-center">
                            @if (Auth::user()->image == null)
                            @if (Auth::user()->gender == 'male')
                                <td class="col-2">
                                    <img src="{{asset('image/default_image_male.png')}}" alt="" class="img-thumbnail shadow-sm">
                                </td>
                            @else
                                <td class="col-2">
                                    <img src="{{asset('image/default_image_female.jfif')}}" alt="" class="img-thumbnail shadow-sm">
                                </td>

                            @endif
                        @else
                            <td>
                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="" class="img-thumbnail shadow-sm">
                            </td>
                        @endif
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <div class="">
                                <div class="f-1 mb-2"><i class="fa-solid fa-user-pen"></i><span class="mx-3">{{Auth::user()->name}}</span></div>
                                <div class="f-1 mb-2"><i class="fa-solid fa-envelope"></i><span class="mx-3">{{Auth::user()->email}}</span></div>
                                <div class="f-1 mb-2"><i class="fa-solid fa-mars-and-venus"></i><span class="mx-3">{{Auth::user()->gender}}</span></div>
                                <div class="f-1 mb-2"><i class="fa-solid fa-phone"></i><span class="mx-3">{{Auth::user()->phone}}</span></div>
                                <div class="f-1 mb-2"><i class="fa-solid fa-address-card"></i><span class="mx-3">{{Auth::user()->address}}</span></div>
                                <div class="f-1 mb-2"><i class="fa-solid fa-calendar-days"></i><span class="mx-3">{{Auth::user()->updated_at->format('j-F-Y')}}</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-2 d-flex justify-content-center">
                        <a href="{{route('admin#edit')}}">
                            <button class="btn btn-dark"><i class="fa fa-pen-to-square"></i> Edit Profile</button>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
