@extends('layouts.app')

@section('title', 'Categorias')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva Categoría</div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-categoria') }}">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="name" class="sr-only">Nombre de Categoría</label>
                                <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror"   name="name" id="name" placeholder="Nombre de la categoria" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-condensed table-striped">
          <thead>
            <tr>
              <th style="width: 10%">id</th>
              <th style="width: 40%">Categorias</th>
              <th style="width: 30%">Subcategorias</th>
              <th style="width: 20%">acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>
                    @foreach ($category->subcategories as $subcategory)
                        <li>{{ $subcategory->name }}</li>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('subcategorias', $category->id) }}" >nueva_subcategoría</a> |
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-content="{{ $category->name }}" data-id="{{ $category->id }}" >editar</a> |
                    <a href="{{ route('eliminar-categoria', $category->id) }}"  onclick="return confirm('¿Desea eleminar la categoria?')">eliminar</a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('actualizar-categoria') }}">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                                <!-- <label for="name" class="sr-only">Nombre de Categoría</label> -->
                                <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror"   name="name" id="name" placeholder="Nombre de la categoria" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
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
        $('#name').focus();

        $('#exampleModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget) // Button that triggered the modal
            var recipient = a.data('id') // Extract info from data-* attributes
            var content = a.data('content') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name').val(content)
            modal.find('#id').val(recipient)
        })        
    }
</script>
@endsection