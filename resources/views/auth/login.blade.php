

@extends('layout.login_register')

@section('title', 'Login Form')

@section('content')
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">{{ __('Login') }}</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <input type="email" id="email" placeholder="MAIL"
                        class="@error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
                        name="password" required autocomplete="current-password"
                        >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="remember-me">
                        <input class="opacity" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="opacity" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>



                    <button class="opacity">{{ __('LOGIN') }}</button>
                </form>
                <div class="register-forget opacity">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">REGISTER</a>
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