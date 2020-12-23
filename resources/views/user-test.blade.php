@extends('layouts.app')

@section('title', 'Listado de test de '.$user->name)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de test de <strong>{{ $user->name }}</strong>
                    <a class="float-right" href="{{ route('administrators') }}">volver a usuarios</a>
                </div>examen
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 50%">Categoría</th>
                            <th style="width: 50%">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                        @php
                            $tag = App\Tag::find($tags[$loop->iteration - 1]);
                            $examen = App\Test::find($test);
                            $estado = $examen->finished;
                        @endphp
                        <tr>
                            <td scope="row">{{ $tag->subcategory->category->name }} / {{ $tag->subcategory->name }}</td>
                            <td><em>
                                @if ($estado)
                                    {{ $results[$loop->iteration - 1] }}%
                                @else
                                    incompleto
                                @endif
                            </em></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
