let api = "https://analisi.transparenciacatalunya.cat/resource/tasf-thgu.json";
let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY";
let markers = [];

window.onload = function() {
    $.getScript("https://maps.googleapis.com/maps/api/js?key=" + googleApiKey + "&callback=initMap");
    window.initMap = initMap;
}

let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('mapa'), {
        center: {
            lat: 41.678620,
            lng: 2.780853
        },
        zoom: 18,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });
    
    map.addListener('click', function(event) {
        let marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });
        markers.push(marker);

        // Agrega un evento de clic al marcador
        marker.addListener('click', function() {
            selectedMarker = marker;
        });
    });
}

let selectedMarker = null;

function eliminarMarcador() {
    if (markers.length === 0) {
        // Muestra una alerta si no hay marcadores en el mapa
        alert("No hay marcadores para eliminar.");
    } else if (selectedMarker) {
        // Elimina el marcador seleccionado del mapa
        selectedMarker.setMap(null);

        // Elimina el marcador seleccionado del array
        const index = markers.indexOf(selectedMarker);
        if (index > -1) {
            markers.splice(index, 1);
        }

        // Resetea el marcador seleccionado
        selectedMarker = null;
    } else {
        // Muestra una alerta si no hay ningún marcador seleccionado
        alert("Por favor, selecciona un marcador para eliminar.");
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('btnMapaEliminarMarcador').addEventListener('click', eliminarMarcador);
});

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('btnMapaEliminarMarcador').addEventListener('click', eliminarMarcador);
});