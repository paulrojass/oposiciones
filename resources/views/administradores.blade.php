@extends('layouts.app')

@section('title', 'Administradores')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear usuarios Administradores</strong>
                    <a class="float-right" href="{{ route('home') }}">volver al inicio</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('crear-usuario') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div><br/>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="crear_usuarios" name="crear_usuarios">
                            <label class="form-check-label" for="crear_usuarios">Permisos para crear otros usuarios</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">



            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#administradores" role="tab" aria-controls="home" aria-selected="true">Administradores</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="profile" aria-selected="false">Usuarios</a>
                </li>
            </ul>

        </div>

        <div class="col-md-12">


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="administradores" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 40%">Nombre</th>
                                <th style="width: 40%">Correo Electrónico</th>
                                <th style="width: 20%">Crear Administradores</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($administradores->sortByDesc('created_at') as $administrador)
                            <tr>
                                <th scope="row">{{ $administrador->name }}</th>
                                <td>{{ $administrador->email }}</td>
                                <td>@if($administrador->hasPermissionTo('crear_usuarios')) Si @else no @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $administradores->links() }}              
                </div>
                <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 40%">Nombre</th>
                                <th style="width: 40%">Correo Electrónico</th>
                                <th style="width: 20%">Test Creados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios->sortByDesc('created_at') as $user)
                            <tr>
                                <th scope="row">{{ $user->name }}</th>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->tests->count() > 0) <a href="{{ url('test-list/'.$user->id) }}">Ver listado</a> @else no tiene @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $usuarios->links() }}              


                </div>

            </div>
        </div>


    </div>
</div>
@endsection
