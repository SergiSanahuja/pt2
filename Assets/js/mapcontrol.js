let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY";
let mainMap;
let mainMarkers = [];

function initMap() {
    mainMap = new google.maps.Map(document.getElementById('mapa'), {
        center: { lat: 41.67857183725525, lng: 2.7803433802871513 },
        zoom: 19,
        disableDefaultUI: true,
        mapTypeId: 'satellite'
    });

    loadMarkers();
}

function loadMarkers() {
    $.ajax({
        url: '../Controller/getMarkers.php', 
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            data.forEach(function(markerData) {
                let marker = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(markerData.lat), parseFloat(markerData.lng)),
                    map: mainMap,
                    title: markerData.nom
                });
                mainMarkers.push(marker);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los marcadores: ", status, error);
        }
    });
}

// Crea un marcador y lo añade al array newModalMarkers
function createMarker(location) {
    // Si ya se ha agregado un marcador, no agregue otro
    if (mainMarkers.length >= 1) {
        return;
    }

    let marker = new google.maps.Marker({
        position: location,
        map: mainMap
    });

    document.getElementById('modalLat').value = location.lat();
    document.getElementById('modalLng').value = location.lng();

    mainMarkers.push(marker); // Add the marker to the mainMarkers array
}

function refrescarMainMapMarkers() {
    mainMarkers.forEach(marker => marker.setMap(null));
    mainMarkers = [];
    loadMarkers();
}

$(window).on('load', function() {
    if (typeof google === 'object' && typeof google.maps === 'object') {
        initMap();
    } else {
        $.getScript(`https://maps.googleapis.com/maps/api/js?key=${googleApiKey}&callback=initMap`)
            .fail(function(jqxhr, settings, exception) {
                console.error("Error loading Google Maps script: ", exception);
            });
    }
});