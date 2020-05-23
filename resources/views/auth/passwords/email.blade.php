@extends('layouts.login')

@section('title', 'Restablecer contraseña')

@section('header_type', 'gradient')

@section('content')
    <section>
        <div class="block remove-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-popup-area signin-popup-box static">
                            <div class="account-popup">
                                <h3>Restablecer contraseña</h3>
                                <span>Ingresa la dirección de correo para enviar información sobre restablecimiento de contraseña</span>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf


                                    <div class="cfield">
                                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="correo electrónico" />
                                        <i class="la la-email"></i>
                                    </div>
                                    <button type="submit">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </form>
                            </div>
                        </div><!-- LOGIN POPUP -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

