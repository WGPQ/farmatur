@extends('layouts.app')
@section('content')
<div class="container">
    <br />
    <h3 align="center">REGISTRO DE FARMACIAS</h3>
    <br />
    <div align="right">
        <button type="button" name="create_farmacia" id="create_farmacia" class="btn btn-success btn-sm"><span
                class="glyphicon glyphicon-plus"></span> Crear Nueva
            Farmacia</button>
    </div>
    <br />
    <div class="table-responsive">
        <table id="farmacia_table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Jararquia</th>
                    <th width="2%">Latitud</th>
                    <th width="2%">Longitud</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>


<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">

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
                                    <input type="text" style="text-transform:uppercase" name="nomfarmacia"
                                        id="nomfarmacia" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Ciudad : </label>
                                <div class="col-md-8">
                                    <select name="id_division" id="id_division"
                                        data-placeholder="Seleccione una Parroquia" class="form-control" tabindex="1"
                                        required onchange="">
                                        @foreach($ciudadp as $div_pol)
                                        @if($div_pol->parent_id !=null)
                                        <option value="{{$div_pol->id}}">{{$div_pol->nomdivision}}</option>
                                       @endif
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
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
                                    <input type="text" style="text-transform:uppercase" name="direccion" id="direccion"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Jerarquia : </label>
                                <div class="col-md-8">
                                    <input type="text" name="jerarquia" style="text-transform:uppercase"  id="jerarquia" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Longitud : </label>
                                <div class="col-md-8">
                                    <input type="text" name="longitud" id="longitud" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Latitud : </label>
                                <div class="col-md-8">
                                    <input type="text" name="latitud" id="latitud" class="form-control" readonly />
                                </div>
                            </div>

                        </div>
                        <div class=" col-sm-4">
                            <label class="control-label">ZONA DE ANALISIS</label>
                            <div id="map">
                            </div>
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
                data: 'nomfarmacia',
                name: 'nomfarmacia'
            },
            {
                data: 'ciudad',
                name: 'id_division'
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
                data: 'jerarquia',
                name: 'jerarquia'
            },
            {
                data: 'longitude',
                name: 'longitud'
            },
            {
                data: 'latitude',
                name: 'latitud'
            },
            
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_farmacia').click(function() {
        $('.modal-title').text('Agregar nueva farmacia');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');
        $('#formModal').modal('show');

    });

    $('#farmacia_form').on('submit', function(event) {
        map.invalidateSize();
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
                $('#id_division').val(data.result.id_division);
                $('#telefono').val(data.result.telefono);
                $('#direccion').val(data.result.direccion);
                $('#jerarquia').val(data.result.jerarquia);
                $('#latitud').val(data.result.latitud);
                $('#longitud').val(data.result.longitud);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar farmacia');
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

//mapoa
var map = L.map('map').setView([0.04104004628590023, -78.14285258539633], 13);
//[0.04104004628590023, -78.14285258539633], 13

L.marker([48.86, 2.35]).addTo(map);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Comment out the below code to see the difference.
$('#formModal').on('shown.bs.modal', function() {
    map.invalidateSize();
});
var popup = L.popup();
    var txt_latitud = document.getElementById("latitud");
    var txt_longitud = document.getElementById("longitud");

    function onMapClick(e) {
        //popup.setLatLng(e.latlng).setContent("Lugar seleccionado " + e.latlng.toString()).openOn(map);
        popup.setLatLng(e.latlng).setContent("Lugar seleccionado").openOn(map);
        txt_latitud.value = e.latlng.lat;
        txt_longitud.value = e.latlng.lng;
    }

    map.on('click', onMapClick);



    var cbn_selector = document.getElementById("id_division");

    function centrarMapaParroquia() {
        var posicion = cbn_selector.selectedIndex;
        console.log("-> " + posicion);

        switch (posicion) {
            case 1: // CAYAMBE
                map.flyTo([-0.025558, -78.260228], 16);
                break;
            case 2: // JUAN MONTALVO
                map.flyTo([0.04119, -78.14309], 17);

                break;
            case 3: // ASCAZUBI
                map.flyTo([0.041416, -78.143979], 17);
                break;
            case 4: // CANGAHUA
                map.flyTo([0.033169, -78.144153], 17);
                break;
            case 5: // OLMEDO
                map.flyTo([-0.049546, -78.274323], 17);
                break;
            case 6: // OTON
                map.flyTo([0.140037, -78.076715], 17);
                break;
            case 7: // Santa Rosa de Cuzubamba
                map.flyTo([-0.061159, -78.168524], 17);
                break;
            case 8: // AYORA
                map.flyTo([0.06710202071549935, -78.13232739580957], 16);
                break;
            default:
                console.log('Error combobox');
        }
    }
    // se ejecuta al seleccionar en el comobox
    cbn_selector.addEventListener("change", centrarMapaParroquia);

</script>
@endsection