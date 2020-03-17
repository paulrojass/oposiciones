@extends('layouts.app')

@section('title', 'Etiquetas')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva etiequeta para la subcategoría <strong>{{ $subcategory->name }}</strong>
                    <a class="float-right" href="{{ route('subcategorias', $subcategory->category->id) }}">volver a Subcategorias</a>
                </div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-etiqueta') }}">
                        @csrf
                        <input type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $subcategory->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="name" class="sr-only">Nombre de Etiqueta</label>
                                <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nombre de la etiqueta" required autofocus>
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
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">Etiqueta</th>
                          <th scope="col">acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <th scope="row">{{ $tag->id }}</th>
                            <td class="col-8">{{ $tag->name }}</td>
                            <td>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-content="{{ $tag->name }}" data-id="{{ $tag->id }}" >editar</a> |
                                <a href="{{ route('eliminar-etiqueta', $tag->id) }}"  onclick="return confirm('¿Desea eleminar la etiqueta?')">eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar etiqueta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('actualizar-etiqueta') }}">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <input type="text" maxlength="200" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nombre de la etiqueta" required autofocus>
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
    };
</script>
@endsection
