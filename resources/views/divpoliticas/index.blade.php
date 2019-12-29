@extends('layouts.app')

@section('content')


<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i> REGISTRO DE FARMACIAS</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Id Padre</th>
                        <th>Nivel</th>
                        <th width="750px">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divpoliticas as $div)
                    <tr>
                        <td>{{++$i }}</td>
                        <td>{{ $div->nomdivision }}</td>
                        <td>{{ $div->idpadre }}</td>
                        <td>{{$div->nivel}}</td>
                        
                        <td>
                            <form action="{{ route('divpoliticas.destroy',$div->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('divpoliticas.show',$div->id) }}">Ver </a>

                                <a class="btn btn-primary" href="{{ route('divpoliticas.edit',$div->id) }}">Editar</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>

                        </td>

                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection