@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="home" aria-selected="true">Usuarios</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#administradores" role="tab" aria-controls="profile" aria-selected="false">Administradores</a>
                </li>
            </ul>
        </div>

        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Crear Usuarios</strong>
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
                                    <p>Seleccione las categorias que asignará al usuario:</p>
                                    @foreach ($categorias as $categoria)
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="categories[{{$categoria->id}}]" name="categories[{{$categoria->id}}]" value="{{$categoria->id}}">
                                            <label class="form-check-label" for="categories[{{$categoria->id}}]">{{$categoria->name}}</label>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('search')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20%">Nombre</th>
                                <th style="width: 20%">Correo Electrónico</th>
                                <th style="width: 20%">Test Creados</th>
                                <th style="width: 30%">Categorías asignadas</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios->sortByDesc('created_at') as $user)
                            <tr>
                                <th scope="row">{{ $user->name }}</th>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->tests->count() > 0) <a href="{{ url('test-list/'.$user->id) }}">Ver listado</a> @else no tiene @endif</td>
                                <td>
                                @foreach ($user->categories as $category)
                                    <p>{{$category->name}}</p>
                                @endforeach
                                </td>
                                <td>
            						<a href="" data-toggle="modal" data-target="#exampleModal"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-categories="{{ $user->categories->pluck('id')}}"
                                    >editar</a>
                                    |
            						<a href="{{ route('eliminar-usuario', $user->id) }}" onclick="return confirm('¿Desea eleminar el usuario?')">eliminar</a>
            					</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $usuarios->links() }}
                </div>
                <div class="tab-pane fade" id="administradores" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Crear usuarios Administradores</strong>
                                <a class="float-right" href="{{ route('home') }}">volver al inicio</a>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('crear-administrador') }}">
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 30%">Nombre</th>
                                <th style="width: 40%">Correo Electrónico</th>
                                <th style="width: 20%">Crear Administradores</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($administradores->sortByDesc('created_at') as $administrador)
                            <tr>
                                <th scope="row">{{ $administrador->name }}</th>
                                <td>{{ $administrador->email }}</td>
                                <td>@if($administrador->hasPermissionTo('crear_usuarios')) Si @else no @endif</td>
                                <td>
                                    @if ($administrador->id != auth()->user()->id)
                                        <a href="{{ route('eliminar-usuario', $administrador->id) }}" onclick="return confirm('¿Desea eleminar el administrador?')">eliminar</a>
                                    @endif
            					</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $administradores->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('actualizar-usuario') }}">
				<div class="modal-body">
					@csrf
					<input type="hidden" id="id" name="id">
					<div class="form-group">
						<label for="content">Nombre</label>
                        <input type="text" name="name" id="name">
					</div>
                    <p>Seleccione las categorias que asignará al usuario:</p>
                    @foreach ($categorias as $categoria)
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="modal-categories[{{$categoria->id}}]" name="categories[{{$categoria->id}}]" value="{{$categoria->id}}"
                            >
                            <label class="form-check-label" for="modal-categories[{{$categoria->id}}]">{{$categoria->name}}</label>
                        </div>
                    @endforeach

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
					<button type="submit" class="btn btn-primary">actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection

@section('scripts')
<script>
    window.onload = function() {
        $('#content').focus();

		$('#exampleModal').on('show.bs.modal', function (event) {
			var a = $(event.relatedTarget) // Button that triggered the modal
			var recipient = a.data('id') // Extract info from data-* attributes
			var name = a.data('name') // Extract info from data-* attributes
            var categories = a.data('categories')
            console.log(categories)
			var modal = $(this)
            modal.find("input:checkbox").attr("checked", false)
		    modal.find('#name').val(name)
			modal.find('#id').val(recipient)
            categories.forEach(element => modal.find("input:checkbox[value='"+element+"']").attr("checked", true))
		})
    };
</script>
@endsection
