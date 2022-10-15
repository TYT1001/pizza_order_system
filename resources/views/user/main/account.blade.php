@extends('user.layouts.master')
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
                            @if (Auth::user()->image==null)
                            @if (Auth::user()->gender == 'male')
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset('image/default_image_male.png')}}" alt="{{Auth::user()->name}}  class="img-thumbnail shadow-sm" width="200"/>
                                                </a>
                                            </div>
                                            @else
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset('image/default_image_female.png')}}" alt="{{Auth::user()->name}}  class="img-thumbnail shadow-sm" width="200"/>
                                                </a>
                                            </div>
                                        @endif
                            @else
                            <div class="image">
                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}"  class="img-thumbnail shadow-sm" width="200"/>
                            </div>
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
                        <a href="{{route('user#edit')}}">
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
