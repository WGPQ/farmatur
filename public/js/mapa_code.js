(function() {


    var map = L.map('map').setView([0.04104004628590023, -78.14285258539633], 13);

    L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=9GsAOSMtwAdzSXgPwujl', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
    }).addTo(map);

    //var id_cbx = document.getElementById("cbx_parroquias");

    // obtener coordenadas del mapa
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


    // manejo del combobox
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

}());