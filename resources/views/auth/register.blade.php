@extends('layouts.login')

@section('title', 'Registro de nuevo usuario')

@section('header_type', 'gradient')

@section('content')
<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <h3> Registrate </h3>
                            <!-- <span>Lorem ipsum dolor sit amet consectetur adipiscing elit odio duis risus at lobortis ullamcorper</span> -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="cfield">
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" value="{{ old('name') }}" required />
                                </div>
                                @error('name')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="cfield">
                                    <input type="email" placeholder="{{ __('E-Mail Address') }}" id="email"  class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                    <i class="la la-envelope"></i>
                                </div>
                                @error('email')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="cfield">
                                    <input type="password" placeholder="Ingrese una contraseña" id="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                    <i class="la la-key"></i>
                                </div>
                                @error('password')
                                    <span>{{ $message }}</span>
                                @enderror

                                <div class="cfield">
                                    <input type="password" placeholder="Repita la contraseña" name="password_confirmation" id="password_confirm" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" minlength="8">
                                    <i class="la la-key"></i>
                                </div>


                                <button type="submit">{{ __('Register') }}</button>
                            </form>
                        </div>
                    </div><!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
