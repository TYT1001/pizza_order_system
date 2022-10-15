@extends('admin.layouts.master')
@section('title','Role Change Page')
@section('content')

<div class="main-content">

    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change User's Role</h3>
                        </div>
                        <hr>
                        <form name="name" action="{{route('admin#roleUpdate',$data->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="row px-1">
                                <div class="col-4">
                                    <label for="image">Image</label>
                                    @if ($data->image == null)
                                            @if ($data->gender == 'male')
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
                                                <img src="{{asset('storage/'.$data->image)}}" alt="" class="img-thumbnail shadow-sm">
                                            </td>
                                        @endif
                                </div>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="">Name</label>
                                        <input type="text" value="{{$data->name}}"class="form-control shadow-sm" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="email" value="{{$data->email}}" class="form-control shadow-sm" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Gender</label>
                                        <select name="gender" id="" class="form-control" disabled>
                                            <option value="male" @if ($data->gender=='male')
                                                selected
                                            @endif>Male</option>
                                            <option value="female" @if ($data->gender=='female')
                                                selected
                                            @endif>Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Phone</label>
                                        <input type="number" value="{{$data->phone}}" class="form-control shadow-sm" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Address</label>
                                        <input type="text" value="{{$data->address}}" class="form-control shadow-sm" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Role</label>
                                        <select name="role" id="" class="form-control" class="form-control shadow-sm">
                                            <option value="admin" @if($data->role=='role') selected @endif>Admin</option>
                                            <option value="user" @if($data->role=='role') selected @endif>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

