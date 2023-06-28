@extends('layout.login_register')

@section('title', 'Login Form')

@section('content')
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">{{ __('Register') }}</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <input id="name" type="text" placeholder="NAME"
                        class="@error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <input type="email" id="email" placeholder="MAIL"
                        class="@error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div>
                        <input type="password" placeholder="PASSWORD"
                        id="password"  class="@error('password') is-invalid @enderror" 
                        name="password" required autocomplete="new-password"
                        >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <input type="password" placeholder="CONFIRM PASSWORD"
                        id="password-confirm" 
                        name="password_confirmation" required autocomplete="new-password"
                        >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <button class="opacity">{{ __('REGISTER') }}</button>
                </form>
                <div class="register-forget opacity">
                    @if (Route::has('login'))
                    <span>Already registered ?</span>
                    <a href="{{ route('login') }}">LOGIN</a>
                    @endif

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>

@endsection