@extends('layouts.app')

@section('content')
<div class="container">
    <br />
    <h3 align="center">REGISTRO DE USUARIOS</h3>
    <br />
    <div align="right">
        <button type="button" name="create_usuario" id="create_usuario" class="btn btn-success btn-sm"><span
                class="glyphicon glyphicon-plus"></span> Crear Nuevo
            Usuaro</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="usuario_table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Genero</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="usuario_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Seleccione su foto: </label>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image" />
                            <span id="store_image"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre : </label>
                        <div class="col-md-8">
                            <input type="text" name="nombre" id="nombre" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Correo : </label>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Cedula : </label>
                        <div class="col-md-8">
                            <input type="text" name="cedula" id="cedula" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Telefono : </label>
                        <div class="col-md-8">
                            <input type="tel" name="telefono" id="telefono" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Genero : </label>
                        <div class="col-md-8">
                            <select name="genero" id="genero" class="form-control">

                                <option value="M">Masculino</option>

                                <option value="F">Femenino</option>

                                <option value="O">Otro</option>

                            </select>
                            <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Rol : </label>
                        <div class="col-md-8">
                            <select name="rol" id="rol" class="form-control">
                                @foreach($tusuarios as $tusuario)
                                <option value="{{$tusuario->id}}">{{$tusuario->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="Add"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 class="mensaje" align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="estado" id="estado" value="Eliminar" />
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger"
                    value="Eliminar">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#usuario_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('usuarios.index') }}",
        },
        columns: [{
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta) {
                    return "<img src={{ URL::to('/') }}/images/" + data +
                        " width='70' class='img-thumbnail' />";
                },
                orderable: false
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'cedula',
                name: 'cedula'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'genero',
                name: 'genero'
            },
            {
                data: 'rusuario',
                name: 'rol'
            },
            {
                data: 'active',
                name: 'active',
                orderable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_usuario').click(function() {
        $('.modal-title').text('Agregar nuevo usuario');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#usuario_form').trigger("reset");
        $('#form_result').html('');

        $('#formModal').modal('show');

    });

    $('#usuario_form').on('submit', function(event) {
        event.preventDefault();
        var action_url = '';

        if ($('#action').val() == 'Add') {
            action_url = "{{ route('usuarios.store') }}";
        }

        if ($('#action').val() == 'Edit') {
            action_url = "{{ route('usuarios.update') }}";
        }

        $.ajax({
            url: action_url,
            method: "POST",
            //data: $(this).serialize(),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                if (data.errors) {
                    html = '<div class="alert alert-danger">';
                    for (var count = 0; count < data.errors.length; count++) {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#usuario_form')[0].reset();
                    $('#usuario_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/usuarios/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                $('#store_image').html("<img src={{ URL::to('/') }}/images/" + data.result
                    .image + " width='70' class='img-thumbnail' />");
                $('#nombre').val(data.result.nombre);
                $('#store_image').append(
                    "<input type='hidden' name='hidden_image' value='" + data.result
                    .image + "' />");
                $('#email').val(data.result.email);
                $('#cedula').val(data.result.cedula);
                $('#telefono').val(data.result.telefono);
                $('#genero').val(data.result.genero);
                $('#rol').val(data.result.rol);
                $('#activo').val(data.result.activo);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar usuario');
                $('#action_button').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
        })
    });

    var user_id;

    $(document).on('click', '.delete', function() {
        user_id = $(this).attr('id');
        $('#ok_button').text('Eliminar');
        $('#ok_button').val('Eliminar');
        $('#estado').val('Eliminar');
        $('.modal-title').text('Eliminar usuario');
        $('.mensaje').text('Esta seguro que desea eliminar a este usuario ?');
        $('#confirmModal').modal('show');
    });
    $(document).on('click', '.acti', function() {
        user_id = $(this).attr('id');
        $('#ok_button').text('Desactivar');
        $('#ok_button').val('Desactivar');
        $('#estado').val('Desactivar');
        $('.modal-title').text('Estado del usuario');
        $('.mensaje').text('Esta seguro que desea desactivar ?');
        $('#confirmModal').modal('show');
    });
    $(document).on('click', '.inacti', function() {
        user_id = $(this).attr('id');
        $('#ok_button').text('Activar');
        $('#ok_button').val('Activar');
        $('#estado').val('Activar');
        $('.modal-title').text('Estado del usuario');
        $('.mensaje').text('Esta seguro que desea activar ?');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {

        event.preventDefault();
        var action_url = '';

        if ($('#estado').val() == 'Eliminar') {
            action_url = "usuarios/destroy/";
        }

        if ($('#estado').val() == 'Activar') {
            action_url = "usuarios/activar/";
        }

        if ($('#estado').val() == 'Desactivar') {
            action_url = "usuarios/desactivar/";
        }

        $.ajax({
            url: action_url + user_id,
            beforeSend: function() {
                $('#ok_button').text('Procesando...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#usuario_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }


        })
        /*
        if($('#ok_button').val()=='Activar'){
            $.ajax({
            url: "usuarios/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#usuario_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
        }
        if($('#ok_button').val()=='Desactivar'){
            $.ajax({
            url: "usuarios/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#usuario_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
        }*/

    });

});
</script>
@endsection