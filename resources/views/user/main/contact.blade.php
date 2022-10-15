@extends('user.layouts.master')
@section('title','Contact Page')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 card shadow-sm py-5 px-3 offset-3">
            <form action="{{route('user#contactRequest')}}" method="post">
                @csrf
                <h1 class="mb-3">Contact Us</h1>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name">Suggestion</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control">{{old('message')}}</textarea>
                    @error('message')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning text-white float-right w-25">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection
