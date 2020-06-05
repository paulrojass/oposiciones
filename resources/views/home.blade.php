@extends('layouts.app')

@section('title', 'Inicio')

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
                    <ul>
                        <li><a href="{{ route('categorias') }}">Administrar Categorías</a></li>
                        <li><a href="{{ route('preguntas') }}">Administrar Preguntas</a></li>
                        @if(@Auth::user()->hasPermissionTo('crear_usuarios'))
                        <li>
                            <a href="{{ route('administrators') }}">Usuarios</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
