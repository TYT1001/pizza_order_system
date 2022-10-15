@extends('user.layouts.master')
@section('content')
<div class="col-lg-6 offset-3">
    <div class="text-3xlar">Hello world</div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Change Password</h3>
            </div>
            <hr>
            <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                @csrf
                <div class="form-group">
                    <div>
                    <label for="cc-payment" class="form-label ">Old Password</label>
                    <input id="cc-pament" name="oldPassword"  type="text" class="form-control @error('oldPassword')
                        is-invalid
                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                    @error('oldPassword')
                    <small class="invalid-feedback">
                        {{$message}}
                    </small>
                @enderror
                </div>


                </div>
                <div class="form-group">
                    <div>
                    <label for="cc-payment" class="form-label">New Password</label>
                    <input id="cc-pament" name="newPassword"  type="text" class="form-control @error('newPassword')
                        is-invalid
                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                    @error('newPassword')
                        <small class="invalid-feedback">
                            {{$message}}
                        </small>
                    @enderror
                </div>


                </div>
                <div class="form-group">
                    <div>
                    <label for="cc-payment" class="form-label">Confirm Password</label>
                    <input id="cc-pament" name="confirmPassword" type="text" class="form-control @error('confirmPassword')
                        is-invalid
                    @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                    @error('confirmPassword')
                        <small class="invalid-feedback">
                            {{$message}}
                        </small>
                    @enderror
                </div>


                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                        <i class="fa-solid fa-key"></i>
                        <span id="payment-button-amount">Change Password</span>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

