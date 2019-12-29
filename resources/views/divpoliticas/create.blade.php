@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('INGRESO DE FARMACIAS') }}</div>

                <div class="card-body">
                    <form id="f_nuevo_farmacia" method="POST" action="{{ route('divpoliticas.store') }}"
                        class="form-horizontal form_entrada">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Id Padre') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control " name="idpadre"
                                    value="{{ old('direccion') }}" required autocomplete="direccion">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nomfarmacias" type="text" class="form-control " name="nomdivision"
                                    value="{{ old('nomfarmacias') }}" required autocomplete="nomfarmacias">

                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nivel') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control " name="nivel"
                                    value="{{ old('telefono') }}" required autocomplete="telefono">


                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('GUARDAR CIUDAD') }}
                                </button>
                            </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<div>
    <br>
    <br>
</div>
@endsection