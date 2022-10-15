@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">

        <div class="form mt-3 col-8 offset-2 rounded px-4 py-3 text-light bg-dark">
            <h3 class="text-center text-light">Edit User Profile</h3>
            <form action="{{route('user#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div>
                            <label for="">Image</label>
                            @if (Auth::user()->image==null)
                                        @if (Auth::user()->gender == 'male')
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="{{asset('image/default_image_male.png')}}" alt="{{Auth::user()->name}}" class="img-thumbnail shadow-sm" />
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="{{asset('image/default_image_female.png')}}" alt="{{Auth::user()->name}}"  class="img-thumbnail shadow-sm"/>
                                                            </a>
                                                        </div>
                                                    @endif
                                        @else
                                        <div class="image">
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}"  class="img-thumbnail shadow-sm" />
                                        </div>
                                        @endif

                            <div>
                                <input type="file" name="image" id="" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="col-7">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="" value={{Auth::user()->name}} class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name">Email</label>
                            <input type="email" name="email" id="" value={{Auth::user()->email}} class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name">Gender</label>
                            <select name="gender" id="" class="form-control">
                                <option value="male" @if (Auth::user()->gender == 'male')
                                    selected
                                @endif>Male</option>
                                <option value="female" @if (Auth::user()->gender == 'female')
                                    selected
                                @endif>Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name">Phone</label>
                            <input type="phone" name="phone" id="" value={{Auth::user()->phone}} class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name">Address</label>
                            <input type="text" name="address" id="" value={{Auth::user()->address}} class="form-control">
                        </div>
                        <div class="mt-3 w-100 d-flex justify-content-end">
                            <button class="btn btn-warning" type="submit">Update Profile</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
