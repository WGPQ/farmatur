@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('VISUALIZAR FARMACIA') }}</div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <!-- <h2> Show blog</h2>-->
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('farmacias.index') }}"> Atras</a>
                        </div>
                    </div>
                </div>
                   
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $farmacia->nomfarmacias }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $farmacia->latitud }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection