@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                    <form id="f_nuevo_usuario" method="POST" action="{{ route('usuarios.store') }}"
                        class="form-horizontal form_entrada">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text"
                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                    value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text"
                                    class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                                    value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

                                @error('cedula')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="correo">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Genero</label>
                            <div class="col-md-6">
                                <select id="genero" name="genero" class="form-control">
                                    <option value="M ">Masculino</option>
                                    <option value="F ">Femenino</option>
                                    <option value="O">Otros</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Tipo Usuario</label>
                            <div class="col-md-6">
                                <select class="form-control" name="tipouser">
                                    <option value="1">Super</option>
                                    <option value="2">Admin</option>
                                </select>
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
                                    {{ __('GUARDAR ADMINISTRADOR') }}
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