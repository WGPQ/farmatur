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
                        <th>Canton</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Jararquia</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Activo</th>
                        <th width="750px">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($farmacias as $far)
                    <tr>
                        <td>{{++$i }}</td>
                        <td>{{ $far->nomfarmacias }}</td>
                        <td>{{ $far->id_division }}</td>
                        <td>{{$far->telefono}}</td>
                        <td>{{$far->direccion}}</td>
                        <td>{{$far->jerarca}}</td>
                        <td>{{ $far->longitud }}</td>
                        <td>{{ $far->latitud }}</td>
                        <td>{{$far->id}} </td>
                        <td>
                            <form action="{{ route('farmacias.destroy',$far->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('farmacias.show',$far->id) }}">Ver </a>

                                <a class="btn btn-primary" href="{{ route('farmacias.edit',$far->id) }}">Editar</a>

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