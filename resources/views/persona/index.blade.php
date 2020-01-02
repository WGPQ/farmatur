<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 5.8 Ajax CRUD Application - W3Adda.com</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <style>
    .container {
        padding: 0.5%;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2 style="margin-top: 12px;" class="alert alert-success">Laravel 5.8 Ajax CRUD Application - W3Adda.com</h2>
        <br>
        <div class="row">
            <div class="col-12">
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Add post</a>

                <table class="table table-bordered" id="laravel_crud">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Genero</th>
                            <td colspan="2"> </td>
                        </tr>
                    </thead>
                    <tbody id="persona-crud">
                        @foreach($personas as $per)
                        <tr id="persona_id_{{ $per->id }}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $per->nombre }}</td>
                            <td>{{ $per->cedula }}</td>
                            <td>{{ $per->telefono }}</td>
                            <td>{{ $per->email }}</td>
                            <td>{{ $per->genero }}</td>
                            <td><a href="javascript:void(0)" id="edit-persona" data-id="{{ $per->id }}"
                                    class="btn btn-info">Edit</a></td>
                            <td>
                                <a href="javascript:void(0)" id="delete-persona" data-id="{{ $per->id }}"
                                    class="btn btn-danger delete-post">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $personas->links() }}
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ajax-crud-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" class="form-horizontal">
                        <input type="hidden" name="persona_id" id="persona_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nombre" name="nombre" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cedula</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="cedula" name="cedula" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telefono</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="telefono" name="telefono" value=""
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Correo</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Genero</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="genero" name="genero" value="" required="">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Guardar1</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>








</body>

</html>


<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#create-new-post').click(function() {
        $('#btn-save').val("create-post");
        $('#postForm').trigger("reset");
        $('#postCrudModal').html("Add New post");
        $('#ajax-crud-modal').modal('show');

    });

    $('body').on('click', '#edit-persona', function() {
        var persona_id = $(this).data('id');
        $.get('personas/' + persona_id + '/edit', function(data) {
            $('#postCrudModal').html("Edit post");
            $('#btn-save').val("edit-persona");
            $('#ajax-crud-modal').modal('show');
            $('#persona_id').val(data.id);
            $('#nombre').val(data.nombre);
            $('#cedula').val(data.cedula);
            $('#telefono').val(data.telefono);
            $('#email').val(data.email);
            $('#genero').val(data.genero);
        })
    });



    $('body').on('click', '.delete-post', function() {
        var persona_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ url('personas')}}" + '/' + persona_id,
            success: function(data) {
                $("#persona_id_" + persona_id).remove();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
});



if ($("#postForm").length > 0) {
    $("#postForm").validate({

        submitHandler: function(form) {

            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');


            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('personas.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    var persona = '<tr id="persona_id_' + data.id + '"><td>' + data.id +
                        '</td><td>' +
                        data.nombre + '</td><td>' + data.cedula + '</td><td>' + data.telefono +
                        '</td><td>' + data.email + '</td><td>' + data.genero + '</td>';
                    persona += '<td><a href="javascript:void(0)" id="edit-persona" data-id="' +
                        data
                        .id + '" class="btn btn-info">Edit</a></td>';
                    persona += '<td><a href="javascript:void(0)" id="delete-post" data-id="' +
                        data
                        .id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';


                    if (actionType == "create-post") {
                        $('#persona-crud').prepend(persona);
                    } else {
                        $("#persona_id_" + data.id).replaceWith(persona);
                    }

                    $('#postForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').html('Guardar2');

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Guardar3');
                }
            });
        }
    })
}
</script>