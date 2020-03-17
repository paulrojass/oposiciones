@extends('layouts.app')

@section('title', 'Subcategorias')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva subcategoría para la categoría <strong>{{ $category->name }}</strong>
                    <a class="float-right" href="{{ route('categorias') }}">volver a Categorias</a>
                </div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-subcategoria') }}">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="name" class="sr-only">Nombre de Subcategoría</label>
                                <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror"   name="name" id="name" placeholder="Nombre de la subcategoria" required autofocus>
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
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Subcategorias</th>
              <th scope="col">etiquetas</th>
              <th scope="col">acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subcategories as $subcategory)
            <tr>
                <th scope="row col-1">{{ $subcategory->id }}</th>
                <td class="col-4">{{ $subcategory->name }}</td>
                <td class="col-5">
                    @foreach ($subcategory->tags as $tag)
                        <span class="badge badge-success">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td class="col-2">
                    <a href="{{ route('etiquetas', $subcategory->id) }}" >nueva_etiqueta</a> |
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-content="{{ $subcategory->name }}" data-id="{{ $subcategory->id }}" >editar</a> |
                    <a href="{{ route('eliminar-subcategoria', $subcategory->id) }}"  onclick="return confirm('¿Desea eleminar la subcategoria?')">eliminar</a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $subcategories->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar subcategoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('actualizar-subcategoria') }}">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                                <!-- <label for="name" class="sr-only">Nombre de Categoría</label> -->
                                <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror"   name="name" id="name" placeholder="Nombre de la subcategoria" required autofocus>
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