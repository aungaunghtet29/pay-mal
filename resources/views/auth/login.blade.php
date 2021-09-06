@extends('frontend.layouts.app_plain')
@section('title', 'Login')


@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 90vh">
            <div class="card custom-card">

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email">E-Mail Address</label>



                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password">Password</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <button type="submit" class="btn btn-primary custom-btn">
                                Login
                            </button>
                        </div>

                        <div class="form-group row mb-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <span>
                                Not a member ? <a href="{{ route('register') }}">sign up</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
