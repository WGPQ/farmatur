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
    <h3 align="center">REGISTRO DE DIVISION POLITICA ADMINISTRAIVA DEL ECUADOR</h3>
    <br />
    <div align="right">
        <button type="button" name="create_divisionp" id="create_divisionp" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Crear Nueva
            Ciudad</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="divisionp_table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Canton</th>
                    <th>Parroquia</th>
                    <th>Nivel</th>
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
                <form method="post" id="divisionp_form" class="form-horizontal">

                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Canton : </label>
                        <div class="col-md-8">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""> </option>
                                @foreach($ciudadpdre as $div_pol)
                                <option value="{{$div_pol->id}}">{{$div_pol->nomdivision}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre : </label>
                        <div class="col-md-8">
                            <input type="text" name="nomdivision" id="nomdivision" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Nivel : </label>
                        <div class="col-md-8">
                            <input type="text" name="nivel" id="nivel" class="form-control" />
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

    $('#divisionp_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('divpoliticas.index') }}",
        },
        columns: [{
                data: 'cidudad',
                name: 'parent_id'
            },
            {
                data: 'nomdivision',
                name: 'nomdivision'
            },
            {
                data: 'nivel',
                name: 'nivel'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_divisionp').click(function() {
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#divisionp_form').trigger("reset");
        $('#form_result').html('');

        $('#formModal').modal('show');
    });

    $('#divisionp_form').on('submit', function(event) {
        event.preventDefault();
        var action_url = '';

        if ($('#action').val() == 'Add') {
            action_url = "{{ route('divpoliticas.store') }}";
        }

        if ($('#action').val() == 'Edit') {
            action_url = "{{ route('divpoliticas.update') }}";
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
                    $('#divisionp_form')[0].reset();
                    $('#divisionp_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/divpoliticas/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                $('#parent_id').val(data.result.parent_id);
                $('#nomdivision').val(data.result.nomdivision);
                $('#nivel').val(data.result.nivel);
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
            url: "divpoliticas/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#divisionp_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
    });

});
</script>
@endsection