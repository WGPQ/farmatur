<!--<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>-->
@extends('layouts.app2')

@section('content')
    <div class="container">
        <br />
        <h3 align="center">REGISTRO DE USUARIOS</h3>
        <br />
        <div align="right">
            <button type="button" name="create_usuario" id="create_usuario" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Crear Nuevo
                Usuaro</button>
        </div>
        <br />
        <div class="table-responsive">
            <table id="usuario_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
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
</body>

</html>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="usuario_form" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre : </label>
                        <div class="col-md-8">
                            <select name="idpersona" id="idpersona" class="form-control">
                                @foreach($personas as $per)
                                <option value="{{$per->id}}">{{$per->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Correo : </label>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" />
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


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="activo" id="activo"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    Activo
                                </label>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="Add" ><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
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
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
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
                data: 'nombre',
                name: 'idpersona'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'rusuario',
                name: 'rol'
            },
            {
                data: 'activo',
                name: 'activo'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_usuario').click(function() {
        $('.modal-title').text('Add New Record');
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
            data: $(this).serialize(),
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
                $('#idpersona').val(data.result.idpersona);
                $('#email').val(data.result.email);
                $('#password').val(data.result.password);
                $('#rol').val(data.result.rol);
                $('#activo').val(data.result.activo);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
        })
    });

    var user_id;

    $(document).on('click', '.delete', function() {
        user_id = $(this).attr('id');
        $('#ok_button').text('OK');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {
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
    });

});
</script>
@endsection