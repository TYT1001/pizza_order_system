@extends('admin.layouts.master')
@section('title','Create Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Product Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                <input id="cc-pament" name="pizzaName" value="{{old('name')}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" class="form-control">
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach

                                    </select>
                                     @error('pizzaCategory')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" value="{{old('description')}}" id="" cols="30" rows="8" class="form-control @error('pizzaDescription') is-invalid @enderror" type="text" placeholder="Enter Product description..."></textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="pizzaImage" value="{{old('image')}}" type="file" class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" value="{{old('price')}}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Price...">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="pizzaWaiting_time" value="{{old('price')}}" type="text" class="form-control @error('pizzaWaiting_time') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                @error('pizzaWaiting_time')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
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
