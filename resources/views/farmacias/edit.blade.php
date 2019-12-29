@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('INGRESO DE FARMACIAS') }}</div>

                <div class="card-body">
                    <form action="{{ route('farmacias.update',$farmacia->id) }}" method="POST">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @method('PUT')

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Parroquia</label>
                            <div class="col-md-6">
                                <select id="id_division" name="id_division" class="form-control">
                                    <option value="1 ">Ayora</option>
                                    <option value="2 ">Cayambe</option>
                                    <option value="3">Ascasubi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Jrarquia</label>
                            <div class="col-md-6">
                                <select id="jerarqua" name="jerarqua" class="form-control">
                                    <option value="P">Principal</option>
                                    <option value="S ">Sucursal</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nomfarmacias" type="text" class="form-control " name="nomfarmacias"
                                    value="{{ $farmacia->nomfarmacias }}" required autocomplete="nomfarmacias">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control " name="direccion"
                                    value="{{ $farmacia->direccion }}" required autocomplete="direccion">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control " name="telefono"
                                    value="{{ $farmacia->telefono }}" required autocomplete="telefono">


                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Latitud') }}</label>

                            <div class="col-md-6">
                                <input id="latitud" type="text" class="form-control" name="latitud"
                                    value="{{ $farmacia->latitud }}" required autocomplete="latitud">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Longitud') }}</label>

                            <div class="col-md-6">
                                <input id="longitud" type="text" class="form-control" name="longitud"
                                    value="{{ $farmacia->longitud }}" required autocomplete="longitud">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" name="activo" id="activo" {{ old('activo') ? 'checked' : '' }}>-->
                                    <input class="form-check-input" type="checkbox" name="activo" value="1" />
                                    <label class="form-check-label" for="activo">
                                        {{ __('Activo') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('GUARDAR EDICION') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection