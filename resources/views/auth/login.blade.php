@extends('layouts.login')

@section('title', 'Inicio de Sesión')

@section('header_type', 'gradient')

@section('content')

<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <h3> Inicio de Sesión </h3>
                            <!-- <span>Lorem ipsum dolor sit amet consectetur adipiscing elit odio duis risus at lobortis ullamcorper</span> -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="cfield">
                                    <input type="email" placeholder="{{ __('E-Mail Address') }}" id="email"  class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                    <i class="la la-user"></i>
                                </div>
                                @error('email')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="cfield">
                                    <input type="password" placeholder="********" id="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                    <i class="la la-key"></i>
                                </div>
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror
                                <p class="remember-label">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">{{ __('Remember Me') }}</label>
                                </p>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <button type="submit">{{ __('Login') }}</button>
                            </form>
                        </div>
                    </div><!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
