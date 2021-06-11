@extends('layouts.auth')

@section('title')
Sign up
@endsection

@section('body')
<!-- login page start-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/pemelangkab.jpg')}}"
                alt="looginpage">
        </div>
        <div class="col-xl-5 p-0">
            <div class="login-card">
                <div>
                    <div><a class="logo text-center" href="index.html"><img class="img-fluid for-light"
                                src="{{asset('assets/images/logo/logo-pml.jpg')}}" alt="looginpage" width="120px"><img
                                class="img-fluid for-dark" src="{{asset('assets/images/logo/logo-pml.jpg')}}"
                                alt="looginpage" width="120px"></a></div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <h4>Sign up</h4>

                            <div class="form-group">
                                <label for="name" class=" col-form-label">Name</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Password</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="show-hide"><span class="show"> </span></div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">

                                <div class="show-hide"><span class="show"> </span></div>

                            </div>

                            <div class="form-group my-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Sign up') }}
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