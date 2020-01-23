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
    <h3 align="center">REGISTRO DE PERSONAS</h3>
    <br />
    <div align="right">
        <button type="button" name="create_persona" id="create_persona" class="btn btn-success btn-sm"> <span
                class="glyphicon glyphicon-plus"></span> Crear Nueva
            Persona</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="persona_table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Genero</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
<!--</body>

</html>-->

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="persona_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Select Profile Image : </label>
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
                <h4 align="center" style="margin:0;">Dese eliminar
                    <span class="title"></span>
                    ?</h4>
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

    $('#persona_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('personas.index') }}",
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
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_persona').click(function() {
        $('.modal-title').text('Agregar nueva persona');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#persona_form').trigger("reset");
        $('#form_result').html('');
        $('#formModal').modal('show');
    });

    $('#persona_form').on('submit', function(event) {
        event.preventDefault();
        var action_url = '';

        if ($('#action').val() == 'Add') {
            action_url = "{{ route('personas.store') }}";
        }

        if ($('#action').val() == 'Edit') {
            action_url = "{{ route('personas.update') }}";
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
                    $('#persona_form')[0].reset();
                    $('#persona_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/personas/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                $('#store_image').html("<img src={{ URL::to('/') }}/images/" +data.result.image + " width='70' class='img-thumbnail' />");                $('#nombre').val(data.result.nombre);
                $('#store_image').append("<input type='hidden' name='hidden_image' value='"+data.result.image+"' />");
               $('#email').val(data.result.email);
                $('#cedula').val(data.result.cedula);
                $('#telefono').val(data.result.telefono);
                $('#genero').val(data.result.genero);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar persona');
                $('#action_button').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
        })
    });

    var user_id;
    var username;
    $(document).on('click', '.delete', function() {
        user_id = $(this).attr('id');
        username = $(this).attr('nombre');
        $('.title').text(username);
        $('#ok_button').text('OK');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function() {
        $.ajax({
            url: "personas/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {

                $('#confirmModal').modal('hide');
                $('#persona_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
    });

});
</script>
@endsection