@extends('admin.layouts.master')
@section('title','Create Page')
@section('content')

<div class="main-content">

    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Your Category</h3>
                        </div>
                        <hr>
                        <form action="{{route('category#update')}}" method="get" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input type="hidden" value="{{$category->id}}" name="categoryId">
                                <input id="cc-pament" name="categoryName" value="{{old('categoryName',$category->name)}}" type="text" class="form-control @error('categoryName')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
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

