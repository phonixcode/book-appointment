@extends('layouts.auth')

@section('title', 'Register')
@section('content')
<div class="app-contant">
    <div class="bg-white">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                    <div class="d-flex align-items-center h-100-vh">
                        <div class="register p-5">
                            <h1 class="mb-2">Book an Appointment</h1>
                            <p>Welcome, Please create your account.</p>

                            <form method="POST" action="{{ route('user.register.submit') }}" class="mt-2 mt-sm-5">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Email*</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" placeholder="Email"
                                                value="{{ old('email') }}">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Password*</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder=""
                                                value="{{ old('password') }}">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="" id="password_confirmation" name="password_confirmation" />
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary text-uppercase">Sign up</button>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <p>Already have an account ?<a href="{{ route('user.login') }}"> Sign In</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                    <div class="row align-items-center h-100">
                        <div class="col-7 mx-auto ">
                            <img class="img-fluid" src="assets/img/bg/login.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
