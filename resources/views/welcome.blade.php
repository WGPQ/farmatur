<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FARMATURN</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <!-- Styles -->
    <style>
    #mapid {
        height: 500px;
    width: 800px;

    }
    nav {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: larger;
    color: brown;
}
    </style>
</head>

<body>

    <!--<div class="flex-center position-ref full-height">-->
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))

        <div class="top-right links">
            @auth
            @if(Auth::user()->rol == 1)
            <a href="{{ url('/home') }}">Super Administrador</a>
            @endif

            @if(Auth::user()->rol == 2)
            <a href="{{ url('/home') }}">Administrador</a>
            @endif

            @else
            <a href="{{ route('login') }}">Iniciar Secion</a>
            @endauth
        </div>
        @endif
</ul>
    </nav>

<div>


</div>


    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
        <div class="row">
           
        <div class=" col-sm-4">
        <div class="form-group">
                                <label class="control-label col-md-4">Parroquia : </label>
                                <div class="col-md-8">
                                    <select name="id_division" id="id_division"
                                        data-placeholder="Seleccione una Parroquia" class="form-control" tabindex="1"
                                        required onchange="">
                                        <option value=""></option>
                                        @foreach($ciudadp as $div_pol)
                                        @if($div_pol->parent_id !=null)  
                                         <option value="{{$div_pol->id}}">{{$div_pol->nomdivision}}</option>
                                       @endif
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
                                </div>
                                <div class="col-md-8">
                                    <select name="farmacia" id="farmacia"
                                        data-placeholder="Seleccione una Parroquia" class="form-control" tabindex="1"
                                        required onchange="">
                                        <option value=" "></option>
                                        @foreach($ciudadp as $div_pol)
                                        <option value="{{$div_pol->id}}">{{$div_pol->Listafarmacias['nomfarmacia']}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="genero" id="genero" class="form-control" />-->
                                </div>
                            </div>
                            </div>    
        <div class=" col-sm-8">
        <center><h1>CANTON CAYAMBE</h1></center>
        <div class="card">
        <div class="card-body" id="mapid"></div>
    </div>
        </div>
</div>

         

    




    
</body>
<script src="{{ asset('js/app.js') }}"></script>

<script>
 var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
    var baseUrl = "{{ url('/') }}";

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
  

    axios.get('{{ route('api.farmacia.index') }}')
    .then(function (response) {
        console.log(response.data);
        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function (layer) {
            return layer.feature.properties.map_popup_content;
        }).addTo(map);
    })
    .catch(function (error) {
        console.log(error);
    });
    @can('create', new App\Farmacias)
    var theMarker;

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = "Your location : " + latitude + ", " + longitude + ".";
        popupContent += '<br><a href="{{ route('farmacia.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Add new outlet here</a>';

       theMarker = L.marker([latitude, longitude]).addTo(map);
        theMarker.bindPopup(popupContent).openPopup();
    });
    @endcan


    $('#id_division').on('change', function(e) {
        //console.log(e);
        var id_div = e.target.value;
        //ajax
        $.get("farmacia/farmacia_ciudad/" + id_div, function(data) {

            $('#farmacia').val(data.result.email);
        });
    });






    var cbn_selector = document.getElementById("id_division");

function centrarMapaParroquia() {
    var posicion = cbn_selector.selectedIndex;
    console.log("-> " + posicion);

    switch (posicion) {
        case 1: // CAYAMBE
            map.flyTo([0.04119, -78.14309], 17);
            break;
        case 2: // JUAN MONTALVO
            map.flyTo([0.033169, -78.144153], 17);
            break;
        case 3: // ASCAZUBI
            map.flyTo([0.041416, -78.143979], 17);
            break;
        case 4: // CANGAHUA
            map.flyTo([-0.061159, -78.168524], 17);
            break;
        case 5: // OLMEDO
            map.flyTo([0.140037, -78.076715], 17);
            break;
        case 6: // OTON
            map.flyTo([-0.025558, -78.260228], 16);
            break;
        case 7: // Santa Rosa de Cuzubamba
            map.flyTo([-0.049546, -78.274323], 17);
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

</html>