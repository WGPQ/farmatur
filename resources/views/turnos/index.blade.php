@extends('layouts.app')

@section('content')
<div class="container">
    <br />
    <h3 align="center">ASIGNACION DE TURNOS</h3>
    <br />
    <div align="right">
        <button type="button" name="create_turno" id="create_turno" class="btn btn-success btn-sm"> <span class="glyphicon glyphicon-plus"></span> Crear Nevo
            Turno</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="turno_table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Farmacia</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha Final</th>
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
                <form method="post" id="turno_form" class="form-horizontal">

                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Farmacia : </label>
                        <div class="col-md-8">
                            <select name="idfarmacia" id="idfarmacia" class="form-control">
                                <option value=""> </option>
                                @foreach($farmacias as $far)
                                <option value="{{$far->id}}">{{$far->nomfarmacia}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha inicio : </label>
                        <div class="col-md-8">
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha Fin : </label>
                        <div class="col-md-8">
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" />
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

    $('#turno_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('turnos.index') }}",
        },
        columns: [{
                data: 'farmacia',
                name: 'idfarmacia'
            },
            {
                data: 'fecha_inicio',
                name: 'fecha_inicio'
            },
            {
                data: 'fecha_fin',
                name: 'fecha_fin'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_turno').click(function() {
        $('.modal-title').text('Agregar nuevo turno');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#turno_form').trigger("reset");
        $('#form_result').html('');

        $('#formModal').modal('show');
    });

    $('#turno_form').on('submit', function(event) {
        event.preventDefault();
        var action_url = '';

        if ($('#action').val() == 'Add') {
            action_url = "{{ route('turnos.store') }}";
        }

        if ($('#action').val() == 'Edit') {
            action_url = "{{ route('turnos.update') }}";
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
                    $('#turno_form')[0].reset();
                    $('#turno_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/turnos/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                $('#idfarmacia').val(data.result.idfarmacia);
                $('#fecha_inicio').val(data.result.fecha_inicio);
                $('#fecha_fin').val(data.result.fecha_fin);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar turno');
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
            url: "turnos/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#turno_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
    });

});
</script>
@endsection