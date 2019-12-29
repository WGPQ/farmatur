@extends('layouts.app')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i> LISTADO DE USUARIOS</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Tipo de Usuario</th>
                        <th>Genero</th>
                        <th>Correo</th>
                        <th>Activo</th>
                        <th width="750px">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $user)
                    <tr>
                        <td>{{++$i }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->cedula }}</td>
                        <td>{{$user->tipouser}}</td>
                        <td>{{$user->genero}}</td>
                        <td>{{ $user->email }}</td>
                        <td>Si</td>
                        <td>
                            <form action="{{ route('usuarios.destroy',$user->id) }}" method="POST">

                                <a class="btn btn-info" href="{{ route('usuarios.show',$user->id) }}">Ver </a>

                                <a class="btn btn-primary" href="{{ route('usuarios.edit',$user->id) }}">Editar</a>

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