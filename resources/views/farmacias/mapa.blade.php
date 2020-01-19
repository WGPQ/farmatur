<!DOCTYPE html>
<html>

<head>
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <style>
        #map {
            height: 300px;
            width: 250px;
            left: 0px;
        }
    </style>
    <title>GEOLOCALIZACION</title>
</head>

<body>
    <div class="row">
        <div id="map"></div>
        <script>
            var map = L.map('map').setView([-0.000001, -78.1452408], 12);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
            }).addTo(map);
            var marke = L.marker([0.03801, -78.14286], {
                draggable: true
            }).addTo(map);
            
        </script>
    </div>

</body>

</html>

