@extends('admin.layouts.master')
@section('title','User Account Edit Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card py-3">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit User Profile</h3>
                        </div>
                        <form action="{{route('admin#userUpdate',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row py-3">
                            <div class="col-4 offset-1 d-flex flex-column">
                                <div class="mt-3">
                                <label for="image">Image</label>
                                @if ($user->image == null)

                                    @if ($user->gender == 'male')
                                        <td class="col-2">
                                            <img src="{{asset('image/default_image_male.png')}}" alt="" class="img-thumbnail shadow-sm" name="image">
                                        </td>
                                        @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                @enderror
                                    @else
                                        <td class="col-2">
                                            <img src="{{asset('image/default_image_female.jfif')}}" alt="" class="img-thumbnail shadow-sm" name="image">
                                        </td>
                                        @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    @endif
                                @else
                                <td class="col-3">
                                    <img src="{{asset('storage/'.$user->image)}}" alt="" class="img-thumbnail shadow-sm" name="image">
                                </td>
                                @error('image')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                @endif
                                <div class="mt-3">
                                    <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" placeholder="Choose your image to update">
                                        @error('image')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                </div>
                            </div>
                            </div>
                            <div class="col-6 d-flex  flex-column justify-content-center ">

                                    <div class="mt-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$user->name)}}" placeholder="Enter Admin Name">
                                    @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$user->email)}}" placeholder="Enter Admin Email">
                                        @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone',$user->phone)}}" placeholder="Enter Admin Phone">
                                        @error('phone')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="">Gender</label>
                                        <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror" value="{{old('gender',$user->gender)}}">
                                            <option value="male" @if ($user->gender == "male")
                                                selected
                                            @endif>Male</option>
                                            <option value="female" @if ($user->gender == "female")
                                                selected
                                            @endif>Female</option>
                                            <option value="others" @if ($user->gender == "others")
                                                selected
                                            @endif>Others</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address',$user->address)}}" placeholder="Enter Admin Address">
                                        @error('address')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3 w-100 d-flex justify-content-end">
                                        <button class="btn btn-dark" type="submit">Update Profile</button>
                                    </div>
                                </form>
                            </div>





                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
