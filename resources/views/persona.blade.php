<!DOCTYPE html>
<html>

<head>
    <title>Laravel 6 Crud operation using ajax(Real Programmer)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Laravel 6 Crud with Ajax</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewPersona"> Crear Nueva Persona</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th width="300px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="bookForm" name="bookForm" class="form-horizontal">
                        <input type="hidden" name="persona_id" id="persona_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                                    value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cedula</label>
                            <div class="col-sm-12">
                                <input type="text" id="cedula" name="cedula" required="" placeholder="Cedula"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('personas.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'cedula',
                    name: 'cedula'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#createNewPersona').click(function() {
            $('#saveBtn').val("create-persona");
            $('#persona_id').val('');
            $('#personaForm').trigger("reset");
            $('#modelHeading').html("Crear Nueva Persona");
            $('#ajaxModel').modal('show');
        });
        $('body').on('click', '.editPersona', function() {
            var book_id = $(this).data('id');
            $.get("{{ route('personas.index') }}" + '/' + persona_id + '/edit', function(data) {
                $('#modelHeading').html("Editar Persona");
                $('#saveBtn').val("edit-persona");
                $('#ajaxModel').modal('show');
                $('#persona_id').val(data.id);
                $('#nombre').val(data.nombre);
                $('#cedula').val(data.cedula);
            })
        });
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Save');

            $.ajax({
                data: $('#bookForm').serialize(),
                url: "{{ route('personas.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#bookForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Guardar');
                }
            });
        });

        $('body').on('click', '.deleteBook', function() {

            var persona_id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('personas.store') }}" + '/' + persona_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

    });
    </script>
</body>

</html>