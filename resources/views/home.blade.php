@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            <div class="content">

                <div class="links">
                    <a href="{{ route('categorias') }}">Categorías</a>
                    <a href="{{ route('preguntas') }}">Preguntas</a>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
