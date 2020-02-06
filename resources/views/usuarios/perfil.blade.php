<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style href="css/perfil.css"></style>
    <title>Perfil</title>
</head>

<body>


    <input type="button" value="Volver" class="btn btn-success btn-sm" onClick="history.go(-1);" />
    <!--arrow-left-->
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="/images/{{Auth::user()->image}}" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <h2> {{Auth::user()->nombre}}</h2>
                        </div>
                        <div class="profile-usertitle-job">
                            <h3> {{Auth::user()->tipos_usuario['nombre']}}</h3>

                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" name="edit" id="{{Auth::user()->id}}"
                            class="edit btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span>
                            Editar</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-earphone"></i>
                                    {{Auth::user()->telefono}} </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    {{Auth::user()->email}} </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">

                                    {{Auth::user()->cedula}}</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    Some user related content goes here...
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>



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


    <script>
    $(document).ready(function() {
        $('#usuario_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('perfil.update') }}",
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
                        $('#usuario_form')[0].reset();
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/perfil/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    $('#store_image').html("<img src={{ URL::to('/') }}/images/" +
                        "{{Auth::user()->image}}" +
                        " width='70' class='img-thumbnail' />");
                    $('#nombre').val(data.result.nombre);
                    $('#store_image').append(
                        "<input type='hidden' name='hidden_image' value='" +
                        "{{Auth::user()->image}}" + "' />");
                    $('#email').val("{{Auth::user()->email}}");
                    $('#cedula').val("{{Auth::user()->cedula}}");
                    $('#telefono').val("{{Auth::user()->telefono}}");
                    $('#genero').val("{{Auth::user()->genero}}");
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Editar usuario');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

    });
    </script>

</body>

</html>