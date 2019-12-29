@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('VISUALIZAR PERFIL') }}</div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <!-- <h2> Show blog</h2>-->
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> Atras</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $usuario->nombre }}
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $usuario->cedula }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $usuario->email }}
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tipo de usuario:</strong>
                            {{ $usuario->tipouser }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Genero:</strong>
                            {{ $usuario->genero }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection