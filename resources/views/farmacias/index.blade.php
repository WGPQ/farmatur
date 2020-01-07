<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style_mapa.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://code/jquery.com/jquery.js"></script>
    <script>
    $(document).ready(function(e) {
        $('#mimapa').load('https://www.google.com', function(data) {
            $(this).html(data);
        });
    });
    </script>
    <style>
    #mimapa {
        height: 350px;
        width: 200px;

    }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</h3>
        <br />
        <div align="right">
            <button type="button" name="create_farmacia" id="create_farmacia" class="btn btn-success btn-sm">Create
                Record</button>
        </div>
        <br />
        <div class="table-responsive">
            <table id="farmacia_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Principal</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Jararquia</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
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
    <div class="modal-dialog modal-lg ">
        <div class="modal-content ">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Record</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="farmacia_form" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class=" col-sm-8">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Nombre Farmacia : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="nomfarmacia" id="nomfarmacia" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Farmacia Principal : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="parent_id" id="parent_id" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Ciudad : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="id_division" id="id_division" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Telefono : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="telefono" id="telefono" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Direccion : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="direccion" id="direccion" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Jerarquia : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="jerarquia" id="jerarquia" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Longitud : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="longitud" id="longitud" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Latitud : </label>
                                    <div class="col-md-8">
                                        <input type="text" name="latitud" id="latitud" class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class=" col-sm-4">
                                <label class="control-label col-md-8">ZONA DE ANALISIS</label>
                                <div id="mimapa">
                                </div>
                                <script src="js/usuario_mapaCode.js"></script>
                            </div>
                        </div>
                        <br />
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                value="Add" />
                        </div>

                    </form>

                </div>




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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $('#farmacia_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('farmacias.index') }}",
        },
        columns: [{
                data: 'parent_id',
                name: 'parent_id'
            },
            {
                data: 'id_division',
                name: 'id_division'
            },
            {
                data: 'nomfarmacia',
                name: 'nomfarmacia'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },
            {
                data: 'longitud',
                name: 'longitud'
            },
            {
                data: 'latitud',
                name: 'latitud'
            },
            {
                data: 'jerarquia',
                name: 'jerarquia'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_farmacia').click(function() {
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');

        $('#formModal').modal('show');
    });

    $('#farmacia_form').on('submit', function(event) {
        event.preventDefault();
        var action_url = '';

        if ($('#action').val() == 'Add') {
            action_url = "{{ route('farmacias.store') }}";
        }

        if ($('#action').val() == 'Edit') {
            action_url = "{{ route('farmacias.update') }}";
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
                    html = '<div class="alert alert-success">' + data.success +
                        '</div>';
                    $('#farmacia_form')[0].reset();
                    $('#farmacia_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            }
        });
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/farmacias/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                $('#nomfarmacia').val(data.result.nomfarmacia);
                $('#parent_id').val(data.result.parent_id);
                $('#id_division').val(data.result.id_division);
                $('#telefono').val(data.result.telefono);
                $('#direccion').val(data.result.direccion);
                $('#latitud').val(data.result.latitud);
                $('#longitud').val(data.result.longitud);
                $('#jerarquia').val(data.result.jerarquia);
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
            url: "farmacias/destroy/" + user_id,
            beforeSend: function() {
                $('#ok_button').text('Deleting...');
            },
            success: function(data) {
                $('#confirmModal').modal('hide');
                $('#farmacia_table').DataTable().ajax.reload();
                setTimeout(function() {
                    // alert('Data Deleted');
                }, 2000);
            }
        })
    });

});
</script>