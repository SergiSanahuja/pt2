let googleApiKey = "AIzaSyBkQGLnLx2qAYY82w34el8Dbc4xp1TdyTY"; // Reemplaza con tu clave API real
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
